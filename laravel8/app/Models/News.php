<?php


namespace App\Models;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

class News
{
    private Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getNews() 
    {
        return $news = DB::table('news')->get();
    }

    public function getNewsId($id) 
    {
        return $news = DB::table('news')->find($id);
    }

    public function getNewsByCategorySlug($slug) 
    {
        $id = $this->category->getCategoryIdBySlug($slug);
        return $news = DB::table('news')->where('category_id', $id)->get();
    }   

}
