<?php

namespace App\Http\Controllers\Api;

use App\Models\Space;
use App\Models\Image;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Api\SpaceResource;
use App\Http\Resources\Api\CommentResource;

class SpaceController extends Controller
{
    public function index(Request $request)
    {
        // Construcción de la consulta inicial con las relaciones necesarias
        $query = Space::with([
            "address",
            "address.municipality.island",
            "modalities",
            "services",
            "spaceType",  // Es importante incluir 'spaceType' aquí
            "comments",
            "comments.images",
            "user",
        ]);

        // Aplicar filtro por 'illa' solo si el parámetro está presente
        $query->when($request->illa, function ($q) use ($request) {
            $q->whereHas(
                'address.municipality.island',
                function ($q) use ($request) {
                    $q->where('name', $request->illa);
                }
            );
        });

        // Obtener los resultados
        $spaces = $query->get();

        // Convertir los tipos de espacios en el idioma correspondiente
        $language = $request->query('language', 'ES'); // Por defecto 'ES'
        $spaces->each(function ($space) use ($language) {
            $space->tipus = $space->spaceType->{"description_{$language}"};  // Esto traduce el tipo de espacio según el idioma
        });

        // Retornar la respuesta como una colección de recursos personalizados
        return SpaceResource::collection($spaces)->additional(['meta' => 'Espacios mostrados correctamente']);
    }

    public function show(Space $space, Request $request)
    {
        // Cargar las relaciones necesarias
        $space->load([
            'address',
            'modalities',
            'services',
            'spaceType',
            'comments',
            'comments.images',
            'user',
        ]);

        // Obtener el promedio de puntuación de los comentarios (si existe)
        $averageScore = $space->calculaMitjana();  // Esto te dará el promedio de la columna 'score'

        // Obtener el idioma seleccionado (por defecto 'ES')
        $language = $request->query('language', 'ES');
        

        // Convertir el tipo de espacio en el idioma correspondiente
        $space->tipus = $space->spaceType->{"description_{$language}"};  // Aquí se hace la traducción de 'tipus'

        // Retornar el espacio con el promedio de puntuación y las traducciones necesarias
        return (new SpaceResource($space))->additional([
            'meta' => [
                'message' => 'Espacio mostrado correctamente',
                'average_score' => $averageScore, // Agregar el promedio al response
            ]
        ]);
    }

    public function store(Request $request)
    {
        $space_id = Space::where('regNumber', $request->regNumber)->first()->id;
        $ncomentaris = 0;
        $nimatges = 0;

        foreach ($request->comments as $comment) {
            // Crear el comentario
            $c = Comment::create(
                [
                    'comment' => $comment['comment'],
                    'score' => $comment['score'],
                    'user_id' => Auth::check()
                        ? Auth::id()
                        : ($request->has('email')
                            ? User::where('email', $request->email)->first()->id
                            : User::where('name', 'admin')->value('id')),
                    'space_id' => $space_id,
                ]
            );
            $ncomentaris++;

            foreach ($comment['images'] as $image) {
                // Crear la imagen asociada al comentario
                $i = Image::create(
                    [
                        'comment_id' => $c->id,
                        'url' => $image['url'],
                    ]
                );
                $nimatges++;
            }
        }

        return response()->json(['meta' => $ncomentaris . ' comentarios creados correctamente con ' . $nimatges . ' imágenes']);
    }
}
