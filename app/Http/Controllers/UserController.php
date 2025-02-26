<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function registration(RegistrationRequest $request) : JsonResponse {
        $user = User::query()->create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'birth_date' => $request->get('birth_date'),
            'password' => Hash::make($request->get('password')),
        ]);
        return $this->returnResponseJson($user, 201);
    }

    public function login(LoginRequest $request) : JsonResponse
    {
        $user = User::query()->where('email', $request->get('email'))->first();

            if ($user && Hash::check($request->get('password'), $user->password)) {
                return $this->returnResponseJson($user,200);
            }
        return response()->json([],404);
    }

    public function getUser(Request $request) : JsonResponse
    {
        return response()->json(new UserResource($request->user()));
    }

    public function logout(Request $request) : Response
    {
        $request->user()->tokens()->delete();
        return response()->noContent();
    }


    public function returnResponseJson(User $user, int $status = 200): JsonResponse
    {
        return response()->json([
            'user' => $user,
            'token' => $user->createToken('token')->plainTextToken,
        ]);
    }
}
