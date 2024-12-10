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


}
