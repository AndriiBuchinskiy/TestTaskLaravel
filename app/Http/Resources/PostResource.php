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
    public function toArray(Request $request)
    {

        $imagePath = $this->img_path ? asset('storage/app/'.$this->img_path) : null;
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'content' => $this->content,
            'img_path' => $imagePath,
            'name' =>$this->user->name,
            'category_id' => $this->category_id,
            'category_name' => $this->categories->name,
            'tag_name' => array_unique($this->tags->pluck('name')->toArray()),
        ];
    }

}
