<?php

namespace Dawnstar\Api\Http\Controllers;

use Dawnstar\Api\Models\Admin;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (! $admin || ! Hash::check($request->password, $admin->password)) {
            return response()->json([
                'status' => false,
                'message' => 'The provided credentials are incorrect.',
            ], 401);
        }
        $admin->tokens()->delete();

        return response()->json([
            'status' => true,
            'access_token' => $admin->createToken('dawnstar')->plainTextToken,
        ]);
    }
}
