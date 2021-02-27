@extends('layouts.main')

@section('title', 'Новости')

@section('content')
    <h1 class="main_title">Новости</h1>

    <div class="news_wrp">
        <div class="news_list">
            @forelse($news as $item)

                <div class="news_item">
                    <h2 class="news_item_title">{{ $item['title'] }}</h2>

                    @if (!$item['isPrivate'])
                        <a href="{{ route('news.show', $item['id']) }}">Подробнее...</a>
                    @else
                        <p>Зарегистрируйтесь для просмотра</p>
                    @endif
                </div>

            @empty
                <p>Нет новостей</p>
            @endforelse
        </div>

        <div class="news_categories">
    
        </div>
    </div>

@endsection
