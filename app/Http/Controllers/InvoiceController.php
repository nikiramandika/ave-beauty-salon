<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SellingInvoice;
use Dompdf\Dompdf;
use Dompdf\Options;

class InvoiceController extends Controller
{
    // Method untuk menampilkan invoice
    public function viewInvoice($invoiceCode)
    {
        // Mengambil data invoice berdasarkan kolom invoice_code
        $invoice = SellingInvoice::with('details')->where('invoice_code', $invoiceCode)->firstOrFail();
        // Debugging untuk memastikan data ditemukan
        // dd($invoice);

        // Passing data ke view
        return view('invoice', compact('invoice'));
    }
    public function viewReceipt($invoiceCode)
    {
        // Mengambil data invoice berdasarkan kolom invoice_code
        $invoice = SellingInvoice::with('details')->where('invoice_code', $invoiceCode)->firstOrFail();

        // Debugging untuk memastikan data ditemukan
        // dd($invoice);

        // Passing data ke view
        return view('invoice', compact('invoice'));
    }

    // Method untuk mendownload PDF invoice
    public function downloadInvoice($invoiceCode)
    {
        // Mengambil data invoice berdasarkan kolom invoice_code
        $invoice = SellingInvoice::with('details')->where('invoice_code', $invoiceCode)->firstOrFail();

        // Mengambil tampilan blade yang akan di-render ke HTML
        $html = view('invoice', compact('invoice'))->render();

        // Setup DomPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);

        // Load HTML ke DomPDF
        $dompdf->loadHtml($html);

        // Set ukuran kertas (A4) dan orientasi (portrait)
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF dari HTML
        $dompdf->render();

        // Stream PDF ke browser atau download
        return $dompdf->stream('invoice.pdf', ['Attachment' => 0]); // 0 untuk menampilkan di browser, 1 untuk mendownload
    }
    public function downloadReceipt($invoiceCode)
    {
        // Mengambil data invoice berdasarkan kolom invoice_code
        $invoice = SellingInvoice::with('details')->where('invoice_code', $invoiceCode)->firstOrFail();

        // Mengambil tampilan blade yang akan di-render ke HTML
        $html = view('receipt', compact('invoice'))->render();

        // Setup DomPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $dompdf = new Dompdf($options);

        // Load HTML ke DomPDF
        $dompdf->loadHtml($html);

        // Set ukuran kertas (A4) dan orientasi (portrait)
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF dari HTML
        $dompdf->render();

        // Stream PDF ke browser atau download
        return $dompdf->stream('invoice.pdf', ['Attachment' => 0]); // 0 untuk menampilkan di browser, 1 untuk mendownload
    }
}
