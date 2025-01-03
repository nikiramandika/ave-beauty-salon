<div>
    <!-- General Tab -->


    <h4 class="mb-4">General Settings</h4>
    <form wire:submit.prevent="updateProfile">
        <div class="form-group">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control mb-1" wire:model="nama_depan" placeholder="First name">
        </div>

        <div class="form-group">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control" wire:model="nama_belakang" placeholder="Last name">
        </div>

        <div class="form-group">
            <label class="form-label">E-mail</label>
            <!-- Menjadikan input readonly atau disabled agar tidak bisa diubah -->
            <input type="text" class="form-control mb-1" wire:model="email" value="{{ $email }}"
                placeholder="E-mail" readonly>

            @if (Auth::user()->email_verified_at == null)
                <div class="alert alert-warning mt-3">
                    Your email is not verified. Please verify your Email.<br>
                    <a href="/verify-email">Click here to verify your email</a>
                </div>
            @endif
        </div>

        <div class="form-group">
            <label class="form-label">Phone Number</label>
            <input type="number" class="form-control" wire:model="phone" placeholder="Phone number"
                pattern="[0-9]{10,13}" minlength="10" maxlength="13" required>
                @error('phone')
                    <div class="alert alert-danger mt-3">
                        {{ $message }}
                    </div>
               @enderror

            @if (Auth::user()->phone == null)
                <div class="alert alert-warning mt-3">
                    Your phone number must be filled. Updated your phone number.<br>
                </div>
            @endif
            @if (
                !is_null(Auth::user()->phone) &&
                    (!is_numeric(Auth::user()->phone) || strlen(Auth::user()->phone) < 10 || strlen(Auth::user()->phone) > 13))
                <div class="alert alert-danger mt-3">
                    Phone number must contain only numbers and 10 to 13 characters long<br>
                </div>
            @endif
        </div>

        <div class="text-right mt-4">
            <button type="submit" class="btn btn-primary">Save changes</button>&nbsp;
            <button type="button" class="btn btn-default" wire:click="resetForm">Cancel</button>

        </div>
    </form>


    <div class="mt-4">
        @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="flash-message">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @elseif (session()->has('error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert" id="flash-message">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    </div>
</div>
