<?php

namespace App\Http\Controllers\Admin_Controller;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\http\Models\Admin;
use App\http\Models\User;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\AdminResource;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function loginAdmin(LoginRequest $request)
    {
         $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }
        $admin->token = $admin->createToken('loginAdmin')->plainTextToken;

       return response()->json($admin);


    }


}
