<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResourse;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResourse::collection(Category::all());
    }
}