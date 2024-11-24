<?php

namespace App\Helpers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\Auth;

class CartManagement
{
    public static function addItemToCart($product_id, $quantity = 1, $detail_id = null)
    {
        $user_id = Auth::id();

        // Cari atau buat keranjang
        $cart = Cart::firstOrCreate(
            ['user_id' => $user_id, 'is_active' => true],
            ['is_active' => true]
        );

        // Validasi detail produk
        $productDetail = ProductDetail::find($detail_id);
        if (!$productDetail) {
            throw new \Exception('Detail produk tidak ditemukan.');
        }

        // Cari atau buat item di keranjang
        $cart_item = CartItem::where('cart_id', $cart->cart_id)
            ->where('product_id', $product_id)
            ->where('detail_id', $detail_id)
            ->first();


        if ($cart_item) {
            // Tambahkan kuantitas jika item sudah ada
            $cart_item->quantity += $quantity;
            $cart_item->save();
        } else {
            // Debug: Pastikan `detail_id` tidak kosong
            // Buat item baru di keranjang
            CartItem::create([
                'cart_id' => $cart->cart_id,
                'product_id' => $product_id,
                'detail_id' => $detail_id, // Pastikan detail_id disertakan
                'quantity' => $quantity,
                'size' => $productDetail->size,
                'price' => $productDetail->price, // Simpan harga dari detail produk
            ]);
        }
    }



    public static function incrementItemQuantityByCartItemId($cart_item_id)
    {
        $cart_item = CartItem::find($cart_item_id);
        if ($cart_item) {
            $cart_item->quantity += 1;
            $cart_item->save();
        }
    }

    public static function decrementItemQuantityByCartItemId($cart_item_id)
    {
        $cart_item = CartItem::find($cart_item_id);
        if ($cart_item) {
            if ($cart_item->quantity > 1) {
                $cart_item->quantity -= 1;
                $cart_item->save();
            } else {
                $cart_item->delete();
            }
        }
    }

    public static function removeItemFromCartByCartItemId($cart_item_id)
    {
        CartItem::destroy($cart_item_id);
    }

    public static function getCartItems()
    {
        $user_id = auth()->id();
        $cart = Cart::where('user_id', $user_id)->where('is_active', true)->first();

        if ($cart) {
            // Pastikan relasi productDetail dimuat
            return CartItem::where('cart_id', $cart->cart_id)
                ->with(['product', 'productDetail'])
                ->get();
        }

        return collect();
    }


    public static function getCartItemCount($cart_id)
    {
        return CartItem::where('cart_id', $cart_id)->sum('quantity');
    }

    public static function calculateGrandTotal($items)
    {
        return $items->sum(function ($item) {
            // Gunakan harga dari relasi productDetail
            return $item->quantity * ($item->productDetail->price ?? 0);
        });
    }


}
