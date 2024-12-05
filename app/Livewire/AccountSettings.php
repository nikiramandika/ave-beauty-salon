<?php

namespace App\Livewire;

use App\Models\User;
use Auth;
use Livewire\Component;

class AccountSettings extends Component
{
    public $nama_depan, $nama_belakang, $email, $phone;

    public function mount()
    {
        // Ambil data user yang sedang login dan isi dengan data tersebut
        $this->nama_depan = auth()->user()->nama_depan;
        $this->nama_belakang = auth()->user()->nama_belakang;
        $this->email = auth()->user()->email;
        $this->phone = auth()->user()->phone;
    }

    public function updateProfile()
    {
        // Validasi semua field
        $this->validate([
            'nama_depan' => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|regex:/^[0-9]+$/|max:20', // Validasi untuk nomor telepon hanya angka
        ], [
            'phone.regex' => 'Nomor telepon hanya boleh mengandung angka.',
        ]);

        // Cek apakah nomor telepon sudah ada di database selain untuk user yang sedang login
        if (Auth::user()->phone != $this->phone && User::where('phone', $this->phone)->exists()) {
            session()->flash('error', 'Nomor telepon sudah terdaftar.');
            return;
        }

        // Ambil user yang sedang login
        $user = Auth::user();

        // Update hanya jika ada perubahan pada data
        $updated = false;

        if ($user->nama_depan != $this->nama_depan) {
            $user->nama_depan = $this->nama_depan;
            $updated = true;
        }

        if ($user->nama_belakang != $this->nama_belakang) {
            $user->nama_belakang = $this->nama_belakang;
            $updated = true;
        }

        if ($user->email != $this->email) {
            $user->email = $this->email;
            $updated = true;
        }

        if ($user->phone != $this->phone) {
            $user->phone = $this->phone;
            $updated = true;
        }

        // Simpan perubahan jika ada yang diubah
        if ($updated) {
            $user->save();
            session()->flash('message', 'Profile updated successfully!');
        } else {
            session()->flash('message', 'No changes made to the profile.');
        }
    }

}
