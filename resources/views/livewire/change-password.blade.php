<div>


    <h4 class="mb-4">Change Password</h4>
    <form wire:submit.prevent="changePassword">
        <div class="form-group">
            <label class="form-label">Current Password</label>
            <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                wire:model="current_password" placeholder="Current password">
            @error('current_password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">New Password</label>
            <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                wire:model="new_password" placeholder="New password">
            @error('new_password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="form-group">
            <label class="form-label">Confirm New Password</label>
            <input type="password" class="form-control @error('confirm_password') is-invalid @enderror"
                wire:model="confirm_password" placeholder="Confirm new password">
            @error('confirm_password')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div class="text-right mt-4 mb-2">
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>

    <div class="mt-4">
            <!-- Menampilkan pesan sukses -->
    @if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert" id="flash-message">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Menampilkan pesan error -->
@if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="flash-message">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
    </div>
</div>
