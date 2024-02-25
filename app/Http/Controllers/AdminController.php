<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function index(Request $request) {
        if (Auth::check()) {
            // Get the currently authenticated user
            $user = Auth::user();
        }
        return view('users.index', compact('user'));
    }

    public function getData() {
        try {
            $sql = "SELECT * FROM users WHERE deleted_at IS NULL";
            $data = DB::select($sql);

            return response()->json([
                'status' => 'success',
                'message' => 'Get user success!',
                'result' => $data
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'result' => $th->getMessage()
            ]);
        }
    }

    public function editUser(User $user)
    {
        $data = User::find($user->id);
        return response()->json([
            'status' => 'success',
            'message' => 'Get user success!',
            'result' => $data
        ]);
    }

    public function storeUser(Request $request)
    {
        try {
            $validator = Validator($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'result' => $validator->getMessageBag()
                ]);
            }
            if($request->password != $request->confirm_password) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Password not match',
                    'result' => $users
                ]);
            }
            $data = $request->all();
            if ($request->hasFile('image')) {
                $fileName = $request->file('image')->getClientOriginalName();
                $filePath = public_path($fileName);
                // Remove the old file if it exists
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
                $path = $request->file('image')->storeAs('images/users', $fileName, 'public');
                $data['image'] = '/storage/'.$path;
            } else {
                $data['image'] = null;
            }

            $data['password'] = bcrypt($data['password']);

            User::create($data);

            $users = User::withoutTrashed()->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Add user success!',
                'result' => $users
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'result' => $th->getMessage()
            ]);
        }
    }

    public function updateUser(Request $request, User $user)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'result' => $validator->getMessageBag(),
                ]);
            }

            $data = User::find($user->id);

            // Check if the image file is provided
            if ($request->hasFile('image')) {
                $filePath = public_path($data->image);
                if (File::exists($filePath)) {
                    File::delete($filePath);
                }
                $fileName = $request->file('image')->getClientOriginalName();
                $path = $request->file('image')->storeAs('images', $fileName, 'public');
                $data->image = '/storage/' . $path;
            }

            $data->name = $request->name;
            $data->email = $request->email;
            $data->save();

            $users = User::withoutTrashed()->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Update user success!',
                'result' => $users,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'result' => $th->getMessage(),
            ]);
        }
    }

    public function changePassword(Request $request, User $user)
    {
        try {
            $validator = Validator::make($request->all(), [
                'password' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'result' => $validator->getMessageBag(),
                ]);
            }

            $data = User::find($user->id);
            $data->password = bcrypt($request->password);
            $data->save();

            $users = User::withoutTrashed()->get();
            return response()->json([
                'status' => 'success',
                'message' => 'Updating product success!',
                'result' => $users,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'result' => $th->getMessage(),
            ]);
        }
    }

    public function deleteUser(User $user)
    {
        $data = User::find($user->id);
        $data->forceDelete();
        return response()->json([
            'status' => 'success',
            'message' => 'Deleting user success!',
            'result' => $data
        ]);
    }
}
