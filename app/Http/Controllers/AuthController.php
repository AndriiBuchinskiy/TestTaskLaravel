<?php

namespace App\Http\Controllers;


use App\Http\Resources\UserResourse;
use App\Models\User;

use App\Requests\LoginUserRequest;
use App\Requests\RegisterRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Login
     *
     * @param LoginUserRequest $request
     *
     * @return array
     */
    public function login(LoginUserRequest $request)
    {
        $data = $request->validated();
        $login = $data['email'];
        $password = $data['password'];
        $deviceName = $data['device_name'];

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        Auth::login($user);
        $user->tokens()
            ->where('name', $deviceName)
            ->delete();
        $token = $user->createToken($deviceName)->plainTextToken;

        return [
            'token' => $token,
            'user' => new UserResourse($user),
        ];
    }


    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $login = $data['email'];
        $name = $data['name'];
        $password = $data['password'];
        $password_confirmation = $data['password_confirmation'];
        $deviceName = $data['device_name'];


        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->tokens()
            ->where('name', $deviceName)
            ->delete();
        $token = $user->createToken($deviceName)->plainTextToken;

        return [
            'token' => $token,
            'user' => new UserResourse($user),
        ];
    }

    /**
     * Logout
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Logged out']);
        }
        $user->tokens()->delete();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['message' => 'Logged out']);
    }

    public function user()
    {
        if (Auth::check()) {
            return new UserResourse(Auth::user());
        } else {
            return response()->json(['error' => 'Unauthenticated.'], 404);
        }
    }
}
