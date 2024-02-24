<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class SlideController extends Controller
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
        $slides = Slide::withoutTrashed()->get();
        return view('admin.slides.index', compact('slides'));
    }

    /*______________
    |   Get Data
    */
    public function getData()
    {
        try {
            $sql = "SELECT * FROM slides WHERE deleted_at IS NULL ORDER BY is_promotion, is_active, ordering DESC";
            $data = DB::select($sql);

            return response()->json([
                'status' => 'success',
                'message' => 'Getting slide success!',
                'result' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Getting slide error!',
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
                'image' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Adding slide error!',
                    'result' => $validator->getMessageBag()
                ]);
            }
            $data = $request->all();

            // $data['is_active'] = $request->is_active ?? 0;
            // $data['is_promotion'] = $request->is_promotion ?? 0;
            $data['ordering'] = $request->is_active ?? 0;

            if ($request->hasFile('image')) {
                $fileName = $request->file('image')->getClientOriginalName();
                $filePath = public_path($fileName);
                // Remove the old file if it exists
                if (is_file(file_exists($filePath))) {
                    unlink($filePath);
                }
                $currentMonth = Carbon::now()->month;
                $path = $request->file('image')->storeAs('images/slides/' . $currentMonth, $fileName, 'public');
                $data['image'] = '/storage/' . $path;
            } else {
                $data['image'] = null;
            }

            if ($request->hasFile('background')) {
                $fileName = $request->file('background')->getClientOriginalName();
                $filePath = public_path($fileName);
                // Remove the old file if it exists
                if (is_file(file_exists($filePath))) {
                    unlink($filePath);
                }
                $currentMonth = Carbon::now()->month;
                $path = $request->file('background')->storeAs('images/slides/' . $currentMonth, $fileName, 'public');
                $data['background'] = '/storage/' . $path;
            } else {
                $data['background'] = null;
            }

            Slide::create($data);

            $slides = Slide::withoutTrashed()->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Adding slide success!',
                'result' => $slides
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Adding slide error!',
                'result' => $th->getMessage(),
            ]);
        }
    }

    /*______________
    |   Show
    */
    public function show(Slide $slide)
    {
        //
    }

    /*______________
    |   Edit
    */
    public function edit(Slide $slide)
    {
        $data = Slide::find($slide->id);
        return response()->json([
            'status' => 'success',
            'message' => 'Editing slide success!',
            'result' => $data
        ]);
    }

    /*______________
    |   Update
    */
    public function update(Request $request, Slide $slide)
    {
        try {
            $validator = Validator($request->all(), [
                'title_kh' => 'required',
                'title_en' => 'required',
                'image' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Adding slide error!',
                    'result' => $validator->getMessageBag()
                ]);
            }

            $data = Slide::find($slide->id);

            $data->title_en = $request->title_en;
            $data->title_kh = $request->title_kh;
            $data->short_info_en = $request->short_info_en;
            $data->short_info_kh = $request->short_info_kh;
            $data->url = $request->url;
            // $data->is_active = $request->is_active;
            $data->ordering = $request->ordering;

            if ($request->hasFile('image')) {
                $filePath = public_path($data->image);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
                $currentMonth = Carbon::now()->month;
                $fileName = $request->file('image')->getClientOriginalName();
                $path = $request->file('image')->storeAs('images/slides/' . $currentMonth, $fileName, 'public');
                $data->image = '/storage/' . $path;
            }

            if ($request->hasFile('background')) {
                $filePath = public_path($data->background);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
                $currentMonth = Carbon::now()->month;
                $fileName = $request->file('background')->getClientOriginalName();
                $path = $request->file('background')->storeAs('images/slides/' . $currentMonth, $fileName, 'public');
                $data->background = '/storage/' . $path;
            }

            $data->save();

            $slides = Slide::withoutTrashed()->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Updating slide success!',
                'result' => $slides
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Updating slide error!',
                'result' => $th->getMessage(),
            ]);
        }
    }

    /*______________
    |   Destroy
    */
    public function destroy(Slide $slide)
    {
        $data = Slide::find($slide->id);
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
            $slide = Slide::find($id);
            $is_active = $slide['is_active'];
            $status = "success";
            $msg = "Slide " . $slide['title_en'] . " is active!";
            if ($is_active == 1) {
                $is_active = 0;
                $status = "warning";
                $msg = "Slide " . $slide['title_en'] . " is in-active!";
            } else
                $is_active = 1;

            $slide['is_active'] = $is_active;
            $slide->save();

            $slides = Slide::withoutTrashed()->get();
            return response()->json([
                'status' => $status,
                'message' => $msg,
                'result' => $slides
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Updating slide error!',
                'result' => $th->getMessage(),
            ]);
        }
    }
    public function btnPromotion($id)
    {
        try {
            $slide = Slide::find($id);
            $is_promotion = $slide['is_promotion'];
            $status = "success";
            $msg = "Slide " . $slide['title_en'] . " add to promotion!";
            if ($is_promotion == 1) {
                $is_promotion = 0;
                $status = "warning";
                $msg = "Slide " . $slide['title_en'] . " remove from promotion!";
            } else
                $is_promotion = 1;

            $slide['is_promotion'] = $is_promotion;
            $slide->save();

            $slides = Slide::withoutTrashed()->get();
            return response()->json([
                'status' => $status,
                'message' => $msg,
                'result' => $slides
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Updating slide error!',
                'result' => $th->getMessage(),
            ]);
        }
    }
}
