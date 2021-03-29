<?php

namespace App\Http\Controllers;

use App\Models\News;
use Swap\Laravel\Facades\Swap;

class NewsController extends Controller
{
        public function index(News $news) 
        {
            $news = News::orderByDesc('date')->paginate(30);
            return view('news.index')
                    ->with('news', $news);
        }

        public function show(News $news) 
        {
            $newNews = News::orderByDesc('date')
                                ->take(10)
                                ->get();

            $categoryNews = News::where('category_id', $news->category_id)
                                ->where('id', '!=', $news->id)
                                ->orderByDesc('date')
                                ->take(6)
                                ->get();
                                
            $rate = $this->currencyExchangeRate(['USD/RUB', 'EUR/RUB']);
        
            return view('news.one')
                    ->with('rate', $rate)
                    ->with('news', $news)
                    ->with('categoryNews', $categoryNews)
                    ->with('newNews', $newNews);
        }

        public function currencyExchangeRate($currency){
            foreach ($currency as $item){
                $rate[$item] = number_format(Swap::latest($item)->getValue(), 2);
            }
            return $rate;
        }
}
