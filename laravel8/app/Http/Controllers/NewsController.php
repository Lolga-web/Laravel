<?php

namespace App\Http\Controllers;

use App\Models\News;

class NewsController extends Controller
{
        public function index(News $news) 
        {
            return view('news.index')->with('news', $news->getNews());
        }

        public function show($id, News $news) 
        {
            return view('news.one')->with('news', $news->getNewsId($id));
        }
}
