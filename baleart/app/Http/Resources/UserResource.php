<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'lastname' => $this->lastname,
            'phone' => $this->phone,
            'email' => $this->email,
            'Email Verified At' => $this->email_verified_at,
            'password' => $this->password,
            'role' => ($this->role_id== 1) ? 'administrador' : (($this->role_id == 2) ? 'gestor': 'visitant'),            
            'remember_token' => $this->remember_token,
            "Spaces" => SpaceResource::collection($this->whenLoaded("spaces")),
            "Comments" => CommentResource::collection($this->whenLoaded("comments")),
            "Images" => ImageResource::collection($this->whenLoaded("images")),
        ];
    }
}
