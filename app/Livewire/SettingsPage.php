<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SettingsPage extends Component
{
    public $nama_depan;
    public $nama_belakang;
    public $email;
    public $phone;
    public $current_password;
    public $new_password;
    public $confirm_password;
    public $delete_password;

    protected $rules = [
        'nama_depan' => 'required|string|max:255',
        'nama_belakang' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:20',
        'current_password' => 'required|string',
        'new_password' => 'required|string|min:8|confirmed',
        'confirm_password' => 'required|string|min:8',
        'delete_password' => 'required|string|min:8',
    ];

    // Handle updating the user profile
// Handle updating the user profile
    public function updateProfile()
    {
        // Validasi semua field
        $this->validate([
            'nama_depan' => 'required|string|max:255',
            'nama_belakang' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        // Cek apakah nomor telepon sudah ada di database selain untuk user yang sedang login
        if (Auth::user()->phone != $this->phone && User::where('phone', $this->phone)->exists()) {
            session()->flash('error', 'Nomor telepon sudah terdaftar.');
            return;
        }

        // Ambil user yang sedang login
        $user = Auth::user();
        $user->nama_depan = $this->nama_depan;
        $user->nama_belakang = $this->nama_belakang;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->save();

        session()->flash('message', 'Profile updated successfully!');
    }






    // Handle changing the password
    public function changePassword()
    {
        $this->validate();

        $user = Auth::user();

        // Check if current password is correct
        if (!Hash::check($this->current_password, $user->password)) {
            session()->flash('error', 'Current password is incorrect.');
            return;
        }

        // Update password
        $user->password = Hash::make($this->new_password);
        $user->save();

        session()->flash('message', 'Password updated successfully!');
    }

    // Handle account deletion (Soft delete by setting is_active to 0)
    public function deleteAccount()
    {
        $this->validateOnly('delete_password');

        $user = Auth::user();

        // Check if current password is correct for deletion
        if (!Hash::check($this->delete_password, $user->password)) {
            session()->flash('error', 'Password is incorrect.');
            return;
        }

        // Set is_active to 0 (soft delete)
        $user->is_active = 0;
        $user->save();

        Auth::logout(); // Log the user out after account deletion
        session()->flash('message', 'Your account has been deleted successfully.');
    }

    public function mount()
    {
        $user = Auth::user();
        $this->nama_depan = $user->nama_depan;
        $this->nama_belakang = $user->nama_belakang;
        $this->email = $user->email;
        $this->phone = $user->phone;
    }

    public function render()
    {
        return view('livewire.settings-page');
    }
}
