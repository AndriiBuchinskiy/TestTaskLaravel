<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;

use App\Requests\StoreCommentRequest;
use Request;

class CommentController extends Controller
{
    public function index(Request $request,$id)
    {
        $postComment = Comment::where('post_id',$id)->get();
        return CommentResource::collection($postComment);
    }

    public function store(StoreCommentRequest $request)
    {
        $this->authorize('create', Comment::class);
        $comment = new Comment();
        $comment->user_id = auth('sanctum')->user()->id;
        $comment->content = $request->input('content');
        $comment->post_id = $request->input('post_id');
        $comment->save();
    }

    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        return new CommentResource($comment);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('update', Comment::class);
        $comment = Comment::findOrFail($id);
        $comment->update($request->all());
        $comment->update([
            'updated_at' => now(),
        ]);

        return new CommentResource($comment);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $this->authorize('delete', $comment);
        $comment->delete();

        return response()->json(null, 204);
    }

}