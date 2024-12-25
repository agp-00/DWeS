<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModalityResource extends JsonResource
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
            'descripció' => $this->description_CA,
            'descripción' => $this->description_ES,
            'description' => $this->description_EN,
            'ultimo_update' => Carbon::parse($this->updated_at)->format('d-m-Y h:m:s'),
        ];
    }
}
