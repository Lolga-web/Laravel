<?php


namespace App\Services;


use App\Models\Category;
use App\Models\News;
use Orchestra\Parser\Xml\Facade as XmlParser;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class XMLParserService
{
    public function saveNews($link) {
        $xml = XmlParser::load($link);

        $data = $xml->parse([
            'title' => ['uses' => 'channel.title'],
            'link' => ['uses' => 'channel.link'],
            'description' => ['uses' => 'channel.description'],
            'news' => ['uses' => 'channel.item[title,link,description,pubDate,enclosure::url,category]']

        ]);

        foreach ($data['news'] as $news) {
            if (!$news['category']) {
                $categoryName = $data['title'];
            } else {
                $categoryName = $news['category'];
            }
            $category = Category::query()->firstOrCreate([
                'title' => $categoryName,
                'slug' => Str::slug($categoryName)
            ]);

            News::query()->firstOrCreate([
                'title' => $news['title'],
                'text' => $news['description'],
                'isPrivate' => false,
                'image' => $news['enclosure::url'],
                'category_id' => $category->id,
                'date' => date("Y-m-d H:i:s", strtotime($news['pubDate'])),
            ]);

        }

        Storage::disk('publicLogs')->append('log.txt', date('h:i:s') . " " . $link);

    }
}
