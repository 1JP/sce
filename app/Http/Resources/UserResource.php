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
            'email' => $this->email,
            'phone' => $this->phone,
            'cpf' => $this->cpf,
            'postal_code' => $this->postal_code,
            'birth_date' => $this->birth_date,
            'street' => $this->street,
            'number' => $this->number,
            'locality' => $this->locality,
            'city' => $this->city,
            'region_code' => $this->region_code,
            'country' => $this->country,
            'area' => $this->area,
            'complement' => $this->complement,
        ];
    }
}
