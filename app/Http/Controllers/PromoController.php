<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Models\Treatment;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    public function index()
    {
        // Mengambil semua promo beserta deskripsi dan relasi treatments
        $promos = Promo::with(['description', 'treatments'])->get();
        return view('owner.pages.promos.promos', compact('promos'));
    }

    public function create()
    {
        // Mengambil semua treatment yang tersedia
        $treatments = Treatment::where('is_active', 1)->get(); // Ambil treatment yang aktif saja

        // Mengirim data treatment ke view
        return view('owner.pages.promos.create-promos', compact('treatments'));
    }
    public function calculatePrice(Request $request)
    {
        $treatmentIds = $request->input('treatments', []);
        $totalPrice = 0;

        if (!empty($treatmentIds)) {
            $totalPrice = Treatment::whereIn('treatment_id', $treatmentIds)->sum('price');
        }

        return response()->json(['total_price' => $totalPrice]);
    }


    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'promo_name' => 'required|string|max:100',
            'promo_slug' => 'required|string|max:100|unique:promos,promo_slug',
            'original_price' => 'required|numeric',
            'promo_price' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'is_active' => 'required|boolean',
            'description' => 'nullable|string',
            'promo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'treatments' => 'required|array', // Pastikan treatments adalah array
            'treatments.*' => 'exists:treatments,treatment_id' // Setiap item harus ada di tabel treatments
        ]);

        // Proses pembuatan promo
        $promo = Promo::create($request->only([
            'promo_name',
            'promo_slug',
            'original_price',
            'promo_price',
            'start_date',
            'end_date',
            'is_active'
        ]));

        // Simpan treatment yang dipilih di tabel pivot `promo_treatment`
        $promo->treatments()->attach($request->treatments);

        // Jika ada deskripsi dan gambar, simpan di tabel `promo_descriptions`
        if ($request->has('description') || $request->hasFile('promo_image')) {
            $promoImagePath = null;
            if ($request->hasFile('promo_image')) {
                $image = $request->file('promo_image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $promoImagePath = $image->storeAs('public/promo_images', $imageName);
            }

            $promo->description()->create([
                'description' => $request->description,
                'promo_image' => $promoImagePath,
            ]);
        }

        return redirect()->route('promos.index')->with('success', 'Promo berhasil dibuat.');
    }


    public function edit($id)
    {
        $promo = Promo::with('description')->findOrFail($id);
        return view('promos.edit', compact('promo'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'promo_name' => 'required|string|max:100',
            'promo_slug' => 'required|string|max:100|unique:promos,promo_slug,' . $id . ',promo_id',
            'original_price' => 'required|numeric',
            'promo_price' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'is_active' => 'required|boolean',
            'description' => 'nullable|string',
            'promo_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $promo = Promo::findOrFail($id);
        $promo->update($request->only([
            'promo_name',
            'promo_slug',
            'original_price',
            'promo_price',
            'start_date',
            'end_date',
            'is_active'
        ]));

        if ($promo->description) {
            $promoImagePath = $promo->description->promo_image;
            if ($request->hasFile('promo_image')) {
                \Storage::disk('public')->delete($promoImagePath);
                $image = $request->file('promo_image');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $promoImagePath = $image->storeAs('public/promo_images', $imageName);
            }

            $promo->description()->update([
                'description' => $request->description,
                'promo_image' => $promoImagePath,
            ]);
        }

        return redirect()->route('promos.index')->with('success', 'Promo berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $promo = Promo::findOrFail($id);
        $promo->treatments()->detach();
        if ($promo->description && $promo->description->promo_image) {
            \Storage::disk('public')->delete($promo->description->promo_image);
        }
        $promo->description()->delete();
        $promo->delete();

        return redirect()->route('promos.index')->with('success', 'Promo berhasil dihapus.');
    }
}
