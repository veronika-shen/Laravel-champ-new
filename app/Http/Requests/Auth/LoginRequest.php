<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiRequest;
use Illuminate\Validation\Rule;


class LoginRequest extends ApiRequest
{
    public function rules(): array{
        return [
            'email'=>['required','email'],
            'password'=>['required'],
        ];
    }
}
