<?php

namespace App\Http\Controllers;

use App\Models\News;

class NewsController extends Controller
{
        public function index(News $news) 
        {
            $news = News::paginate(5);
            return view('news.index')->with('news', $news);
        }

        public function show(News $news) 
        {
            return view('news.one')->with('news', $news);
        }
}
