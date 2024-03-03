<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class SlideController extends Controller
{
    /*______________
    |   Get Heroes
    */
    public function getHeroes(Request $request)
    {
        try {
            $data = DB::select("SELECT * FROM slides WHERE deleted_at IS NULL AND is_active = 1");

            return response()->json([
                'success' => true,
                'message' => 'Getting slide success!',
                'result' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Getting slide error!',
                'result' => $th->getMessage(),
            ]);
        }
    }

    /*______________
    |   Get Promotion
    */
    public function getPromotion(Request $request)
    {
        try {
            $data = DB::select("SELECT * FROM slides WHERE deleted_at IS NULL AND is_active = 1 AND is_promotion = 1");

            return response()->json([
                'success' => true,
                'message' => 'Getting slide success!',
                'result' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Getting slide error!',
                'result' => $th->getMessage(),
            ]);
        }
    }
}
