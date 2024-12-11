<div>
    <!-- Alert jika ada pesan sukses atau error -->
    <h4 class="mb-4">Delete Account</h4>
    <form wire:submit.prevent="deleteAccount">
        <div class="form-group">
            <label class="form-label">Current Password*</label>
            <input type="password" class="form-control" wire:model="delete_password"
                placeholder="Enter current password to delete account">
        </div>

        <p class="mt-2">Enter your current password to confirm deletion of your account.</p>

        <div class="text-right mt-4 mb-2">
            <button type="submit" class="btn bsb-btn-xl btn-primary">Delete Account</button>
        </div>
    </form>
    <div class="mt-4">
        
    @if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="flash-message">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@elseif (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="flash-message">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

    </div>
</div>
