<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Orchestra\Parser\Xml\Facade as XmlParser;
use App\Models\Category;
use App\Models\News;

class ParserController extends Controller
{
    public function index()
    {
        return view('admin.news.parse');
    }

    public function parse() {
        $urlArr = ['https://www.vesti.ru/vesti.rss', 'https://www.lenta.ru/rss'];

        foreach ($urlArr as $url){
            $xml = XmlParser::load($url);
        
            $data = $xml->parse([
                'title' => ['uses' => 'channel.title'],
                'link' => ['uses' => 'channel.link'],
                'description' => ['uses' => 'channel.description'],
                'news' => ['uses' => 'channel.item[title,link,description,pubDate,enclosure::url,category]']
            ]);

            foreach ($data['news'] as $news) {

                $categoryId = Category::query()->firstOrCreate([
                    'title' => $news['category'],
                    'slug' => Str::slug($news['category'], '-'),
                ])->id;

                $news['category_id'] = $categoryId;

                News::query()->firstOrCreate([
                    'title' => $news['title'],
                    'text' => $news['description'],
                    'image' => $news['enclosure::url'],
                    'category_id' => $news['category_id'],
                ]);

            }
        }

        return redirect()->route('admin.parser')->with('success', 'Загрузка завершена!');
    }
}
