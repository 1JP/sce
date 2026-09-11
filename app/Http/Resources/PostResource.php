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
        $images = $this->images()->count() > 0
            ? $this->images->map(function ($image) {
                $image->image = asset('storage/' . $image->name);
                return $image;
            })
            : [['image' => asset('site/img/logo-favicon.jpeg'), 'name' => 'Default']];

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
            'active' => $this->active,
            'images' => $images,
            'likes_percentage' => $this->likes_percentage(),
            'dislikes_percentage' => $this->dislikes_percentage(),
            'positive_comments_percentage' => $this->positive_comments_percentage(),
            'negative_comments_percentage' => $this->negative_comments_percentage(),
            'neutral_comments_percentage' => $this->neutral_comments_percentage(),
            'likes' => $this->links,
            'dislikes' => $this->deslinks,
        ];
    }
}
