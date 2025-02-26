<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\Auth\RegistrationRequest;

class UserController extends Controller
{
    public function registration(RegistrationRequest $request) : JsonResponse {
        $user = User::query()->create([
                'first_name'=>$request->get('first_name'),
                'last_name'=>$request->get('last_name'),
                'birth_date'=>$request->get('birth_date'),
                'email'=>$request->get('email'),
                'password'=>Hash::make($request->get('password')),
            ]);
        return $this->returnResponseJson($user, 201);
    }


    public function returnResponseJson(User $user, int $status = 200): JsonResponse
    {
        return response()->json([
            'user' => $user,
            'token' => $user->createToken('token')->plainTextToken,
        ]);
    }
}
