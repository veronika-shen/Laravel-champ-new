<?php

namespace App\Http\Controllers;

use App\Http\Requests\HackathonRequest;
use App\Http\Resources\HackathonResource;
use App\Models\Hackathon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HackathonController extends Controller
{
 public function index(): JsonResponse
 {
    return response()->json(HackathonResource::collection(Hackathon::all()));
 }

 public function show(Hackathon $hackathon): JsonResponse
 {
    return response()->json(new HackathonResource($hackathon));
 }

 public function store(HackathonRequest $request): JsonResponse
 {
       $hackathon = Hackathon::query()->create([
            'name' => $request->get('name'),
            'registration_date_begin' => $request->get('registration_date_begin'),
            'registration_date_end' => $request->get('registration_date_end'),
            'start_date_begin' => $request->get('start_date_begin'),
            'start_date_end' => $request->get('start_date_end'),
            'max_members_count' => $request->get('max_members_count'),
            'description' => $request->get('description'),
            'task' => $request->get('task'),
            'user_id' => $request->user()->id,
           ]);

       return response()->json(new HackathonResource($hackathon));
 }

 public function update(HackathonRequest $request, Hackathon $hackathon): JsonResponse
 {
    $hackathon->update([
        'name' => $request->get('name'),
        'registration_date_begin' => $request->get('registration_date_begin'),
        'registration_date_end' => $request->get('registration_date_end'),
        'start_date_begin' => $request->get('start_date_begin'),
        'start_date_end' => $request->get('start_date_end'),
        'max_members_count' => $request->get('max_members_count'),
        'description' => $request->get('description'),
        'task' => $request->get('task'),
    ]);
    return response()->json(new HackathonResource($hackathon));
 }
public function user(): JsonResponse
{
    $usersHackathon = Hackathon::query()->whereUserId(auth()->user()->id)->get();
    return response()->json($usersHackathon);
}

public function destroy(Hackathon $hackathon): JsonResponse
{
     $hackathon->delete();
     return response()->json(new HackathonResource($hackathon),204);
}
}
