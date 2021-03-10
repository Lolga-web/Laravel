<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
        return view('news.categories')
            ->with('categories', Category::all());
    }

    public function show($slug) {
        $category = Category::query()->where('slug', $slug)->first();

        return view('news.category')
            ->with('news', $category->news)
            ->with('category', $category->title);
    }
}
