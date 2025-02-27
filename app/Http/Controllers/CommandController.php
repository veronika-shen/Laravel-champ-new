<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommandRequest;
use App\Http\Resources\CommandResource;
use App\Models\Command;
use App\Models\Hackathon;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;

class CommandController extends Controller
{
    public function store(CommandRequest $request):JsonResponse{
        $command = Command::query()->create([
            'name' => $request->name,
            'hackathon_id' => $request->hackathon_id,
            'code'=> Str::random(6),
            'owner_id' => $request->user()->id,
            'answer' => $request->answer,
        ]);

        return response()->json(new CommandResource($command));
    }

    public function show(Command $command):JsonResponse{
        return response()->json([new CommandResource($command)]);
    }

    public function getUserCommands(Request $request):JsonResponse
    {
        $userCommands = Command::query()->where('owner_id', $request->user()->id)->get();
        return response()->json(CommandResource::collection($userCommands));
    }

    public function answer(Request $request, Hackathon $hackathon):JsonResponse{
        $validated = $request->validate([
            'text' => 'required|string',
        ]);
        $command = Command::query()->where('hackathon_id', $hackathon->id)->first();

            $command->update([
            'answer' => $validated['text'],
        ]);
        return response()->json([
            'text' => $validated['text'],
        ]);
    }

}
