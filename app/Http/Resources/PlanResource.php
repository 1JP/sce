<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanResource extends JsonResource
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
            'description' => $this->description, 
            'number_film' => $this->number_film,
            'number_book' => $this->number_book, 
            'number_serie' => $this->number_serie, 
            'value' => str_replace(['', '.'], ['.', ','], $this->value), 
            'customer_id' => $this->customer_id, 
            'active' => $this->active,
            'count_assinatura' => 0
        ];
    }
}
