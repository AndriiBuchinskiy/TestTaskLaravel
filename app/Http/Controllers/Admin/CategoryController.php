<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Requests\StoreCategoryRequest;
use App\Requests\UpdateCategoryRequest;
use Illuminate\Database\QueryException;

class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // dd(auth()->user()->role->permissions->pluck('name'));
        $this->authorize('viewAny',Category::class);
        $categories = Category::paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCategories = Category::query()->where('id', null)->get();
        return view('admin.categories.create', compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {


        $data = $request->except('_token');
        Category::create($data);

        return redirect()->route('categories.index')->with('success', 'Категорія успішно створена.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $parentCategories = Category::query()->where('id', null)->get();
        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);

        if (!$category) {
            session()->flash('message', 'Category not found');
            return redirect()->route('categories.index');
        }
        $data = $request->except('_token');
        $category->update($data);
        $category->update([
            'updated_at' => now(),
        ]);
        session(['message' => 'Category updated successfully']);
        return redirect()->route('categories.index')->with('success', 'Категорія успішно редагована')->with('forget', ['message']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return redirect()->route('categories.index')->with('success', 'Категорія успішно видалена!')->with('forget', ['message']);
        } catch (QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) {
                return redirect()->route('categories.index')->with('error', 'Неможливо видалити категорію, оскільки вона містить пости!')->with('forget', ['message']);
            }
            return redirect()->route('categories.index')->with('error', 'Сталася помилка при видаленні категорії!')->with('forget', ['message']);
        }
    }
}