<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\News;
use App\Models\Category;

class NewsController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'news' => News::paginate(5),
        ]);
    }

    public function create(News $news) 
    {
        return view('admin.create')
            ->with('categories', Category::all())
            ->with('news', $news);
    }

    public function store(Request $request, News $news) {
        $url = null;
        if ($request->file('image')) {
            $path = Storage::putFile('public', $request->file('image'));
            $url = Storage::url($path);
        }

        $news->image = $url;
        $news->fill($request->all())->save();

        return redirect()->route('news.show', $news->id)->with('success', 'Новость добавлена!');
    }

    public function edit(News $news) {
        return view('admin.create', [
            'news' => $news,
            'categories' =>  Category::all()
        ]);
    }

    public function update(Request $request, News $news) {
        $url = null;
        if ($request->file('image')) {
            $path = Storage::putFile('public', $request->file('image'));
            $url = Storage::url($path);
        }

        $news->image = $url;
        $news->isPrivate = $request->has('isPrivate');
        $news->fill($request->all())->save();
        return redirect()->route('news.show', $news->id)->with('success', 'Новость изменена!');
    }

    public function destroy(News $news) {
        $news->delete();
        return redirect()->route('admin.index')->with('success', "Новость удалена!");
    }
}
