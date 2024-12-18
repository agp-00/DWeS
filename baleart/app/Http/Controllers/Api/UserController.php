<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::all();

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($email)
    {
        //
        $user = User::where('email', $email)->first(); //añadir otros apartados

        return response()->json(new UserResource($user));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($identifier, Request $request)
    {
        //
        $user = is_numeric($identifier) ? User::where('id', $identifier) : User::where('email', $identifier)->first();

        /*
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        */
        
        $user->update($request->all());

        return response()->json(new UserResource($user));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
