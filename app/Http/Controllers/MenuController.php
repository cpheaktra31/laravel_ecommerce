<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function dataList(Request $request)
    {
        $query = Menu::query();
        // Search
        if ($request->has('search') && !empty($request->search['value'])) {
            $searchValue = $request->search['value'];
            $query->where(function ($q) use ($searchValue) {
                $q->where('name_kh', 'like', "%$searchValue%")
                  ->orWhere('name_en', 'like', "%$searchValue%");
            });
        }

        // Get total after filtered
        $total = $query->where('deleted_at', null)->count();

        $req_order = $request->order;
        // Sorting
        if(isset($req_order)) {
            $sortColumn = $request->columns[$req_order[0]['column']]['name'];
            $sortDirection = $req_order[0]['dir'];
            if ($sortColumn && $sortDirection) {
                $query->orderBy($sortColumn, $sortDirection);
            }
        }

        // Pagination
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);
        $query->skip($start)->take($length);

        $data = $query->where('deleted_at', null)->get();

        return [
            'draw' => $request->input('draw', 1),
            'recordsTotal' => $total,
            'recordsFiltered' => $total,
            'data' => $data
        ];
    }

    /*______________
    |   Index
    */
    public function index(Request $request)
    {
        $menu_types = DB::select("SELECT * FROM menu_type WHERE deleted_at IS NULL ORDER BY id DESC");
        return view('admin.menu.index', compact('menu_types'));
    }

    /*______________
    |   Get Data
    */
    public function getData(Request $request)
    {
        try {
            // $sql = "SELECT * FROM menus WHERE deleted_at IS NULL ORDER BY ordering, id DESC";
            // $data = DB::select($sql);

            $data = $this->dataList($request);
            $data['status'] = 'success';
            $data['icon'] = 'success';

            return response()->json(
                $data
            );
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Getting menu error!',
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
                'name_en' => 'required',
                'name_kh' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Adding slide error!',
                    'result' => $validator->getMessageBag()
                ]);
            }
            $data = $request->all();
            $random_num = random_int(100000, 999999);
            $slug_adding = "";

            if ($data['name_en']) {
                // Create slug_en
                $cur_slug_en = preg_replace("/[~`{}.'\"!@#\$%^&*()_=\+\/\?<>,\[\]:;៖«» \|\\\\]/u", "-", $data['name_en']);
                $old_slug_en = Menu::where('slug_en', $cur_slug_en)->first();

                if ($old_slug_en)
                    $slug_adding = "-" . $random_num;

                $data['slug_en'] = preg_replace("/[~`{}.'\"!@#\$%^&*()_=\+\/\?<>,\[\]:;៖«» \|\\\\]/u", "-", $data['name_en'] . $slug_adding);
            }

            if ($data['name_kh']) {
                // Create slug_en
                $cur_slug_kh = preg_replace("/[~`{}.'\"!@#\$%^&*()_=\+\/\?<>,\[\]:;៖«» \|\\\\]/u", "-", $data['name_kh']);
                $old_slug_kh = Menu::where('slug_kh', $cur_slug_kh)->first();

                if ($old_slug_kh)
                    $slug_adding = "-" . $random_num;

                $data['slug_kh'] = preg_replace("/[~`{}.'\"!@#\$%^&*()_=\+\/\?<>,\[\]:;៖«» \|\\\\]/u", "-", $data['name_kh'] . $slug_adding);
            }

            Menu::create($data);

            $menu = Menu::withoutTrashed()->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Adding menu success!',
                'result' => $menu
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => 'Adding menu error!',
                'result' => $th->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /*______________
    |   Edit
    */
    public function edit(Menu $menu)
    {
        $data = Menu::find($menu->id);
        return response()->json([
            'status' => 'success',
            'message' => 'Getting menu success!',
            'result' => $data
        ]);
    }

    /*______________
    |   Update
    */
    public function update(Request $request, Menu $menu)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name_en' => 'required',
                'name_kh' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'result' => $validator->getMessageBag(),
                ]);
            }

            $data = Menu::find($menu->id);

            $data->name_en = $request->name_en;
            $data->name_kh = $request->name_kh;
            $data->menu_type = $request->menu_type;
            $data->type = $request->type;
            $data->url = $request->url;
            $data->ordering = $request->ordering;

            $data->save();

            $menus = Menu::withoutTrashed()->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Updating menu success!',
                'result' => $menus,
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
    public function destroy(Menu $menu)
    {
        $data = Menu::find($menu->id);
        $data->delete();
        return response()->json([
            "status" => "success",
            "message" => "Deleting menu ".$data->name_en." success!",
            "result" => $data
        ]);
    }
}
