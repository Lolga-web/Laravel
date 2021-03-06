<?php


namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\News;

class CategoryController extends Controller
{
    public function index(Category $category) {
        return view('news.categories')->with('categories', $category->getCategories());
    }

    public function show(News $news, Category $category, $slug) {
        return view('news.category')
            ->with('news', $news->getNewsByCategorySlug($slug))
            ->with('category', $category->getCategoryNameBySlug($slug));
    }
}
