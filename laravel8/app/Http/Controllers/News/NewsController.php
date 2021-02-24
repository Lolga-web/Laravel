<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsCategory;

class NewsController extends Controller
{
    public function index() {
        $news = News::getNews();
        $categories = NewsCategory::getCategories();
        return view('news.index', ['news' => $news, 'categories' => $categories]);
    }

    public function show($id) {
        $news = News::getNewsId($id);
        return view('news.one')->with('news', $news);
    }

    public function category($slug) {
        $categoryTitle = NewsCategory::getCategoryTitle($slug);
        $news = NewsCategory::getNewsCategory($slug);
        return view('news.category', ['news' => $news, 'category_title' => $categoryTitle]);
    }
}
