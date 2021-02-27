<?php


namespace App\Models;

use App\Models\Category;

class News
{
    private Category $category;

    private $news = [
        '1' => [
            'id' => 1,
            'title' => 'Новость 1',
            'text' => 'А у нас новость 1 и она очень хорошая!',
            'isPrivate' => false,
            'category_id' => 1
        ],
        '2' => [
            'id' => 2,
            'title' => 'Новость 2',
            'text' => 'А у нас новость 2 и она очень очень хорошая!',
            'isPrivate' => false,
            'category_id' => 1
        ],
        '3' => [
            'id' => 3,
            'title' => 'Новость 3',
            'text' => 'А тут плохие новости(((',
            'isPrivate' => true,
            'category_id' => 2
        ],
        '4' => [
            'id' => 4,
            'title' => 'Новость 4',
            'text' => 'А тут плохие плохие новости(((',
            'isPrivate' => false,
            'category_id' => 2
        ],
    ];

    public function __construct(Category $category)
    {
        $this->category = $category;
    }


    public function getNews() {
        return $this->news;
    }

    public function getNewsByCategorySlug($slug) {
        $id = $this->category->getCategoryIdBySlug($slug);
        $news = [];
        foreach ($this->getNews() as $item) {
            if ($item['category_id'] == $id) {
                $news[] = $item;
            }
        }
        return $news;

    }

    public function getNewsId($id) {
        if (array_key_exists($id, $this->getNews())) {
            return $this->getNews()[$id];
        } else {
            return [];
        }

    }

}
