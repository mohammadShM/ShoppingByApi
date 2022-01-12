<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends ApiController
{

    public function register(Request $request): JsonResponse
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validate->fails()) {
            return $this->errorResponse(422, $validate->messages());
        }
        /** @var User $user */
        $user = User::query()->create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);
        $token = $user->createToken('secrete_token_auth')->plainTextToken;
        return $this->successResponse(201, [
            'user' => $user,
            'token' => $token,
        ], 'user created successfully');
    }

    public function login(Request $request): JsonResponse
    {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required',
        ]);
        if ($validate->fails()) {
            return $this->errorResponse(422, $validate->messages());
        }
        /** @var User $user */
        $user = User::query()->where('email', $request->get('email'))->first();
        if (!Hash::check($request->get('password'), $user->password)) {
            return $this->errorResponse(422, 'ایمیل یا پسورد اشتباه است.');
        }
        $token = $user->createToken('secrete_token_auth')->plainTextToken;
        return $this->successResponse(200, [
            'user' => $user,
            'token' => $token,
        ], 'user login successfully');
    }

    public function logout(): JsonResponse
    {
        /** @var User $user */
        $user = auth()->user();
        $user?->tokens()->delete();
        return $this->successResponse(200, $user, 'logged out');
    }

}
