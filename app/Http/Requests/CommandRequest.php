<?php

namespace App\Http\Requests;

use App\Models\Hackathon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommandRequest extends ApiRequest
{
    public function rules(): array{
        return [
            'name' => 'required|string',
            'code' => 'nullable|string',
            'hackathon_id' => ['required', 'integer', Rule::exists(Hackathon::class, 'id')],
            'owner_id' => 'nullable|integer',
            'answer'=>'string|nullable',
        ];
    }

}
