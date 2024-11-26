<div class="container mt-5">
    <div class="row">
        <div class="col-lg-6 mx-auto">
            <h3 class="mb-4">Upload Proof of Payment</h3>

            <!-- Informasi Invoice -->
            <div class="mb-3">
                <h5>Invoice ID: <strong>{{ $invoice->invoice_code }}</strong></h5>
                <h5>Recipient Bank: <strong>{{ $recipientBank }}</strong></h5>
                <h5>Time Remaining:
                    <strong id="countdown-timer"></strong>
                </h5>
            </div>

            <!-- Form Upload -->
            <form wire:submit.prevent="uploadProofOfPayment" enctype="multipart/form-data" class="needs-validation"
                novalidate>
                <div class="mb-3">
                    <label for="proofOfPayment" class="form-label">Upload Proof of Payment</label>
                    <input type="file" class="form-control" id="proofOfPayment" wire:model="proofOfPayment"
                        accept="image/*" required>
                    @error('proofOfPayment')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Tampilkan Preview jika ada file yang diunggah -->
                @if ($proofOfPayment)
                    <div class="mb-3">
                        <h5>Preview:</h5>
                        <img src="{{ $proofOfPayment->temporaryUrl() }}" class="img-thumbnail"
                            alt="Proof of Payment Preview">
                    </div>
                @endif

                <!-- Tombol Submit -->
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-success">Submit Proof of Payment</button>
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

