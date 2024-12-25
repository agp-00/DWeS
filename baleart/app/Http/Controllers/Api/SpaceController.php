<?php

namespace App\Http\Controllers\Api;

use App\Models\Space;
use App\Http\Requests\SpaceRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\SpaceResource;

class SpaceController extends Controller
{
    public function index()
    {
        $spaces = Space::with(['address', 'modalities', 'services', 'spaceType', 'comments', 'comments.images', 'user'])->get();
        return response()->json(SpaceResource::collection($spaces));
    }


    /**
     * Display the specified resource.
     */
    public function show($identifier)
    {
        $space = is_numeric(value: $identifier) ?
        Space::with(['address', 'modalities', 'services', 'spaceType', 'comments', 'comments.images', 'user'])->findOrFail($identifier) :
        Space::with(['address', 'modalities', 'services', 'spaceType', 'comments', 'comments.images', 'user'])->where('regNumber', $identifier)->firstOrFail();


        return response()->json(new SpaceResource($space));

    }


    public function store(SpaceRequest $request, $RegNumber)
    {
        $space = Space::where('RegNumber', $RegNumber)->first();
        // Validate the incoming request data
        $validatedData = $request->validate([

            'comment' => 'required|string',
            'status' => 'required|string',
            'score' => 'required|integer',
            'user_id' => 'required|exists:users,id',
            'images' => 'nullable|array',
            'images.*.url' => 'required_with:images|url',
            
        ]);

        if(!$validatedData){
            return response()->json(['error' => $validatedData->errors()], 422);
        }

        // Create a new Space record
        $comment = $space->comments()->create($request->validated());

        if ($request->has('images')) {
            foreach ($request->images as $image) {
                $comment->images()->create($image);
            }
        }


        // Return the newly created Space resource
        return response()->json(new SpaceResource($space), 201);
    }

}
