<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'user_id' => $this->user_id,
            'user' => $this->user,
            'count_posts' => $this->user->posts->count(),
            'subscription' => $this->user->subscription,
            'name' => $this->name,
            'street' => $this->street,
            'number' => $this->number,
            'locality' => $this->locality,
            'city' => $this->city,
            'region_code' => $this->region_code,
            'postal_code' => $this->postal_code,
            'complement' => $this->complement,
            'birth_date' => $this->birth_date,
            'cpf' => $this->cpf,
            'country'=> $this->country,
            'area' => $this->area,
            'phone' => $this->phone,
        ];
    }
}
