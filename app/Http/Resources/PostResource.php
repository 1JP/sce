<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'note' => $this->note,
            'user' => $this->user,
            'category' => $this->category,
            'category_id' => $this->category_id,
            'indicative_rating' => $this->indicative_rating,
            'indicative_rating_id' => $this->indicative_rating_id,
            'active' => $this->active
        ];
    }
}
