<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Models\PromoDescription;
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
        // Fetch only active treatments
        $treatments = Treatment::where('is_active', 1)->get();

        return view('owner.pages.promos.create-promos', compact('treatments'));
    }

    public function store(Request $request)
    {

        // Validasi data yang diterima
        $request->validate([
            'promo_name' => 'required|string|max:100',
            'promo_slug' => 'required|string|max:100|unique:promos',
            'treatments' => 'required|array',
            'original_price' => 'required|numeric',
            'promo_price' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'is_active' => 'required|boolean',
            'promo_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Tambahkan validasi untuk gambar
            'description' => 'nullable|string',
        ]);



        try {
            // Tangani upload gambar promo
            $imageUrl = null;
            if ($request->hasFile('promo_image')) {
                $image = $request->file('promo_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/promo_images', $imageName); // Simpan gambar di folder public/promo_images
                $imageUrl = 'storage/promo_images/' . $imageName;
            }


            // Simpan data ke tabel promos
            $promo = Promo::create([
                'promo_name' => $request->promo_name,
                'promo_slug' => $request->promo_slug,
                'original_price' => $request->original_price,
                'promo_price' => $request->promo_price,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'is_active' => $request->is_active,
            ]);

            // Simpan deskripsi promo dan gambar ke tabel promo_descriptions
            PromoDescription::create([
                'promo_id' => $promo->promo_id,
                'description' => $request->description,
                'promo_image' => $imageUrl,
            ]);

            // Hubungkan treatments ke promo
            $promo->treatments()->attach($request->treatments);

            return redirect()->route('promos.index')->with('success', 'Promo berhasil ditambahkan.');
        } catch (\Exception $e) {
            dd('Error:', $e->getMessage()); // Menampilkan pesan error jika ada
            return redirect()

                ->back()
                ->with('error', 'Error menambahkan promo: ' . $e->getMessage())
                ->withInput();
        }
    }


    public function edit($id)
    {
        // Ambil data promo yang ingin diedit beserta treatments yang terhubung
        $promo = Promo::with('treatments')->findOrFail($id);

        // Ambil semua treatments yang aktif untuk pilihan
        $treatments = Treatment::where('is_active', 1)->get();

        return view('owner.pages.promos.edit-promos', compact('promo', 'treatments'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'promo_name' => 'required|string|max:100',
            'promo_slug' => 'required|string|max:100|unique:promos,promo_slug,' . $id . ',promo_id',
            'treatments' => 'required|array',
            'original_price' => 'required|numeric',
            'promo_price' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'is_active' => 'required|boolean',
            'promo_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
        ]);

        try {
            $promo = Promo::findOrFail($id);

            // Tetapkan gambar lama sebagai default jika tidak ada gambar baru
            $imageUrl = $promo->description->promo_image ?? null;

            if ($request->hasFile('promo_image')) {
                $image = $request->file('promo_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/promo_images', $imageName);
                $imageUrl = 'storage/promo_images/' . $imageName;
            }

            // Update data di tabel promos
            $promo->update([
                'promo_name' => $request->promo_name,
                'promo_slug' => $request->promo_slug,
                'original_price' => $request->original_price,
                'promo_price' => $request->promo_price,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'is_active' => $request->is_active,
            ]);

            // Update data di tabel promo_descriptions hanya jika ada perubahan
            PromoDescription::updateOrCreate(
                ['promo_id' => $promo->promo_id],
                [
                    'description' => $request->description,
                    'promo_image' => $imageUrl, // Gunakan gambar lama jika tidak ada gambar baru
                ]
            );

            // Sinkronisasi treatments dengan promo
            $promo->treatments()->sync($request->treatments);

            return redirect()->route('promos.index')->with('success', 'Promo berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error mengupdate promo: ' . $e->getMessage())->withInput();
        }
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

    public function showPromos()
{
    // Fetch all promos with related description
    $promos = Promo::where('is_active', 1)
    ->with('description')->get();

    return view('user.pages.promo', compact('promos'));
}

public function showPromo($promo_slug)
{
    // Fetch promo based on slug with related description
    $promo = Promo::where('promo_slug', $promo_slug)
        ->where('is_active', 1)
        ->with('description')
        ->firstOrFail();

    return view('user.pages.promo-details', compact('promo'));
}

}
