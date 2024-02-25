<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class ProductController extends Controller
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
        $categories = Category::withoutTrashed()->get();
        return view('admin.products.index', compact('categories'));
    }

    /*______________
    |   Get Data
    */
    public function getData() {
        try {
            $sql = "SELECT *, c.name_en AS catNameEn, c.name_kh AS catNameKH
                FROM products p
                JOIN categories c ON p.category_id = c.id
                WHERE p.deleted_at IS NULL
                ORDER BY p.id DESC";
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

    /*______________
    |   Create
    */
    public function create()
    {
        $categories = Category::withoutTrashed()->get();
        return view('admin.products.form', compact('categories'));
    }

    /*______________
    |   Store
    */
    public function store(Request $request)
    {
        try {
            $validator = Validator($request->all(), [
                'name_en' => 'required',
                'name_kh' => 'required',
                'category_id' => 'required',
                'price' => 'required',
                'description_en' => 'required',
                'description_kh' => 'required',
                'featured_image' => 'nullable|image|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'result' => $validator->getMessageBag()
                ]);
            }

            $data = $request->all();
            $random_num = random_int(100000, 999999);
            $slug_adding = "";

            if ($data['name_en']) {
                // Create slug_en
                $cur_slug_en = preg_replace("/[~`{}.'\"!@#\$%^&*()_=\+\/\?<>,\[\]:;៖«» \|\\\\]/u", "-", $data['name_en']);
                $old_slug_en = Product::where('slug_en', $cur_slug_en)->first();

                if ($old_slug_en)
                    $slug_adding = "-" . $random_num;

                $data['slug_en'] = preg_replace("/[~`{}.'\"!@#\$%^&*()_=\+\/\?<>,\[\]:;៖«» \|\\\\]/u", "-", $data['name_en'] . $slug_adding);
            }

            if ($data['name_kh']) {
                // Create slug_en
                $cur_slug_kh = preg_replace("/[~`{}.'\"!@#\$%^&*()_=\+\/\?<>,\[\]:;៖«» \|\\\\]/u", "-", $data['name_kh']);
                $old_slug_kh = Product::where('slug_kh', $cur_slug_kh)->first();

                if ($old_slug_kh)
                    $slug_adding = "-" . $random_num;

                $data['slug_kh'] = preg_replace("/[~`{}.'\"!@#\$%^&*()_=\+\/\?<>,\[\]:;៖«» \|\\\\]/u", "-", $data['name_kh'] . $slug_adding);
            }

            if ($request->hasFile('featured_image')) {
                $fileName = $request->file('featured_image')->getClientOriginalName();
                $filePath = public_path($fileName);
                // Remove the old file if it exists
                if (is_file(file_exists($filePath))) {
                    unlink($filePath);
                }
                $currentMonth = Carbon::now()->format('m');
                $path = $request->file('featured_image')->storeAs('images/product/'.$currentMonth, $fileName, 'public');
                $data['featured_image'] = '/storage/'.$path;
            } else {
                $data['featured_image'] = null;
            }

            Product::create($data);

            $products = Product::withoutTrashed()->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Adding product success!',
                'result' => $products
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'result' => $th->getMessage()
            ]);
        }
    }

    /*______________
    |   Show
    */
    public function show(Product $product)
    {
        //
    }

    /*______________
    |   Edit
    */
    public function edit(Product $product)
    {
        $data = Product::find($product->id);
        return response()->json([
            'status' => 'success',
            'message' => 'Adding product success!',
            'result' => $data
        ]);
    }

    /*______________
    |   Update
    */
    public function update(Request $request, Product $product)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name_en' => 'required',
                'name_kh' => 'required',
                'category_id' => 'required',
                'featured_image' => 'nullable|image|max:2048',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'result' => $validator->getMessageBag(),
                ]);
            }

            $data = Product::find($product->id);

            // Check if the image file is provided
            if ($request->hasFile('featured_image')) {
                $filePath = public_path($data->featured_image);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
                $currentMonth = Carbon::now()->format('m');
                $fileName = $request->file('featured_image')->getClientOriginalName();
                $path = $request->file('featured_image')->storeAs('images/product/'.$currentMonth, $fileName, 'public');
                $data->featured_image = '/storage/' . $path;
            }

            $data->name_en = $request->name_en;
            $data->name_kh = $request->name_kh;
            $data->category_id = $request->category_id;

            $data->save();

            $products = Product::withoutTrashed()->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Updating product success!',
                'result' => $products,
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
    public function destroy(Product $product)
    {
        $data = Product::find($product->id);
        $data->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Deleting product success!',
            'result' => $data
        ]);
    }
}
