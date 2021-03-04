<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function create(Request $request, Category $category) 
    {
        if ($request->isMethod('post')) {

            $request->flash();

            $news = json_decode(File::get(storage_path('news.json')), true);

            $news[] = $request->except('_token');

            $news[array_key_last($news)]['isPrivate'] = $request->has('isPrivate');  
            $news[array_key_last($news)]['id'] = array_key_last($news);

            File::put(storage_path('news.json'), json_encode($news, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

            return redirect()->route('news.show', array_key_last($news));
        }
    
        return view('admin.create')->with('categories', $category->getCategories());
    }

    public function download(News $news)
    {
        return response()->json($news->getNews())
            ->header('Content-Disposition', 'attachment; filename = "json.txt"')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

}
