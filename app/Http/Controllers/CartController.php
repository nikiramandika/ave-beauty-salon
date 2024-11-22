<?php

namespace App\Http\Controllers;


use App\Models\Product;
use App\Models\Course;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
   // Tambah ke keranjang
   public function addToCart(Request $request)
   {
       // Validasi input
       $request->validate([
           'product_id' => 'required|exists:products,id',
           'quantity' => 'required|integer|min:1',
       ]);

       // Ambil produk berdasarkan ID
       $product = Product::findOrFail($request->product_id);

       // Ambil keranjang milik pengguna
       $cart = auth()->user()->cart;
       $cart->addItem($product, $request->quantity);

       // Redirect ke halaman sebelumnya atau halaman cart
       return redirect()->route('cart.show');
   }


    // Hapus item dari keranjang
    public function removeFromCart($id)
    {
        $cartItem = CartItem::findOrFail($id);

        // Pastikan hanya pemilik keranjang yang bisa menghapus
        if ($cartItem->user_id !== Auth::id()) {
            return response()->json(['error' => 'Tidak diizinkan'], 403);
        }

        $cartItem->delete();

        return response()->json(['success' => true]);
    }

    // Tampilkan item keranjang
    public function showCart()
    {
        // Cek apakah pengguna sudah login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu untuk melihat keranjang.');
        }

        $cartItems = Auth::user()->cartItems;

        return view('cart.index', [
            'cartItems' => $cartItems,
        ]);
    }


    // Update kuantitas item
    public function updateQuantity(Request $request, $id)
    {
        $validatedData = $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cartItem = CartItem::findOrFail($id);

        // Pastikan hanya pemilik keranjang yang bisa update
        if ($cartItem->user_id !== Auth::id()) {
            return response()->json(['error' => 'Tidak diizinkan'], 403);
        }

        $cartItem->update([
            'quantity' => $validatedData['quantity']
        ]);

        return response()->json([
            'success' => true,
            'total' => $cartItem->price * $cartItem->quantity
        ]);
    }
}
