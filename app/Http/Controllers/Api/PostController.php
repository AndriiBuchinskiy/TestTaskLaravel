<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Requests\StorePostRequest;
use Illuminate\Http\Request;




class PostController extends Controller
{
    public function index()
    {
        return PostResource::collection(Post::all());
    }

    public function indexC(Request $request)
    {
        $categoryId = $request->input('category');
        $posts = Post::where('category_id', $categoryId)->get();
        return new PostResource($posts);
    }

    public function store(StorePostRequest $request)
    {
       // $post = Post::create($request->all());

        $post = new Post;
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->category_id = $request->input('category');
        $post->created_at = $request->input('created_at');
        $post->user_id = $request->input('user_id');
        $post->save();

// додати теги до поста
        $tags = $request->input('tags');
        if (!empty($tags)) {
            $post->tags()->sync($tags);
        }



         return new PostResource($post);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        return new PostResource($post);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());

        return new PostResource($post);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json(null, 204);
    }

}
