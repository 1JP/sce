<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $types = '';
        foreach ($this->categoryTypes as $categoryTypes) {
            $types .= $categoryTypes->name . ',';
        }
        $types = rtrim($types, ',');

        return [
            'id' => $this->id,
            'name' => $this->name,
            'active' => $this->active,
            'category_types' => $this->categoryTypes,
            'types' => $types,
            'posts' => $this->posts,
        ];
    }
}
