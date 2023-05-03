<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;



class CommentController extends Controller
{
    public function index()
    {

        $comments = Comment::paginate(10);
        return view('admin.comments.index', compact('comments'));
    }

    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('admin.comments.edit', compact('comment'));
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        $request->validate([
            'content' => 'required|string|min:3|max:500'
        ]);

        $comment->content = $request->input('content');
        $comment->save();

        return redirect()->route('comments.index')->with('success', 'Коментар успішно редагований.');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        $comment->delete();
        return redirect()->route('comments.index')->with('success', 'Коментар успішно видалений.');
    }
}