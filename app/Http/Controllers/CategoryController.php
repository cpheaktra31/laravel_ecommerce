<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }

    public function getData() {
        try {
            $data = Category::withoutTrashed()->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Getting category success!',
                'result' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Getting category error!',
                'result' => $th->getMessage()
            ]);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator($request->all(), [
                'name_kh' => 'required',
                'name_en' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Adding category error!',
                    'result' => $validator->getMessageBag()
                ]);
            }
            $data = $request->all();

            Category::create($data);

            $categories = Category::withoutTrashed()->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Adding category success!',
                'result' => $categories
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Adding category error!',
                'result' => $th->getMessage(),
            ]);
        }
    }

    public function show(Category $category)
    {
        //
    }

    public function edit(Category $category)
    {
        try {
            $data = Category::find($category->id);
            return response()->json([
                'status' => 'success',
                'message' => 'Updating category success!',
                'result' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Updating category error!',
                'result' => $th->getMessage(),
            ]);
        }
    }

    public function update(Request $request, Category $category)
    {
        try {
            $validator = Validator($request->all(), [
                'name_kh' => 'required',
                'name_en' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Updating category error!',
                    'result' => $validator->getMessageBag()
                ]);
            }

            $data = Category::find($category->id);
            $data['name_kh'] = $request->name_kh;
            $data['name_en'] = $request->name_en;
            $data->update();

            $categories = Category::withoutTrashed()->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Updating category success!',
                'result' => $categories
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Updating category error!',
                'result' => $th->getMessage()
            ]);
        }
    }

    public function destroy(Category $category)
    {
        try {
            $data = Category::find($category->id);
            $data->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Deleting category success!',
                'result' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Deleting category error!',
                'result' => $th->getMessage()
            ]);
        }
    }

    public function archived() {
        $data = Category::onlyTrashed()->get();
        return view('admin.category.archived', compact('data'));
    }

    public function restore($category) {
        $data = Category::onlyTrashed()->find($category);
        $data->restore();
        return back();
    }

    public function forcedelete($category) {
        $data = Category::onlyTrashed()->find($category);

        $data->forcedelete();
        return back();
    }
}
