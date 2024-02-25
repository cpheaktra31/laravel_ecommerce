<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*______________
    |   Index
    */
    public function index()
    {
        return view('admin.blogs.index');
    }

    /*______________
    |   Get Data
    */
    public function getData()
    {
        try {
            $sql = "SELECT * FROM blogs WHERE deleted_at IS NULL ORDER BY is_active, id DESC";
            $data = DB::select($sql);

            return response()->json([
                'status' => 'success',
                'message' => 'Getting blog success!',
                'result' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Getting blog error!',
                'result' => $th->getMessage()
            ]);
        }
    }

    /*______________
    |   Create
    */
    public function create()
    {
        //
    }

    /*______________
    |   Store
    */
    public function store(Request $request)
    {
        try {
            $validator = Validator($request->all(), [
                'title_kh' => 'required',
                'title_en' => 'required',
                'featured_image' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Adding slide error!',
                    'result' => $validator->getMessageBag()
                ]);
            }
            $data = $request->all();

            if ($request->hasFile('featured_image')) {
                $fileName = $request->file('featured_image')->getClientOriginalName();
                $filePath = public_path($fileName);
                // Remove the old file if it exists
                if (is_file(file_exists($filePath))) {
                    unlink($filePath);
                }
                $currentMonth = Carbon::now()->format('m');
                $path = $request->file('featured_image')->storeAs('images/blog/' . $currentMonth, $fileName, 'public');
                $data['featured_image'] = '/storage/' . $path;
            } else {
                $data['featured_image'] = null;
            }

            Blog::create($data);

            $blogs = Blog::withoutTrashed()->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Adding blog success!',
                'result' => $blogs
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Adding blog error!',
                'result' => $th->getMessage(),
            ]);
        }
    }

    /*______________
    |   Show
    */
    public function show(Blog $blog)
    {
        //
    }

    /*______________
    |   Edit
    */
    public function edit(Blog $blog)
    {
        $data = Blog::find($blog->id);
        return response()->json([
            'status' => 'success',
            'message' => 'Editing blog success!',
            'result' => $data
        ]);
    }

    /*______________
    |   Update
    */
    public function update(Request $request, Blog $blog)
    {
        try {
            $validator = Validator::make($request->all(), [
                'title_en' => 'required',
                'title_kh' => 'required',
                'featured_image' => 'nullable|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'result' => $validator->getMessageBag(),
                ]);
            }

            $data = Blog::find($blog->id);

            // Check if the image file is provided
            if ($request->hasFile('featured_image')) {
                $filePath = public_path($data->featured_image);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
                $currentMonth = Carbon::now()->format('m');
                $fileName = $request->file('featured_image')->getClientOriginalName();
                $path = $request->file('featured_image')->storeAs('images/blog/' . $currentMonth, $fileName, 'public');
                $data->featured_image = '/storage/' . $path;
            }

            $data->title_en = $request->title_en;
            $data->title_kh = $request->title_kh;

            $data->save();

            $blogs = Blog::withoutTrashed()->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Updating blog success!',
                'result' => $blogs,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'result' => $th->getMessage(),
            ]);
        }
    }

    /*______________
    |   Destroy
    */
    public function destroy(Blog $blog)
    {
        $data = Blog::find($blog->id);
        $data->delete();
        return response()->json([
            'status' => 'success',
            'message' => "Deleting " . $data['title_en'] . " slide success!",
            'result' => $data
        ]);
    }

    /*______________
    |   Active Button
    */
    public function btnActive($id)
    {
        try {
            $item = Blog::find($id);
            $is_active = $item['is_active'];
            $status = "success";
            $msg = "Blog " . $item['title_en'] . " is active!";
            if ($is_active == 1) {
                $is_active = 0;
                $status = "warning";
                $msg = "Blog " . $item['title_en'] . " is in-active!";
            } else
                $is_active = 1;

            $item['is_active'] = $is_active;
            $item->save();

            $blogs = Blog::withoutTrashed()->get();
            return response()->json([
                'status' => $status,
                'message' => $msg,
                'result' => $blogs
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Updating blog error!',
                'result' => $th->getMessage(),
            ]);
        }
    }
}
