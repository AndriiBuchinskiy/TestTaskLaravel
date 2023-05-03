<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use App\Requests\StorePostRequest;
use App\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//
        $posts = Post::query()->orderBy('id', 'asc')->paginate(10);
        $categories = Category::query()->where('id', !null)->get();
        return view('admin.post.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all()->where('id', !null);
        $tags = Tag::all()->where('id',!null);
        return view('admin.post.create', compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {

        $data = $request->except('_token','tags');
        //$tags = $request->input('tags');
        if ($request->hasFile('img_path')) {
            $destination_path = 'images/';
            $image = $request->file('img_path');
            $image_name = time()."_".$image->getClientOriginalName();
            $request->file('img_path')->storeAs($destination_path, $image_name, 'public');
            $data['img_path'] = $destination_path.$image_name;
        }

         $post = Post::create($data);

        $tagIds = $request->input('tags');
        foreach ($tagIds as $tagId) {
            $postTag = new PostTag([
                'post_id' => $post->id,
                'tag_id' => $tagId,
            ]);
            $postTag->save();
        }
        return redirect()->route('posts.index')->with('success', 'Пост успішно створений.');
    }

    public function uploadImage(Request $request, $postId)
    {
        $image = $request->file('image');


        $fileName = uniqid() . '.' . $image->getClientOriginalExtension();


        $image->storeAs('public/images', $fileName);


        $post = Post::findOrFail($postId);
        $post->img_path = '/storage/images/' . $fileName; // зберігаємо шлях у папці storage
        $post->save();

        return response()->json(['message' => 'Зображення успішно завантажен']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $categories = Category::all()->where('id', !null);

        return view('admin.post.show', compact('post', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {

        $categories = Category::all()->where('id', !null);
        $tags = Tag::all()->where('id',!null);
        return view('admin.post.edit', compact('post', 'categories','tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = $request->except('_token', '_method');
        if ($request->hasFile('img_path')) {

            Storage::delete(str_replace('/storage', 'public', $post->img_path));


            $image = $request->file('img_path');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('public/images', $filename);
            $data['img_path'] = str_replace('public', '/storage', $path);
        }

        $post->update($data);
        $post->tags()->sync($data['tags'] ?? []);
        $post->update([
            'updated_at' => now(),
        ]);
        return redirect()->route('posts.index')->with('success', 'Пост успішно редагований.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Пост успішно видалений.');
    }
}
