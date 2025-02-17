<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SpaceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "name"=> $this->name,
            "Registration Number"=> $this->regNumber,
            "Observació" => $this->observation_CA,
            "Observación" => $this->observation_ES,
            "Observation" => $this->observation_EN,
            "phone" => $this->phone,
            "email" => $this->email,
            "website" => $this->website,
            "accessType" => $this->accessType,
            "totalScore" => $this->totalScore,
            "countScore" => $this->countScore,
            'address' => new AddressResource($this->whenLoaded('address')),
            'Modalities' => ModalityResource::collection($this->whenLoaded('modalities')),
            'Services' => ServiceResource::collection($this->whenLoaded('services')),
            'Space Type' => new SpaceTypeResource($this->whenLoaded('spaceType')),
            'Comments' => CommentResource::collection($this->whenLoaded('comments')),
            //'User' => $this->user_id,
            'User' => new UserResource($this->whenLoaded('user')),
        ];
    }
}
