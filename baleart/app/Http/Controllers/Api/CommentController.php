<?php

namespace App\Http\Controllers\Api;

use App\Models\Space;
use App\Models\Comment;
use App\Models\Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Almacena uno o más comentarios (y sus imágenes) asociados a un espacio.
     *
     * Se espera recibir un payload similar a:
     * {
     *   "comments": [
     *     {
     *       "comment": "Texto del comentario",
     *       "score": 4,
     *       "images": [
     *         {"url": "http://ejemplo.com/imagen1.jpg"},
     *         {"url": "http://ejemplo.com/imagen2.jpg"}
     *       ]
     *     }
     *   ]
     * }
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Space  $space
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, Space $space)
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'Debes estar autenticado para comentar'], 401);
        }
        
        // Validar la entrada (puedes ajustarlo según tus necesidades)
        $validatedData = $request->validate([
            'comments' => 'required|array|min:1',
            'comments.*.comment' => 'required|string|max:255',
            'comments.*.score'   => 'required|integer|between:0,5',
            'comments.*.images'  => 'nullable|array',
            'comments.*.images.*.url' => 'required|url',
        ]);

        // Asumiremos que se envía un solo comentario para simplificar
        $commentData = $validatedData['comments'][0];

        // Crear el comentario
        $comment = Comment::create([
            'comment'   => $commentData['comment'],
            'score'     => $commentData['score'],
            'user_id'   => Auth::id(),
            'space_id'  => $space->id,
            'status'    => 'y', // Se establece el status por defecto
        ]);

        // Crear imágenes asociadas, si existen
        if (isset($commentData['images']) && is_array($commentData['images'])) {
            foreach ($commentData['images'] as $imageData) {
                Image::create([
                    'comment_id' => $comment->id,
                    'url'        => $imageData['url'],
                ]);
            }
        }

        // Recuperar el comentario recién creado con sus imágenes (si aplican)
        $createdComment = Comment::with('images')->find($comment->id);

        return response()->json(['data' => $createdComment], 201);
    }
}
