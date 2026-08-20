<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'thumbnails' => largeThumbnail($this->lg_thumb),
            'created_at' => jalaliDateFormatA($this->created_at),
            'category' => [
                'en_name' => $this->category->en_name,
                'name' => $this->category->name,
            ],
            'author' => [
                'name' => $this->author->name,
            ],
        ];
    }
}
