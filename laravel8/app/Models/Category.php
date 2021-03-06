<?php


namespace App\Models;

use Illuminate\Support\Facades\DB;

class Category
{

    public function getCategories()
    {
        return $category = DB::table('category')->get();
    }

    public function getCategoryNameBySlug($slug) 
    {
        $category = DB::table('category')->where('slug', $slug)->first();
        if($category) {
            return $category->title;  
        }
        return false;
    }

    public function getCategoryIdBySlug($slug) 
    {
        $category = DB::table('category')->where('slug', $slug)->first();
        if($category){
            return $category->id;
        }
        return false;
    }

}
