<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ChangePassword extends Component
{
    public $current_password, $new_password, $confirm_password;

    public function changePassword()
    {
        // Validasi input
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password',
        ], [
            'current_password.required' => 'Current password is required.',
            'new_password.required' => 'New password is required.',
            'new_password.min' => 'New password must be at least 8 characters.',
            'confirm_password.required' => 'Please confirm your new password.',
            'confirm_password.same' => 'New password and confirmation do not match.',
        ]);

        // Cek apakah current password sesuai dengan password di database
        if (!Hash::check($this->current_password, auth()->user()->password)) {
            // Menambahkan pesan kesalahan
            session()->flash('error', 'The current password is incorrect.');
            return; // Menghentikan proses jika password salah
        }

        // Update password jika valid
        auth()->user()->update(['password' => bcrypt($this->new_password)]);

        // Beri pesan sukses
        session()->flash('message', 'Password updated successfully!');
    }

}
