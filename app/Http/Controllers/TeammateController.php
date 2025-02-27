<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommandResource;
use App\Models\Command;
use App\Models\Teammate;
use Illuminate\Http\JsonResponse;

class TeammateController extends Controller
{
    public function store(Command $command): JsonResponse{
    $teammate = Teammate::query()->create([
        'user_id' => auth()->id(),
        'command_id' => $command->id,
    ]);
    return response()->json(new CommandResource($teammate));
}

public function destroy(Teammate $teammate): JsonResponse
{
    $teammate->delete();
    return response()->json(new CommandResource($teammate),204);
}
}
