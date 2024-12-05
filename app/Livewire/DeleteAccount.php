<?php
namespace App\Livewire;

use Auth;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class DeleteAccount extends Component
{
    public $delete_password;

    public function deleteAccount()
    {
        // Validasi jika password dikosongkan
        $this->validate([
            'delete_password' => 'required',
        ]);

        // Cek apakah password yang dimasukkan benar
        if (!Hash::check($this->delete_password, auth()->user()->password)) {
            session()->flash('error', 'The password is incorrect.');
            return;
        }

        // Soft delete akun pengguna yang sedang login dengan mengubah is_active menjadi 0
        $user = auth()->user();
        $user->is_active = 0;  // Menandakan akun tidak aktif
        $user->save();

        // Logout pengguna setelah melakukan soft delete
        Auth::logout();

        // Flash message setelah berhasil mengubah status akun
        session()->flash('message', 'Account has been deactivated successfully.');

        // Redirect ke halaman depan setelah status akun diubah dan logout
        return redirect('/');
    }



    public function render()
    {
        return view('livewire.delete-account');
    }
}
