<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class BlogController extends Controller
{
    /*______________
    |   Get Blogs
    */
    public function getBlogs(Request $request)
    {
        try {
            $data = DB::select("SELECT * FROM blogs WHERE deleted_at IS NULL AND is_active = 1 ORDER BY id DESC");

            return response()->json([
                'success' => true,
                'message' => 'Getting blog success!',
                'result' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Getting blog error!',
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
