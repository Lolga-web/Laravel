<?php

namespace App\Models;

class NewsCategory extends News
{
    private static $categories = [
        [
            'category_id' => 1,
            'category_title' => 'спорт',
            'slug' => 'sport'
        ],
        [
            'category_id' => 2,
            'category_title' => 'политика',
            'slug' => 'politic'
        ],
    ];

    public static function getCategories() {
        return static::$categories;
    }

    public static function getCategoryTitle($slug) {
        foreach (static::getCategories() as $item) {           
            if ($item['slug'] == $slug) {
                return $item['category_title'];
            }
        }
    }

    public static function getCategoryId($slug) {
        foreach (static::getCategories() as $item) {           
            if ($item['slug'] == $slug) {
                return $item['category_id'];
            }
        }
    }

    public static function getNewsCategory($slug) {
        $id = static::getCategoryId($slug);
        $categoryNews = [];
        foreach (static::getNews() as $item) {           
            if ($item['category_id'] == $id) {
                array_push($categoryNews, $item);
            }
        }
        return $categoryNews;
    }

}
