<?php

namespace App\Http\Resources;

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
            'description' => $this->description,
            'sentiment' => $this->sentiment,
            'user' => $this->user ? [
                'id' => $this->user->id,
                'name' => $this->user->name,
            ] : null,
            'post_id' => $this->post_id,
            'post' => $this->post ? [
                'id' => $this->post->id,
                'name' => $this->post->name,
            ] : null,
            'comment_id' => $this->comment_id,
            'comment' => $this->comment ? [
                'id' => $this->comment->id,
                'description' => $this->comment->description,
            ] : null,
            'children' => CommentResource::collection($this->comments),
            'countComments' => $this->comments()->count(),
            'countDesLinks' => $this->deslinks()->count(),
            'countLinks' => $this->links()->count(),
            'created_at' => $this->created_at->format('d-m-Y H:i:s'),
            'updated_at' => $this->updated_at->format('d-m-Y H:i:s'),
        ];
    }
}
