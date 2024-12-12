<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Carbon\Carbon; // Untuk manipulasi tanggal

class TransactionReportController extends Controller
{
    public function index(Request $request)
    {
        // Ambil filter dari request
        $timeRange = $request->get('time_range', 'daily');
        $invoiceFilter = $request->get('invoice_filter', 'daily');
        $courseFilter = $request->get('course_filter', 'daily');

        // Tentukan rentang waktu untuk Total Pendapatan
        [$revenueStartDate, $revenueEndDate] = $this->getDateRange($timeRange);

        // Tentukan rentang waktu untuk Invoice Summary
        [$invoiceStartDate, $invoiceEndDate] = $this->getDateRange($invoiceFilter);

        // Tentukan rentang waktu untuk Course History
        [$courseStartDate, $courseEndDate] = $this->getDateRange($courseFilter);

        // Hitung total pendapatan menggunakan stored procedure
        $totalAmount = DB::select("CALL GetTotalAmount(?)", [$timeRange])[0]->total_amount ?? 0;
        $invoiceTotal = DB::table('invoice_summary')
            ->whereBetween('order_date', [$invoiceStartDate, $invoiceEndDate])
            ->where('order_status', 'Complete') // Hanya status Complete
            ->sum('total_amount');

        $courseTotal = DB::table('course_history1')
            ->whereBetween('order_date', [$courseStartDate, $courseEndDate])
            ->where('order_status', 'Complete') // Hanya status Complete
            ->sum('course_price');


        $invoices = DB::table('invoice_summary')
            ->leftJoin('selling_invoices', 'invoice_summary.invoice_code', '=', 'selling_invoices.invoice_code') // Gabungkan dengan tabel selling_invoices
            ->leftJoin('users', 'selling_invoices.cashier_id', '=', 'users.id') // Gabungkan dengan tabel users
            ->select(
                'invoice_summary.*', // Pilih semua kolom dari invoice_summary
                'selling_invoices.cashier_id', // Ambil cashier_id (bisa null)
                DB::raw("CONCAT(users.nama_depan, ' ', users.nama_belakang) as cashier_name") // Gabungkan nama depan dan nama belakang (bisa null)
            )
            ->whereBetween('invoice_summary.order_date', [$invoiceStartDate, $invoiceEndDate]) // Filter tanggal
            ->get();

        // Ambil data Course History
        $courseHistories = DB::table('course_history1')
            ->whereBetween('order_date', [$courseStartDate, $courseEndDate])
            ->get();

        // Kirim data ke view
        return view('owner.pages.transaction-report.index', compact('totalAmount', 'invoices', 'courseHistories', 'timeRange', 'invoiceFilter', 'courseFilter', 'invoiceTotal', 'courseTotal'));
    }

    // Fungsi pembantu untuk menentukan rentang waktu
    private function getDateRange($filter)
    {
        $startDate = null;
        $endDate = Carbon::now('Asia/Jakarta');

        switch ($filter) {
            case 'daily':
                $startDate = Carbon::today('Asia/Jakarta');
                break;
            case 'weekly':
                $startDate = Carbon::now('Asia/Jakarta')->startOfWeek();
                break;
            case 'monthly':
                $startDate = Carbon::now('Asia/Jakarta')->startOfMonth();
                break;
            case 'yearly':
                $startDate = Carbon::now('Asia/Jakarta')->startOfYear();
                break;
        }

        return [$startDate, $endDate];
    }

    public function reportByTime(Request $request)
    {
        // Ambil input bulan dan tahun dari request
        $selectedMonth = $request->input('month'); // Bisa NULL jika tidak dipilih
        $selectedYear = $request->input('year', date('Y')); // Default ke tahun saat ini jika tidak diisi

        // Ambil data dari prosedur GetInvoiceSummary
        $invoiceSummary = DB::select('CALL GetInvoiceSummary(?, ?)', [$selectedMonth, $selectedYear]);

        // Ubah data menjadi Collection untuk manipulasi lebih lanjut
        $invoiceSummary = collect($invoiceSummary);

        // Gabungkan dengan tabel selling_invoices dan users
        $invoices = DB::table('invoice_summary')
            ->leftJoin('selling_invoices', 'invoice_summary.invoice_code', '=', 'selling_invoices.invoice_code') // Gabungkan dengan selling_invoices
            ->leftJoin('users', 'selling_invoices.cashier_id', '=', 'users.id') // Gabungkan dengan users
            ->select(
                'invoice_summary.*', // Semua kolom dari invoice_summary
                'selling_invoices.cashier_id', // Ambil cashier_id dari selling_invoices
                DB::raw("CONCAT(users.nama_depan, ' ', users.nama_belakang) as cashier_name") // Gabungkan nama depan dan belakang dari users
            )
            ->whereIn('invoice_summary.invoice_code', $invoiceSummary->pluck('invoice_code')) // Filter berdasarkan hasil dari prosedur
            ->get();

        // Hitung total amount
        $invoiceTotal = $invoices->where('order_status', 'Complete')->sum('total_amount');

        // Tampilkan ke view
        return view('owner.pages.transaction-report.transaction-by-time', compact('invoices', 'invoiceTotal', 'selectedMonth', 'selectedYear'));
    }


}
