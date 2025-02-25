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
        // Se obtiene el idioma para la presentación (por defecto 'ES')
        $language = $request->query('language', 'ES');

        // Construcción de la consulta inicial con las relaciones necesarias
        $query = Space::with([
            "address",
            "address.municipality.island",
            "modalities",
            "services",
            "spaceType",
            "comments",
            "comments.images",
            "user",
        ]);

        // Filtro por isla (usamos whereIn porque cada espacio tiene una sola isla)
        if ($request->has('island')) {
            $islands = explode(',', $request->island);
            $query->whereHas('address.municipality.island', function ($q) use ($islands) {
                $q->whereIn('name', $islands);
            });
        }

        // Filtro por municipio (usamos whereIn porque cada espacio tiene un único municipio)
        if ($request->has('municipality')) {
            $municipalities = explode(',', $request->municipality);
            $query->whereHas('address.municipality', function ($q) use ($municipalities) {
                $q->whereIn('name', $municipalities);
            });
        }

        // Filtro por modalidad: se añade una condición para cada modalidad seleccionada
        if ($request->has('modality')) {
            $modalities = explode(',', $request->modality);
            foreach ($modalities as $modality) {
                $query->whereHas('modalities', function ($q) use ($modality) {
                    // Compara contra el campo 'name' (o 'ca' si prefieres, aquí se usa 'name')
                    $q->where('name', $modality);
                });
            }
        }

        // Filtro por servicio: se añade una condición para cada servicio seleccionado
        if ($request->has('service')) {
            $services = explode(',', $request->service);
            foreach ($services as $service) {
                $query->whereHas('services', function ($q) use ($service) {
                    $q->where('name', $service);
                });
            }
        }

        // Filtro por tipo de espacio: se añade una condición para cada tipo seleccionado
        if ($request->has('spaceType')) {
            $spaceTypes = explode(',', $request->spaceType);
            foreach ($spaceTypes as $type) {
                $query->whereHas('spaceType', function ($q) use ($type) {
                    $q->where('name', $type);
                });
            }
        }

        // Filtro por rango de valoración (aplica solo si se modifican los valores predeterminados)
        if (
            ($request->has('ratingMin') && $request->input('ratingMin') != 0) ||
            ($request->has('ratingMax') && $request->input('ratingMax') != 5)
        ) {
            $ratingMin = $request->input('ratingMin', 0);
            $ratingMax = $request->input('ratingMax', 5);
            $query->withAvg('comments', 'score')
                  ->having('comments_avg_score', '>=', $ratingMin)
                  ->having('comments_avg_score', '<=', $ratingMax);
        }

        // Obtener los resultados filtrados
        $spaces = $query->get();

        // Para la presentación, se traduce el tipo de espacio según el idioma seleccionado
        $spaces->each(function ($space) use ($language) {
            $space->tipus = $space->spaceType->{"description_{$language}"};
        });

        return SpaceResource::collection($spaces)
               ->additional(['meta' => 'Espacios mostrados correctamente']);
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

        // Calcular el promedio de puntuación
        $averageScore = $space->calculaMitjana();

        // Obtener el idioma para la presentación (por defecto 'ES')
        $language = $request->query('language', 'ES');

        // Asignar el tipo de espacio traducido para la presentación
        $space->tipus = $space->spaceType->{"description_{$language}"};

        return (new SpaceResource($space))->additional([
            'meta' => [
                'message' => 'Espacio mostrado correctamente',
                'average_score' => $averageScore,
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
            $c = Comment::create([
                'comment' => $comment['comment'],
                'score' => $comment['score'],
                'user_id' => Auth::check()
                    ? Auth::id()
                    : ($request->has('email')
                        ? User::where('email', $request->email)->first()->id
                        : User::where('name', 'admin')->value('id')),
                'space_id' => $space_id,
            ]);
            $ncomentaris++;

            foreach ($comment['images'] as $image) {
                // Crear la imagen asociada al comentario
                $i = Image::create([
                    'comment_id' => $c->id,
                    'url' => $image['url'],
                ]);
                $nimatges++;
            }
        }

        return response()->json([
            'meta' => $ncomentaris . ' comentarios creados correctamente con ' . $nimatges . ' imágenes'
        ]);
    }
}
