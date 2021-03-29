<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\News;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.categories.index', [
            'categories' => Category::all()->sortBy('title')
        ]);
    }

    public function store(CategoryRequest $request, Category $category) 
    {
        $request->validated();

        $arr = $request->all();
        if(Category::where('title', $arr['title'])->first()){
            return redirect()->route('admin.categories.index')->with('error', "Категория ".$arr['title']." уже существует.");
        }        
        $category->slug = Str::slug($arr['title'], '-');
        $category->fill($arr)->save();
        return redirect()->route('admin.categories.index')->with('success', "Категория добавлена!");
    }

    public function edit(Category $category) 
    {
        return view('admin.categories.edit', [
            'category' =>  $category
        ]);
    }

    public function update(CategoryRequest $request, Category $category) 
    {
        $request->validated();

        $arr = $request->all();
        $category->slug = Str::slug($arr['title'], '-');
        $category->fill($arr)->save();
        return redirect()->route('admin.categories.index')->with('success', "Категория изменена!");
    }

    public function destroy(Category $category) 
    {
        if(News::where('category_id', $category->id)->first()){
            return redirect()->route('admin.categories.index')->with('error', "Удаление невозможно! В категории $category->title есть новости.");
        }        
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', "Категория удалена!");
    }
}
