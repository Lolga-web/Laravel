@extends('layouts.main')

@section('title', 'Новости')

@section('content')
    <h1 class="main_title">Новости</h1>

    <div class="news_wrp">
        <div class="news_list">
            @forelse($news as $item)

                <div class="news_item">
                    <h2 class="news_item_title">{{ $item->title }} 
                        <a class="news_item_category" href="{{ route('news.category.show', $item->category->slug) }}">Категория: {{ $item->category->title }}</a>
                    </h2>
                    <div class="news_item_img" style="background-image: url({{ $item->image ?? asset('storage/default.jpg') }})"></div>

                    @if (!$item->isPrivate)
                        <a href="{{ route('news.show', $item) }}">Подробнее...</a>
                    @else
                        <p>Зарегистрируйтесь для просмотра</p>
                    @endif
                </div>

            @empty
                <p>Нет новостей</p>
            @endforelse

            {{ $news->links() }}
        </div>

        <div class="news_categories">
    
        </div>
    </div>

@endsection
