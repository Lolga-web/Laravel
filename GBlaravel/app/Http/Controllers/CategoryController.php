<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;

class CategoryController extends Controller
{
    public function index() {
        $categoriesWithNews = Category::with(['news' => function ($query) {
            $query->orderByDesc('date');
        }])->orderBy('title')->get();

        return view('news.categories')
            ->with('categoriesWithNews', $categoriesWithNews);
    }

    public function show($slug) {
        $category = Category::query()
                                ->where('slug', $slug)
                                ->first();

        $news = News::where('category_id', $category->id)
                        ->orderByDesc('date')
                        ->paginate(30);
                        
        return view('news.category')
            ->with('news', $news)
            ->with('category', $category->title);
    }
}
