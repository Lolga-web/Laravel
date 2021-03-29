<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\NewsParsing;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Orchestra\Parser\Xml\Facade as XmlParser;
use App\Models\Category;
use App\Models\News;
use App\Models\Resource;

class ParserController extends Controller
{
    public function parse() {

        $rssLinks = Resource::all()->pluck('url');

        $start = microtime(true);

        foreach ($rssLinks as $link) {
            NewsParsing::dispatch($link);
        }
        $end = microtime(true);

        return redirect()->route('admin.resources.index')
                        ->with('success', 'Загрузка завершена! Время: ' . $end - $start);

    }
}
