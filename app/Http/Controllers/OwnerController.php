<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
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

        // Produk yang paling banyak dipesan berdasarkan kategori
        $topProductByCategory = DB::table('invoice_summary')
            ->join('selling_invoice_details', 'invoice_summary.selling_invoice_id', '=', 'selling_invoice_details.invoice_id')
            ->select('selling_invoice_details.product_name', DB::raw('SUM(selling_invoice_details.quantity) as total_quantity'))
            ->whereNotNull('selling_invoice_details.product_name') // Filter agar product_name tidak null
            ->groupBy('selling_invoice_details.product_name')
            ->orderBy('total_quantity', 'desc')
            ->take(10) // Mengambil 5 produk teratas
            ->get();

        // Memproses data untuk mendapatkan kategori produk
        $topProductByCategory = $topProductByCategory->map(function ($product) {
            // Menghilangkan bagian dalam tanda kurung (misal: Size: 500ml)
            $productName = preg_replace('/\s*\(.*?\)\s*/', '', $product->product_name);

            // Mengambil category_id berdasarkan product_name
            $category = DB::table('products')
                ->join('categories', 'products.category_id', '=', 'categories.category_id')  // Gunakan category_id di sini
                ->select('categories.category_name')
                ->where('products.product_name', 'like', '%' . $productName . '%')  // Mencocokkan produk
                ->first();

            // Mengembalikan data produk dan kategori
            return [
                'product_name' => $productName,
                'total_quantity' => (int) $product->total_quantity,
                'category_name' => $category ? $category->category_name : 'Unknown Category',
            ];
        });

        // Mengelompokkan hasil berdasarkan category_name dan menjumlahkan total kuantitas
        $groupedByCategory = $topProductByCategory->groupBy('category_name')->map(function ($group) {
            return [
                'category_name' => $group[0]['category_name'],
                'total_quantity' => $group->sum('total_quantity'),
            ];
        });

        // Mengurutkan berdasarkan total_quantity dan mengambil 5 kategori teratas
        $topProductByCategory = $groupedByCategory->sortByDesc('total_quantity')->take(5);

        $currentYear = Carbon::now()->year; // Tahun sekarang

        $incomeData = DB::table('invoice_summary')
            ->select(
                DB::raw('MONTH(order_date) as month'), // Ambil bulan
                DB::raw('SUM(total_amount) as total_income') // Hitung total pendapatan
            )
            ->whereYear('order_date', $currentYear) // Filter berdasarkan tahun sekarang
            ->where('order_status', 'complete') // Filter berdasarkan order_status yang complete
            ->groupBy(DB::raw('MONTH(order_date)')) // Grup berdasarkan bulan
            ->orderBy(DB::raw('MONTH(order_date)')) // Urutkan berdasarkan bulan
            ->get();

        $months = $incomeData->pluck('month'); // Ambil bulan (1-


        $months = $incomeData->pluck('month'); // Mengambil bulan (1-12)
        $totals = $incomeData->pluck('total_income'); // Mengambil total pendapatan per bulan

        $totalSum = $totals->sum(); // Hitung total semua pendapatan

        // 2. Hitung Persentase Kenaikan dari Bulan Sebelumnya
        $percentageChange2 = null; // Default jika tidak ada data cukup untuk menghitung
        if ($totals->count() >= 2) {
            $currentMonthIncome = $totals->last(); // Pendapatan bulan terakhir
            $previousMonthIncome = $totals->slice(-2, 1)->first(); // Pendapatan bulan sebelumnya

            $percentageChange = $previousMonthIncome > 0
                ? (($currentMonthIncome - $previousMonthIncome) / $previousMonthIncome) * 100
                : null; // Hindari pembagian dengan 0
        }

        // 3. Hitung Pendapatan Mingguan
        $currentWeekStart = Carbon::now()->startOfWeek(); // Awal minggu ini
        $currentWeekEnd = Carbon::now()->endOfWeek(); // Akhir minggu ini

        $lastWeekStart = Carbon::now()->subWeek()->startOfWeek(); // Awal minggu lalu
        $lastWeekEnd = Carbon::now()->subWeek()->endOfWeek(); // Akhir minggu lalu

        $incomeThisWeek = DB::table('invoice_summary')
            ->whereBetween('order_date', [$currentWeekStart, $currentWeekEnd])
            ->sum('total_amount'); // Total pendapatan minggu ini

        $incomeLastWeek = DB::table('invoice_summary')
            ->whereBetween('order_date', [$lastWeekStart, $lastWeekEnd])
            ->sum('total_amount'); // Total pendapatan minggu lalu

        $difference = $incomeThisWeek - $incomeLastWeek; // Selisih pendapatan minggu ini vs minggu lalu

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

        // Mengambil jumlah pendaftaran kursus untuk bulan ini
        $totalRegisterCourseThisMonth = DB::table('course_registrations')
            ->join('selling_invoices', 'course_registrations.invoice_code', '=', 'selling_invoices.invoice_code')
            ->where('selling_invoices.order_status', 'complete')
            ->whereMonth('selling_invoices.order_date', Carbon::now()->month)
            ->whereYear('selling_invoices.order_date', Carbon::now()->year)
            ->count();

        // Mengambil jumlah pendaftaran kursus untuk bulan sebelumnya
        $totalRegisterCourseLastMonth = DB::table('course_registrations')
            ->join('selling_invoices', 'course_registrations.invoice_code', '=', 'selling_invoices.invoice_code')
            ->where('selling_invoices.order_status', 'complete')
            ->whereMonth('selling_invoices.order_date', Carbon::now()->subMonth()->month)
            ->whereYear('selling_invoices.order_date', Carbon::now()->subMonth()->year)
            ->count();

        // Menghitung persentase perubahan
// Menghitung persentase perubahan
        $percentageChange1 = 0;

        if ($totalRegisterCourseLastMonth > 0) {
            // Jika bulan sebelumnya ada data, hitung persentase perubahan
            $percentageChange1 = (($totalRegisterCourseThisMonth - $totalRegisterCourseLastMonth) / $totalRegisterCourseLastMonth) * 100;
        } elseif ($totalRegisterCourseLastMonth == 0 && $totalRegisterCourseThisMonth > 0) {
            // Jika bulan sebelumnya 0 dan bulan ini ada data, kenaikan dianggap 100%
            $percentageChange1 = 100;
        }

        // Format persentase sebagai positif atau negatif
        $percentageChangeFormatted = $percentageChange1 > 0 ? '+' . round($percentageChange1) : round($percentageChange1);



        $currentMonth = Carbon::now()->format('F Y'); // Format bulan dan tahun (contoh: "December 2024")

        // Kirim data ke view
        return view('owner.index', compact(
            'activeUsersCount',
            'currentYearRevenue',
            'previousYearRevenue',
            'percentageChange',
            'percentageChange2',
            'topProducts',
            'orderStatusCounts',
            'activeMembersCount',  // Mengirim jumlah anggota aktif
            'topProductByCategory',
            'months',
            'totals',
            'totalSum',
            'incomeThisWeek',
            'difference',
            'totalRegisterCourseThisMonth',
            'currentMonth',
            'percentageChangeFormatted'
        ));
    }


}
