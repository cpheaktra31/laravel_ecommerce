<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        return view('layouts.dashboard');
    }

    public function getMonthlyStock() {
        try {
            // Get total of stock-in in current month
            $in_current_month = 0;
            // Get total of stock-out in current month
            $out_current_month = 0;
            // Get total of expiry-alert in current month
            $alert_ext_current_month = 0;
            // Get total of expiry current month
            $expiry_current_month = 0;

            // Sumary data
            $data = [
                'in_current_month' => $in_current_month->total_import ?? 0,
                'out_current_month' => $out_current_month->total_export ?? 0,
                'alert_ext_current_month' => $alert_ext_current_month->total_alert_expiry ?? 0,
                'expiry_current_month' => $expiry_current_month->total_expiry ?? 0
            ];
            return response()->json([
                'status' => 'success',
                'result' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'result' => $th->getMessage()
            ]);
        }
    }

    public function getProductExpire() {
        try {
            $sql = "SELECT * FROM products
                WHERE deleted_at IS NULL
                ORDER BY id DESC";
            $data = DB::select($sql);

            return response()->json([
                'status' => 'success',
                'message' => 'Getting product success!',
                'result' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'result' => $th->getMessage()
            ]);
        }
    }
}
