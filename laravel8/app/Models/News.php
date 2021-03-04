<?php


namespace App\Models;

use App\Models\Category;
use Illuminate\Support\Facades\File;

class News
{
    private Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getNews() 
    {
        $news = json_decode(File::get(storage_path('news.json')), true);
        return $news;
    }

    public function getNewsByCategorySlug($slug) 
    {
        $id = $this->category->getCategoryIdBySlug($slug);
        $news = [];
        foreach ($this->getNews() as $item) {
            if ($item['category_id'] == $id) {
                $news[] = $item;
            }
        }
        return $news;
    }

    public function getNewsId($id) 
    {
        if (array_key_exists($id, $this->getNews())) {
            return $this->getNews()[$id];
        } else {
            return [];
        }
    }

}
