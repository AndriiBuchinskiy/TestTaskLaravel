<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;

use App\Requests\StorePostRequest;
use App\Requests\UpdatePostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(9);
        return response()->json($posts);
        //return PostResource::collection(Post::all());
    }

    public function getTagsByPostId($postId)
    {
        $post = Post::findOrFail($postId);
        $tags = $post->tags;

        return response()->json($tags);
    }

    public function store(StorePostRequest $request)
    {

        $this->authorize('create',Post::class);
        $post = new Post;
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->category_id = $request->input('category');
        $post->user_id = $request->input('user_id');
        if ($request->hasFile('img_path')) {
            $image = $request->file('img_path');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('public/images', $filename);
            $post->img_path = str_replace('public', '/storage', $path);
        }
        $post->save();
        $post->update([
            'updated_at' => now(),
        ]);

// додати теги до поста

        $tagIds = json_decode($request->input('tags')); // сформувати масив моделей через array_map та записати в saveMany
        // або вручну зробити інсерт тегів в базу даних.
        foreach ($tagIds as $tagId) {
            $postTag = new PostTag([
                'post_id' => $post->id,
                'tag_id' => $tagId,
            ]);
            $postTag->save();
        }
         return new PostResource($post);
    }

    public function show($id)
    {
        $post = Post::findOrfail($id);
        return new PostResource($post);
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::findOrfail($id);
        $this->authorize('update', $post);
        //dd($request->input());
        $post->update($request->all());
        //dd($request);
        //dd($request->all());
        //dd($request->has('category'));
        // Оновлення категорії
        if ($request->has('category')) {
            $category = Category::find($request->category);
            if ($category) {
                //dd($category);
                $post->category_id = $category->id;
                $post->save();
                //dd($post);
            }
        }
        if($request->has('tags')) {
            PostTag::where('post_id', $post->id)->delete();
            $tagIds = $request->input('tags');
             //dd($tagIds);
            foreach ($tagIds as $tagId) {
                $postTag = new PostTag([
                    'post_id' => $post->id,
                    'tag_id' => $tagId,
                ]);

                $postTag->save();
            }
        }
        if ($request->hasFile('img_path')) {
            if ($post->img_path) {
                Storage::delete(str_replace('/storage', 'public', $post->img_path));
            }
            $image = $request->file('img_path');
            $filename = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('public/images', $filename);
            $post->img_path = str_replace('public', '/storage', $path);
        }
        return new PostResource($post);
    }

    public function uploadImage(Request $request, $postId)
    {
        // отримати файл зображення з запиту
        $image = $request->file('image');

        // згенерувати унікальне ім'я файлу
        $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

        // зберегти файл зображення в папку /public/images
        $image->storeAs('public/images', $fileName);

        // оновити поле img_path у відповідному пості
        $post = Post::findOrFail($postId);
        $post->img_path = '/storage/images/' . $fileName; // зберігаємо шлях у папці storage
        $post->save();

        return response()->json(['message' => 'Зображення успішно завантажено та додано до поста.']);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $this->authorize('delete', $post);
        Storage::delete(str_replace('/storage', 'public', $post->img_path));
        $post->delete();
        return response()->json(null, 204);
    }
    public function search(Request $request)
    {

        $search = $request->input('search');
        $category = $request->input('category');
        $tags = $request->input('tags');
        $query = Post::query();

        if ($search) {
            $query->where('title', 'LIKE', "%{$search}%")
                ->orWhere('content', 'LIKE', "%{$search}%");
        }

        if ($category) {
            $query->whereHas('categories', function ($query) use ($category) {
                $query->where('id', $category);
            });
        }

        if ($tags) {
            $query->whereIn('id', function ($query) use ($tags) {
                $query->select('post_id')
                    ->from('post_tag')
                    ->whereIn('tag_id', $tags);
            });
        }

        $posts = $query->select('id', 'title', 'content')
            ->with(['categories' => function ($query) {
                $query->select('id', 'name');
            }, 'tagsp' => function ($query) {
                $query->select('id', 'name');
            }])
            ->paginate(9);

        return response()->json($posts);

    }

}
