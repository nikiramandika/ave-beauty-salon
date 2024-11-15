<?php

namespace App\Http\Controllers;

use App\Models\Treatment;
use App\Models\TreatmentDescription;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TreatmentController extends Controller
{
    public function create()
    {
        return view('owner.pages.treatments.create-treatments');
    }


    public function store(Request $request)
    {
        Log::info('Mulai proses penyimpanan treatment');

        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'treatment_name' => 'required|string|max:100',
            'treatment_slug' => 'required|string|max:100|unique:treatments,treatment_slug',
            'price' => 'required|numeric',
            'is_active' => 'required|boolean',
            'treatment_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'required|string',
            'duration' => 'required|string|max:100'
        ]);

        if ($validator->fails()) {
            Log::info('Validasi gagal', $validator->errors()->toArray());
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            // Tangani upload gambar
            $imageUrl = null;
            if ($request->hasFile('treatment_image')) {
                $image = $request->file('treatment_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/treatment_images', $imageName);
                $imageUrl = 'storage/treatment_images/' . $imageName;
                Log::info('Gambar berhasil diupload ke: ' . $imageUrl);
            }

            // Simpan data ke tabel treatments
            $treatment = Treatment::create([
                'treatment_id' => (string) Str::uuid(),
                'treatment_name' => $request->treatment_name,
                'treatment_slug' => $request->treatment_slug,
                'price' => $request->price,
                'is_active' => $request->is_active,
            ]);
            Log::info('Data treatment berhasil disimpan', $treatment->toArray());

            // Simpan data ke tabel treatment_descriptions
            $description = TreatmentDescription::create([
                'treatment_id' => $treatment->treatment_id,
                'treatment_image' => $imageUrl,
                'description' => $request->description,
                'duration' => $request->duration,
            ]);
            Log::info('Data treatment description berhasil disimpan', $description->toArray());

            DB::commit();
            Log::info('Transaksi berhasil di-commit');

            return redirect()->route('treatments.index')->with('success', 'Treatment berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Terjadi error: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Error menambahkan treatment: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function index()
    {
        $treatments = Treatment::with('description')->get();
        return view('owner.pages.treatments.treatments', compact('treatments'));
    }


    public function edit($id)
    {
        // Cari treatment berdasarkan ID dan load relasi description
        $treatment = Treatment::with('description')->findOrFail($id);

        return view('owner.pages.treatments.edit-treatments', compact('treatment'));
    }


    public function update(Request $request, $id)
    {
        // Validasi data yang diterima
        $validator = Validator::make($request->all(), [
            'treatment_name' => 'required|string|max:100',
            'treatment_slug' => 'required|string|max:100|unique:treatments,treatment_slug,' . $id . ',treatment_id',
            'price' => 'required|numeric',
            'is_active' => 'required|boolean',
            'treatment_image' => 'image|mimes:jpeg,png,jpg|max:2048', // Optional image
            'description' => 'required|string',
            'duration' => 'required|string|max:100'
        ]);

        // Jika validasi gagal, kembalikan ke halaman sebelumnya dengan pesan error
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            DB::beginTransaction();

            // Cari treatment berdasarkan ID
            $treatment = Treatment::findOrFail($id);

            // Tangani upload gambar jika ada file baru
            $imageUrl = $treatment->description->treatment_image; // Default ke gambar lama
            if ($request->hasFile('treatment_image')) {
                // Hapus gambar lama jika ada
                if ($treatment->description->treatment_image) {
                    Storage::delete(str_replace('storage/', 'public/', $treatment->description->treatment_image));
                }

                // Upload gambar baru
                $image = $request->file('treatment_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/treatment_images', $imageName);
                $imageUrl = 'storage/treatment_images/' . $imageName;
            }

            // Update data pada tabel treatments
            $treatment->update([
                'treatment_name' => $request->treatment_name,
                'treatment_slug' => $request->treatment_slug,
                'price' => $request->price,
                'is_active' => $request->is_active,
            ]);

            // Update data pada tabel treatment_descriptions
            $treatment->description()->update([
                'treatment_image' => $imageUrl,
                'description' => $request->description,
                'duration' => $request->duration,
            ]);

            DB::commit();

            return redirect()->route('treatments.index')->with('success', 'Treatment berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Error memperbarui treatment: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            // Cari treatment berdasarkan ID
            $treatment = Treatment::findOrFail($id);

            // Hapus gambar jika ada
            if ($treatment->description && $treatment->description->treatment_image) {
                Storage::delete(str_replace('storage/', 'public/', $treatment->description->treatment_image));
            }

            // Hapus data yang berelasi di tabel treatment_descriptions
            $treatment->description()->delete();

            // Hapus data di tabel treatments
            $treatment->delete();

            DB::commit();

            return redirect()->route('treatments.index')->with('success', 'Treatment berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with('error', 'Error menghapus treatment: ' . $e->getMessage());
        }
    }

    // Menampilkan semua treatment
    public function showTreatments()
    {
        // Ambil semua treatment dengan relasi description
        $treatments = Treatment::with('description')->where('is_active', 1)
            ->get();

        return view('user.pages.treatment', compact('treatments'));
    }

    public function showTreatment($treatment_slug)
    {
        // Ambil treatment berdasarkan slug dan relasi description
        $treatment = Treatment::where('treatment_slug', $treatment_slug)
            ->where('is_active', 1)
            ->with('description')
            ->firstOrFail();

        return view('user.pages.treatment-details', compact('treatment'));
    }

}