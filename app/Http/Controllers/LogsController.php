<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogsController extends Controller
{
    // Menampilkan Member Logs
    public function memberLogs()
    {
        $logs = DB::table('member_logs')
            ->leftJoin('users as cashier', 'member_logs.cashier_id', '=', 'cashier.id') // Join untuk kasir
            ->leftJoin('users as user', 'member_logs.user_id', '=', 'user.id') // Join untuk user
            ->select(
                'member_logs.*',
                'cashier.nama_depan as cashier_first_name',
                'cashier.nama_belakang as cashier_last_name',
                'user.nama_depan as user_first_name',
                'user.nama_belakang as user_last_name'
            )
            ->orderBy('member_logs.log_time', 'desc')
            ->get();

        return view('owner.pages.logs.member-logs', compact('logs'));
    }


    public function refundLogs()
    {
        $logs = DB::table('refund_logs')
            ->leftJoin('users', 'refund_logs.cashier_id', '=', 'users.id') // Join dengan tabel users untuk kasir
            ->leftJoin('refunds', 'refund_logs.new_refund_id', '=', 'refunds.refund_id') // Join dengan tabel refunds
            ->select(
                'refund_logs.*',
                'users.nama_depan',
                'users.nama_belakang',
                'refunds.refund_status' // Ambil refund_status dari tabel refunds
            )
            ->orderBy('refund_logs.log_time', 'desc')
            ->get();

        return view('owner.pages.logs.refund-logs', compact('logs'));
    }


    public function orderStatusLogs()
    {
        $logs = DB::table('order_status_logs')
            ->leftJoin('users', 'order_status_logs.cashier_id', '=', 'users.id') // Join dengan tabel users
            ->select('order_status_logs.*', 'users.nama_depan', 'users.nama_belakang') // Pilih kolom yang dibutuhkan
            ->orderBy('order_status_logs.log_time', 'desc')
            ->get();

        return view('owner.pages.logs.order-status-logs', compact('logs'));
    }

}
