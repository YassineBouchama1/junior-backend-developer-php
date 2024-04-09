<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ThreadResource extends JsonResource
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
            'title' => $this->title,
            'content' => $this->content,
            'likes_count' => $this->likes_count,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'email' => $this->email,
            'location' => $this->location,
            'followers_count' => $this->followers_count,

        ];
    }
}
