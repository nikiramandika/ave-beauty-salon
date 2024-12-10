<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class OwnerController extends Controller
{
    public function getDashboardData(Request $request)
    {
        // Produk yang paling banyak dipesan, hanya yang memiliki product_name tidak null
        $topProducts = DB::table('invoice_summary')
            ->join('selling_invoice_details', 'invoice_summary.selling_invoice_id', '=', 'selling_invoice_details.invoice_id')
            ->select('selling_invoice_details.product_name', DB::raw('SUM(selling_invoice_details.quantity) as total_quantity'))
            ->whereNotNull('selling_invoice_details.product_name') // Filter agar product_name tidak null
            ->groupBy('selling_invoice_details.product_name')
            ->orderBy('total_quantity', 'desc')
            ->take(5) // Mengambil 5 produk teratas
            ->get();

        // Pastikan topProducts memiliki data yang valid
        $topProducts = $topProducts->map(function ($product) {
            return [
                'product_name' => $product->product_name,
                'total_quantity' => (int) $product->total_quantity,
            ];
        });

        // Ambil data status pesanan
        $orderStatusCounts = DB::table('invoice_summary')
            ->select('order_status', DB::raw('COUNT(*) as count'))
            ->whereIn('order_status', ['complete', 'pending', 'refund']) // Hanya status yang relevan
            ->groupBy('order_status')
            ->get()
            ->mapWithKeys(function ($item) {
                // Pastikan status dalam huruf kecil
                $status = strtolower($item->order_status);
                return [$status => $item->count]; // Mengambil 'count' dengan key 'order_status' dalam huruf kecil
            });

        // Pastikan orderStatusCounts memiliki nilai yang valid, mirip seperti topProducts
        $orderStatusCounts = collect([
            'complete' => 0,
            'pending' => 0,
            'refund' => 0,
        ])->merge($orderStatusCounts); // Menggabungkan hasil query dengan nilai default 0 jika tidak ada

        // Ambil jumlah user aktif
        $activeUsersCount = DB::table('users')
            ->where('is_active', 1)
            ->count();

        // Ambil jumlah anggota aktif
        $activeMembersCount = DB::table('members')
            ->where('is_active', 1)
            ->count();

        // Ambil total pendapatan tahunan (menggunakan stored procedure atau query lain)
        $currentYearRevenue = DB::select("CALL GetTotalAmount('yearly')")[0]->total_amount ?? 0;

        // Ambil total pendapatan tahun sebelumnya menggunakan query manual
        $previousYearRevenue = DB::table('invoice_summary')
            ->whereYear('order_date', now()->year - 1)  // Filter untuk tahun sebelumnya
            ->where('order_status', 'Complete')  // Status hanya yang "Complete"
            ->sum('total_amount');

        // Hitung persentase perubahan pendapatan
        $percentageChange = $previousYearRevenue == 0
            ? 100  // Jika tahun sebelumnya 0, set persentase perubahan 100%
            : (($currentYearRevenue - $previousYearRevenue) / $previousYearRevenue) * 100;

        // Kirim data ke view
        return view('owner.index', compact(
            'activeUsersCount',
            'currentYearRevenue',
            'previousYearRevenue',
            'percentageChange',
            'topProducts',
            'orderStatusCounts',
            'activeMembersCount'  // Mengirim jumlah anggota aktif
        ));
    }


}
