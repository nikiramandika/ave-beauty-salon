<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductDescription;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function create()
    {
        // Ambil daftar kategori dari tabel categories jika tersedia
        $categories = Category::all();
        return view('owner.pages.products.create-products', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:100',
            'product_slug' => 'required|string|max:100|unique:products,product_slug',
            'price' => 'required|numeric',
            'category_id' => 'required|integer',
            'is_active' => 'required|boolean',
            'product_stock' => 'required|integer',
            'size' => 'required|string|max:50',
            'product_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required|string'
        ]);

        // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Tangani upload gambar produk
            $imageUrl = null;
            if ($request->hasFile('product_image')) {
                $image = $request->file('product_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/product_images', $imageName);
                $imageUrl = 'storage/product_images/' . $imageName;
            }

            // Simpan data ke tabel products
            $product = Product::create([
                'product_id' => (string) Str::uuid(),
                'product_name' => $request->product_name,
                'product_slug' => $request->product_slug,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'is_active' => $request->is_active,
            ]);

            // Simpan data ke tabel product_details
            ProductDetail::create([
                'product_id' => $product->product_id,
                'product_stock' => $request->product_stock,
                'size' => $request->size,
            ]);

            // Simpan data ke tabel product_descriptions
            ProductDescription::create([
                'product_id' => $product->product_id,
                'product_image' => $imageUrl,
                'description' => $request->description,
            ]);

            return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error menambahkan produk: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function index()
    {
        $products = Product::with(['details', 'description', 'category'])->get();
        $categories = Category::all();
        return view('owner.pages.products.products', compact('products', 'categories'));
    }

    public function edit($id)
    {
        // Find product by ID and load its related details and description
        $product = Product::with(['details', 'description'])->findOrFail($id);
        $categories = Category::all();

        return view('owner.pages.products.edit-products', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string|max:100',
            'product_slug' => 'required|string|max:100|unique:products,product_slug,' . $id . ',product_id',
            'price' => 'required|numeric',
            'category_id' => 'required|integer',
            'is_active' => 'required|boolean',
            'product_stock' => 'required|integer',
            'size' => 'required|string|max:50',
            'product_image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required|string'
        ]);

        // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Temukan produk berdasarkan ID
            $product = Product::findOrFail($id);

            // Tangani upload gambar produk baru jika ada
            $imageUrl = $product->description->product_image ?? null;
            if ($request->hasFile('product_image')) {
                // Hapus gambar lama jika ada
                if ($product->description && $product->description->product_image) {
                    Storage::delete(str_replace('storage/', 'public/', $product->description->product_image));
                }

                $image = $request->file('product_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/product_images', $imageName);
                $imageUrl = 'storage/product_images/' . $imageName;
            }

            // Update data pada tabel products
            $product->update([
                'product_name' => $request->product_name,
                'product_slug' => $request->product_slug,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'is_active' => $request->is_active,
            ]);

            // Update data pada tabel product_details
            $product->details()->update([
                'product_stock' => $request->product_stock,
                'size' => $request->size,
            ]);

            // Update data pada tabel product_descriptions
            $product->description()->update([
                'product_image' => $imageUrl,
                'description' => $request->description,
            ]);

            return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error memperbarui produk: ' . $e->getMessage())
                ->withInput();
        }
    }


    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);

            // Hapus gambar produk jika ada
            if ($product->description && $product->description->product_image) {
                Storage::delete(str_replace('storage/', 'public/', $product->description->product_image));
            }

            // Hapus data terkait dari tabel lain
            $product->details()->delete();
            $product->description()->delete();
            $product->delete();

            return redirect()
                ->route('products.index')
                ->with('success', 'Produk berhasil dihapus.');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error menghapus produk: ' . $e->getMessage());
        }
    }

    public function userIndex()
    {
        $products = Product::where('is_active', 1)
            ->with(['details', 'description', 'category'])
            ->get();
        $categories = Category::all();
        return view('user.pages.product', compact('products', 'categories'));
    }

    public function showProduct($product_slug)
    {
        // Pastikan Anda menggunakan kolom `product_slug` untuk mengambil data produk yang benar
        $product = Product::where('product_slug', $product_slug)
            ->where('is_active', 1)
            ->with('description', 'details')
            ->firstOrFail();

        return view('user.pages.product-details', compact('product'));
    }

}
