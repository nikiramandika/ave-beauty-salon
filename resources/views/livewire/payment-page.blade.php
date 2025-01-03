<div class="container mt-5">
    <div class="row">
        <div class="col-lg-12 mx-auto">
            <h3 class="mb-4">Upload Proof of Payment</h3>

            <!-- Informasi Invoice -->
            <div class="mb-4">
                <h5>Invoice ID: <strong>{{ $invoice->invoice_code }}</strong></h5>
                @if($recipientBank === 'Mandiri')
                <h5>Recipient Bank: <strong>{{ $recipientBank }} (1029374382xxxx)</strong></h5>
                @elseif($recipientBank === 'BCA')
                <h5>Recipient Bank: <strong>{{ $recipientBank }} (82739129xxxx)</strong></h5>
                @elseif($recipientBank === 'BNI')
                <h5>Recipient Bank: <strong>{{ $recipientBank }} (332763840xxx)</strong></h5>
                @elseif($recipientBank === 'BRI')
                <h5>Recipient Bank: <strong>{{ $recipientBank }} (3793747672xxx)</strong></h5>
                @endif
                <h5>Time Remaining:
                    <strong id="countdown-timer"></strong>
                </h5>
            </div>

            <!-- Form Upload -->
            <form wire:submit.prevent="uploadProofOfPayment" enctype="multipart/form-data" class="needs-validation"
                novalidate>
                <div class="mb-4">
                    <label for="proofOfPayment" class="form-label">Upload Proof of Payment. Please wait untill the image is uploaded.</label>
                    <input type="file" class="form-control" id="proofOfPayment" wire:model="proofOfPayment"
                        accept="image/*" required>
                    @error('proofOfPayment')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tampilkan Preview jika ada file yang diunggah -->
                @if ($proofOfPayment)
                    <div class="mb-4">
                        <p>Preview:</p>
                        <img src="{{ $proofOfPayment->temporaryUrl() }}" class="img-thumbnail"
                            alt="Proof of Payment Preview" width="25%">
                    </div>
                @endif

                <!-- Tombol Submit -->
                <div class="mt-4 pt-4">
                    <button type="submit" class="btn btn-primary">Submit Proof of Payment</button>
                </div>
            </form>

            <!-- Pesan Sukses atau Error -->
            @if (session()->has('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @elseif (session()->has('error'))
                <div class="alert alert-danger mt-3">{{ session('error') }}</div>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const orderDate = new Date("{{ $invoice->order_date }}"); // Ambil order_date dari database
        const countdownTimer = document.getElementById('countdown-timer');

        function updateCountdown() {
            const now = new Date();
            const timeRemaining = orderDate.getTime() + 24 * 60 * 60 * 1000 - now
                .getTime(); // Tambah 24 jam ke order_date

            if (timeRemaining > 0) {
                const hours = Math.floor((timeRemaining / (1000 * 60 * 60)) % 24);
                const minutes = Math.floor((timeRemaining / (1000 * 60)) % 60);
                const seconds = Math.floor((timeRemaining / 1000) % 60);
                countdownTimer.textContent = `${hours}h ${minutes}m ${seconds}s`;
            } else {
                countdownTimer.textContent = "Expired";
                clearInterval(interval); // Hentikan timer
            }
        }

        // Update setiap detik
        const interval = setInterval(updateCountdown, 1000);
        updateCountdown(); // Panggil langsung agar tidak menunggu 1 detik pertama
    });
</script>
@livewireScripts
<script>
    // Mendengarkan event 'paymentUploaded' dari Livewire
    Livewire.on('paymentUploaded', invoiceId => {
        // Redirect ke halaman success setelah file berhasil diupload
        window.location.href = `/success/${invoiceId}`;
    });
</script>

