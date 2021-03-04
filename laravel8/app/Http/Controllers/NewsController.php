<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;

class NewsController extends Controller
{
        public function index(News $news) {
            return view('news.index')->with('news', $news->getNews());
        }

        public function show(News $news, $id) {
            return view('news.one')->with('news', $news->getNewsId($id));
        }
}
