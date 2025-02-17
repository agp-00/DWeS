<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MunicipalityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            "Islands" => IslandResource::collection($this->whenLoaded("Islands")),
            'ultimo_update' => Carbon::parse($this->updated_at)->format('d-m-Y h:m:s'),
        ];
    }
}
