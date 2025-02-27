<?php

namespace App\Http\Resources;

use App\Models\Command;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Command
 */
class CommandResource extends JsonResource
{
    public function toArray(Request $request): array{
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'code'=>$this->code,
            'owner'=>new UserResource($this->owner),
            'teammates'=>[],
        ];
    }
}
