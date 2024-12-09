<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class LaporanKasirController extends Controller
{
    public function index()
    {
        $today = Carbon::today('Asia/Jakarta')->format('Y-m-d');

        // Ambil data pesanan Offline
        $offlineOrders = DB::table('invoice_summary')
            ->where('recipient_address', 'Pesanan Offline')
            ->whereDate('order_date', $today)
            ->get();

        // Ambil data pesanan Online
        $onlineOrders = DB::table('invoice_summary')
            ->where('recipient_address', '!=', 'Pesanan Offline')
            ->whereDate('order_date', $today)
            ->get();

        // Ambil detail untuk setiap invoice_code dan juga cashier_id
        foreach ($offlineOrders as $order) {
            // Ambil data dari selling_invoices berdasarkan invoice_code
            $invoice = DB::table('selling_invoices')
                ->where('invoice_code', $order->invoice_code)
                ->first();  // Ambil data pertama yang sesuai dengan invoice_code

            if ($invoice) {
                // Menambahkan cashier_id ke order
                $order->cashier_id = $invoice->cashier_id; // Menyimpan cashier_id

                // Ambil data dari tabel users berdasarkan cashier_id
                $cashier = DB::table('users')
                    ->where('id', $invoice->cashier_id)
                    ->first(); // Ambil data cashier berdasarkan id

                if ($cashier) {
                    // Menambahkan nama depan dan nama belakang ke order
                    $order->cashier_name = $cashier->nama_depan . ' ' . $cashier->nama_belakang;
                }

                // Ambil selling_invoice_details berdasarkan invoice_id
                $order->details = DB::table('selling_invoice_details')
                    ->where('invoice_id', $invoice->selling_invoice_id)
                    ->get();
            }
        }

        foreach ($onlineOrders as $order) {
            // Ambil data dari selling_invoices berdasarkan invoice_code
            $invoice = DB::table('selling_invoices')
                ->where('invoice_code', $order->invoice_code)
                ->first();  // Ambil data pertama yang sesuai dengan invoice_code

            if ($invoice) {
                // Menambahkan cashier_id ke order
                $order->cashier_id = $invoice->cashier_id; // Menyimpan cashier_id

                // Ambil data dari tabel users berdasarkan cashier_id
                $cashier = DB::table('users')
                    ->where('id', $invoice->cashier_id)
                    ->first(); // Ambil data cashier berdasarkan id

                if ($cashier) {
                    // Menambahkan nama depan dan nama belakang ke order
                    $order->cashier_name = $cashier->nama_depan . ' ' . $cashier->nama_belakang;
                }

                // Ambil selling_invoice_details berdasarkan invoice_id
                $order->details = DB::table('selling_invoice_details')
                    ->where('invoice_id', $invoice->selling_invoice_id)
                    ->get();
            }

        }
        
        $daily_revenue = DB::select('SELECT daily_revenue() AS total_today');

        // Mengakses nilai total_today dari hasil query
        $totalToday = $daily_revenue[0]->total_today ?? 0;  // Default ke 0 jika tidak ada hasil

        return view('cashier.laporan-kasir', compact('offlineOrders', 'onlineOrders', 'totalToday'));
    }
}
