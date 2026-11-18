<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\Auth\LoginRequest;
use App\Http\Requests\Api\V1\Auth\RegisterRequest;
use App\Http\Resources\Api\V1\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use ApiResponse;

    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        $user = User::create([
            'name' => $data['name'],
            'email' => strtolower($data['email']),
            'password' => Hash::make($data['password']),
            'phone' => $data['phone'] ?? null,
            'role' => 'customer',
        ]);

        $token = $user->createToken($data['device_name'] ?? 'react-web-spa')->plainTextToken;

        return $this->ok([
            'token' => $token,
            'user' => new UserResource($user),
        ], 'Account registered successfully.', 201);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $request->validated();
        $user = User::whereRaw('LOWER(email) = ?', [strtolower($data['email'])])->first();
        if (! $user || ! Hash::check($data['password'], $user->password)) {
            return $this->fail('Email atau password salah.', 401, [
                'email' => ['Kredensial tidak cocok dengan data kami.'],
            ]);
        }
        $token = $user->createToken($data['device_name'] ?? 'react-web-spa')->plainTextToken;
        return $this->ok([
            'token' => $token,
            'user' => new UserResource($user),
        ], 'Authenticated successfully.');
    }

    public function demoLogin(): JsonResponse
    {
        if (! config('app.demo_mode')) {
            return $this->fail('Demo login is disabled.', 403);
        }

        $user = User::where('role', 'customer')->orderBy('id')->first();

        if (! $user) {
            return $this->fail('Akun demo customer belum tersedia. Jalankan php artisan db:seed terlebih dahulu.', 404);
        }

        $token = $user->createToken('recruiter-demo-spa')->plainTextToken;

        return $this->ok([
            'token' => $token,
            'user' => new UserResource($user),
        ], 'Demo customer authenticated.');
    }

    public function me(Request $request): JsonResponse
    {
        return $this->ok(new UserResource($request->user()), 'Profile retrieved.');
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()?->delete();
        return $this->ok(null, 'Logged out successfully.');
    }
}
