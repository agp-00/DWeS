<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }


    /**
     * Display the specified resource.
     */
    public function show($email)
    {
        //
        $user = User::where('email', $email)->first(); //añadir comments e images

        return response()->json(new UserResource($user));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($identifier, UserRequest $request)
    {
        $user = is_numeric(value: $identifier) ? User::find($identifier) : User::where('email', $identifier)->first();

        if ($user) {
            $user->update($request->validated());

            return new UserResource($user);

        } else {
            return response()->json(['error' => 'User not found'], 404);
        }

    }


    /**
     * Remove the specified resource from storage.
     */

     public function destroy($identifier)
     {
         // Buscar el usuario por ID o email
         $user = is_numeric($identifier) ? User::find($identifier) : User::where('email', $identifier)->first();
     
         if ($user) {
             // Eliminar el usuario (esto también eliminará los comentarios debido al método boot)

            $user->delete();
    
             // Retornar una respuesta de éxito
             return response()->json(['message' => 'User and related data deleted successfully'], 200);
         } else {
             // Manejar el caso en que el usuario no se encuentra
             return response()->json(['error' => 'User not found'], 404);
         }
     }
}
