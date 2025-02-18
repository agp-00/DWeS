<?php

namespace App\Http\Controllers\Api;

use App\Models\Space;
use App\Models\Service;
use App\Models\Modality;
use App\Models\SpaceType;
use App\Models\Municipality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilterController extends Controller
{
    public function getFilters()
    {
        // Obtener los municipios
        $municipalities = Municipality::pluck('name');

        // Obtener modalidades
        $modalities = Modality::all()->map(function ($modality) {
            return [
                'ca' => $modality->description_CA,
                'es' => $modality->description_ES,
                'en' => $modality->description_EN,
            ];
        });

        // Obtener servicios
        $services = Service::all()->map(function ($service) {
            return [
                'ca' => $service->description_CA,
                'es' => $service->description_ES,
                'en' => $service->description_EN,
            ];
        });

        $types = SpaceType::all()->map(function ($type) {
            return [
                'ca' => $type->description_CA,
                'es' => $type->description_ES,
                'en' => $type->description_EN,
            ];
        });

        // Definir las islas (esto puede ser un arreglo estático o provenir de una base de datos)
        $islands = [
            'Mallorca',
            'Menorca',
            'Eivissa',
            'Formentera',
            'Cabrera'
        ];

        // Obtener la valoración media de todos los espacios
        $averageRating = Space::all()->avg(function ($space) {
            return $space->calculaMitjana(); // Utilizamos la función calculaMitjana() para calcular el promedio de cada espacio
        });

        // Rango de valoraciones (por ejemplo, de 1 a 5)
        $ratings = range(1, 5);  // Podríamos cambiar este rango dependiendo del promedio o del sistema de puntuación que utilices

        return response()->json([
            'municipalities' => $municipalities,
            'modalities' => $modalities,
            'services' => $services,
            'islands' => $islands,
            'types' => $types,
            'ratings' => $ratings,
            'average_rating' => $averageRating,  // Agregar el promedio de valoración global
        ]);
    }
}
