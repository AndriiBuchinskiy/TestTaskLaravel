<?php

namespace App\Http\Resources;

use App\Http\Resources\Post as PostResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PostCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray(Request $request)
    {
        return parent::toArray($request);
        //return new PostResource(Post::first());
         // return new PostResource(Post::first());
    }
}
