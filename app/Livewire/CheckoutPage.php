<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;

class CheckoutPage extends Component
{
    use WithFileUploads;

    // Form fields
    public $firstName;
    public $lastName;
    public $email;
    public $address;
    public $country;
    public $state;
    public $zip;
    public $recipientBank;
    public $proofOfPayment;
    public $recipientPhone;


    // Cart data
    public $cartItems = [];
    public $cartTotal = 0;

    protected $rules = [
        'firstName' => 'required|string|max:100',
        'lastName' => 'required|string|max:100',
        'email' => 'required|email',
        'recipientPhone' => 'required|string|max:15', // Tambahkan aturan validasi untuk phone
        'address' => 'required|string',
        'country' => 'required|string',
        'state' => 'required|string',
        'zip' => 'required|string|max:10',
        'recipientBank' => 'required|string',
        'proofOfPayment' => 'nullable|file|mimes:jpeg,png,jpg',
    ];


    public function mount()
    {
        // Load data keranjang tanpa memulai timer
        $this->loadCartData();
    }



    public function loadCartData()
    {
        if (auth()->check()) {
            $this->cartItems = CartManagement::getCartItems();
            $this->cartTotal = $this->cartItems->sum(function ($item) {
                // Ambil harga dari relasi productDetail
                return $item->quantity * ($item->productDetail->price ?? 0);
            });
        } else {
            $this->cartItems = [];
            $this->cartTotal = 0;
        }
    }


    public function submitPayment()
    {
        $this->email = auth()->user()->email;

        // Validasi Input
        try {
            $this->validate([
                'firstName' => 'required|string',
                'lastName' => 'required|string',
                'recipientPhone' => 'required|string',
                'address' => 'required|string',
                'state' => 'required|string',
                'country' => 'required|string',
                'zip' => 'required|string',
                'recipientBank' => 'required|string',
            ]);
        } catch (\Exception $e) {
            // Debug hanya untuk pengembangan
            logger()->error('Validation error: ' . $e->getMessage());
            session()->flash('error', 'Validation failed. Please check your input.');
            return back();
        }

        $recipientName = $this->firstName . ' ' . $this->lastName;
        $recipientAddress = $this->address . ', ' . $this->state . ', ' . $this->country . ', ' . $this->zip;
        $proofPath = null; // Bukti pembayaran belum diunggah

        try {
            DB::transaction(function () use ($recipientName, $recipientAddress, &$invoiceId) {
                // Panggil stored procedure
                $result = DB::select('CALL proses_invoice(?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                    auth()->id(),           // User ID
                    $recipientName,         // Nama penerima
                    $this->email,           // Email penerima
                    $this->recipientPhone,  // Telepon penerima
                    $recipientAddress,      // Alamat penerima
                    $this->recipientBank,   // Bank penerima
                    null,                   // Proof of Payment
                    'Bank Transfer',        // Metode pembayaran
                    'Pending',              // Status pesanan
                ]);

                if (empty($result)) {
                    throw new \Exception('Stored procedure did not return any result.');
                }

                $invoiceId = $result[0]->selling_invoice_id ?? null;

                if (!$invoiceId) {
                    throw new \Exception('Failed to retrieve selling_invoice_id from stored procedure.');
                }
            });

            // Redirect ke halaman pembayaran
            return redirect()->route('payment.upload', ['invoiceId' => $invoiceId]);
        } catch (\Exception $e) {
            // Log error untuk debugging
            logger()->error('Transaction error: ' . $e->getMessage());

            // Flash pesan error untuk pengguna
            session()->flash('error', 'An error occurred while processing your payment. Please try again later.');
            return back();
        }
    }


    public function render()
    {

        return view('livewire.checkout-page', [
            'cartItems' => [], // Contoh data keranjang
            'cartTotal' => 0, // Contoh total keranjang
        ]);
    }


}
