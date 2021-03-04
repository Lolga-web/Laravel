@extends('layouts.main')

@section('title')
    @parent Категории
@endsection

@section('content')
    @if ($category)
        <h1 class="main_title">Новости категории: {{ $category }}</h1>

        <div class="category_news_wrp">
            <div class="category_news_list">
                @forelse($news as $item)
                    <div class="category_news_item">
                        <h2 class="category_news_item_title">{{ $item['title'] }}</h2>
                        @if (!$item['isPrivate'])
                            <a href="{{ route('news.show', $item['id']) }}">Подробнее..</a>
                        @else
                            <p>Зарегистрируйтесь для просмотра</p>
                        @endif
                    </div>
                @empty
                    <p>Нет новостей</p>
                @endforelse
            </div>
        </div>
    @else
        <p>Нет такой категории</p> 
    @endif
@endsection
