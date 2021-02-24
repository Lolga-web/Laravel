<?php

namespace App\Models;

class News
{
    private static $news = [
        [
            'id' => 1,
            'title' => 'Спорт 1',
            'text' => 'новость о спорте 1',
            'category_id' => 1
        ],
        [
            'id' => 2,
            'title' => 'Спорт 2',
            'text' => 'новость о спорте 2',
            'category_id' => 1
        ],
        [
            'id' => 3,
            'title' => 'Политика 1',
            'text' => 'Новость о политике 1',
            'category_id' => 2
        ],
    ];

    public static function getNews() {
        return static::$news;
    }

    public static function getNewsId($id) {
        $newsId = array_search($id, array_column(static::getNews(), 'id'));
        if($newsId !== false) {
            return static::getNews()[$newsId];
        }
    //    foreach (static::getNews() as $item) {
    //        if ($item['id'] == $id) {
    //            return $item;
    //        }
    //    }
       return [];
    }

}
