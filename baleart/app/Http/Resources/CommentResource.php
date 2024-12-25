<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'comentario' => $this->comment,
            'score' => $this->score,
            'estado' => $this->status,
            'user_id' => $this->user_id,
            'space_id' => $this->space_id,
            'images' => ImageResource::collection($this->whenLoaded('images')),
            'ultimo_update' => Carbon::parse($this->updated_at)->format('d-m-Y h:m:s'),
        ];
    }
}
