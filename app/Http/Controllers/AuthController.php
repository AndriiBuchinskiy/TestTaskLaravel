<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResourse;
use App\Jobs\SendEmailJob;
use App\Models\User;

use App\Requests\LoginUserRequest;
use App\Requests\RegisterRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Str;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('login', 'register');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required'
        ]);

        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        Auth::login($user);

        $user->tokens()->where('name', $credentials['device_name'])->delete();

        $token = $user->createToken($credentials['device_name'])->plainTextToken;

        return response([
            'token' => $token,
            'user' => new UserResourse($user),
        ])->withHeaders([
            "Authorization" => "Bearer $token"
        ]);
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'device_name' => 'required'
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => 3,
        ]);

        $user->tokens()->where('name', $data['device_name'])->delete();

        $token = $user->createToken($data['device_name'])->plainTextToken;

        return response([
            'token' => $token,
            'user' => new UserResourse($user),
        ])->withHeaders([
            "Authorization" => "Bearer $token"
        ]);
    }

    public function logout(Request $request)
    {

        Auth::user()->tokens()->delete();

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->json(['message' => 'Logged out']);
    }

    public function user(Request $request)
    { $token = $request->header('Authorization');

        if ($token && Str::startsWith($token, 'Bearer ')) {
            $token = Str::substr($token, 7);

            if (Auth::guard('sanctum')->check()) {
                return [
                    'user' => new UserResourse(Auth::user()),
                    'x-xsrf-token' => $request->headers->get('x-xsrf-token')
                ];
            }
        }

        return response()->json(['error' => 'Unauthenticated.'], 401);
    }
}
