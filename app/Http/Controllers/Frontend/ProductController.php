<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class ProductController extends Controller
{
    /*______________
    |   Get Feature Product
    */
    public function getFeatureProduct(Request $request)
    {
        try {
            $data = DB::select("SELECT p.*,
                    c.name_en AS category_name_en,
                    c.name_kh AS category_name_kh
                    FROM products p
                    JOIN categories c ON p.category_id = c.id
                    WHERE p.deleted_at IS NULL
                    AND c.deleted_at IS NULL
                    AND p.is_active = 1
                    AND p.is_feature = 1
                    ORDER BY p.id DESC");

            return response()->json([
                'success' => true,
                'message' => 'Getting product success!',
                'result' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Getting product error!',
                'result' => $th->getMessage(),
            ]);
        }
    }

    /*______________
    |   Get Latest Product
    */
    public function getLatestProduct(Request $request)
    {
        try {
            $data = DB::select("SELECT * FROM products
                WHERE deleted_at IS NULL
                AND is_active = 1
                ORDER BY id DESC");

            return response()->json([
                'success' => true,
                'message' => 'Getting product success!',
                'result' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Getting product error!',
                'result' => $th->getMessage(),
            ]);
        }
    }
}
