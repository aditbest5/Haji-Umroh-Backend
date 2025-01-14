<?php
namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {
        try {
            $request->validate([
                "email" => "required|unique:users,email|email",
                "name" => "required",
                "password" => "required|confirmed|min:6",
            ]);

            $user = User::create([
                "email" => $request->email,
                "name" => $request->name,
                "password" => Hash::make($request->password)
            ]);

            return response()->json([
                "response_code" => "200",
                "response_message" => "Berhasil Registrasi!",
                "data" => $user
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                "response_code" => "500",
                "response_message" => $th->getMessage(),
            ], 500);
        }
    }
    
    public function login(Request $request)
    {
        try {
            $request->validate([
                "email" => "required|email",
                "password" => "required|min:6",
            ]);

            $credentials = request(['email', 'password']);
            $user = User::join('roles', 'users.role_id', '=', 'roles.id')
                ->where('users.email', $request->email)
                ->select('users.*', 'roles.name as role_name')
                ->first();
            if (!$token = auth()->attempt($credentials)) {
                return response()->json(["response_message" => "Email/Password Salah", 'error' => 'unauthorized'], 401);
            }

            return response()->json([
                "response_code" => "200",
                "response_message" => "Berhasil Login!",
                "token_" => $token,
                "data" => $user
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                "response_code" => "500",
                "response_message" => $th->getMessage(),
            ], 500);
        }
    }

    public function logout()
    {
        auth()->logout();

        return response()->json(["response_message" => "successfully logout!"], 200);
    }

    public function insert_role(Request $request)
    {
        try {
            $request->validate([
                "name" => "required",
            ]);

            $role = Role::create([
                "name" => $request->name,
            ]);

            return response()->json([
                "response_code" => "200",
                "response_message" => "Berhasil Tambah Role!",
                "data" => $role
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                "response_code" => "500",
                "response_message" => $th->getMessage(),
            ], 500);
        }
    }
}
