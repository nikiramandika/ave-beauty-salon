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
        'proofOfPayment' => 'required|file|mimes:jpeg,png,jpg',
    ];


    public function mount()
    {
        $this->loadCartData();
    }

    public function loadCartData()
    {
        if (auth()->check()) {
            $this->cartItems = CartManagement::getCartItems();
            $this->cartTotal = $this->cartItems->sum(function ($item) {
                return $item->quantity * $item->product->price;
            });
        } else {
            $this->cartItems = [];
            $this->cartTotal = 0;
        }
    }

    public function submitPayment()
    {
        $this->email = auth()->user()->email;
        try {
            $this->validate();
        } catch (\Exception $e) {
            dd($e); // Dump dan hentikan eksekusi untuk melihat informasi lengkap exception
        }


        // Gabungkan nama depan dan belakang
        $recipientName = $this->firstName . ' ' . $this->lastName;

        // Gabungkan Address, Country, State, dan Zip ke dalam satu string
        $recipientAddress = $this->address . ', ' . $this->state . ', ' . $this->country . ', ' . $this->zip;

        // Upload file proof of payment
        if (!$this->proofOfPayment) {
            dd('Proof of Payment file not provided');
        }


        $proofPath = $this->proofOfPayment->store('proof_of_payments', 'public');

        try {
            DB::transaction(function () use ($recipientName, $recipientAddress, $proofPath) {

                // Panggil stored procedure
                DB::statement('CALL insertInvoiceProcedure2(?, ?, ?, ?, ?, ?, ?, ?, ?)', [
                    auth()->id(),                  // User ID
                    $recipientName,                // Recipient Name
                    $this->email,                  // Email
                    $this->recipientPhone,         // Recipient Phone
                    $recipientAddress,             // Recipient Address
                    $this->recipientBank,          // Recipient Bank
                    $proofPath,                    // Proof of Payment
                    'Bank Transfer',               // Payment Method
                    'Pending',                     // Order Status
                ]);
            });


            // Set pesan sukses
            session()->flash('success', 'Payment submitted successfully!');
            $this->reset(); // Reset form input setelah sukses
        } catch (\Exception $e) {
            // Debug: Jika terjadi error
            dd('Error during transaction:', $e->getMessage());
        }
    }





    public function render()
    {
        return view('livewire.checkout-page', [
            'cartItems' => $this->cartItems,
            'cartTotal' => $this->cartTotal,
        ]);
    }
}
