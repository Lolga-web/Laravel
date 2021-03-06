<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function create(Request $request, News $news, Category $category) 
    {
        if ($request->isMethod('post')) {

            // $request->flash();
            
            $url = null;
            if ($request->file('image')) {
                $path = Storage::putFile('public', $request->file('image'));
                $url = Storage::url($path);
            }

            $news = $request->except('_token');
            $news['isPrivate'] = $request->has('isPrivate');
            $news['image'] = $url;

            $id = DB::table('news')->insertGetId([
                    'title' => $news['title'],
                    'text' => $news['text'],
                    'isPrivate' => $news['isPrivate'],
                    'image' => $news['image'],
                    'category_id' => (int)$news['category_id']
                ]);

            return redirect()->route('news.show', $id)->with('success', 'Новость добавлена!');
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
