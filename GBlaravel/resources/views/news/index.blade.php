@extends('layouts.main')

@section('title', 'Новости')

@section('content')

    <h1 class="main_title">Все новости</h1>

    
        <div class="news_wrp">
            <div class="news_list">
                @forelse($news as $item)

                    <div class="news_item col-md-4">
                        <div class="news_item_date">
                            <a href="{{ route('news.category.show', $item->category->slug) }}">
                                <p class="news_item_category">{{ $item->category->title }}</p>
                            </a>
                            @if (date('d-m-Y', strtotime($item->date)) == date('d-m-Y'))
                                Сегодня {{ date('H:i', strtotime($item->date)) }} 
                            @else
                                {{ date('d-m-Y', strtotime($item->date)) }}
                            @endif
                        </div>
                        <div class="card-img-top news_item_img" style="background-image: url({{ $item->image ?? asset('storage/default.jpeg') }})">
                            
                        </div>
                        <h2 class="news_item_title">{{ $item->title }}</h2>
                        <div class="news_item_bottom">
                            @if ($item->isPrivate && !Auth::user())
                                <p class="news_item_more">Зарегистрируйтесь для просмотра</p>
                            @else
                                <a class="news_item_more" href="{{ route('news.show', $item) }}">Подробнее...</a>
                            @endif
                        </div>
                    </div>

                @empty
                    <p>Нет новостей</p>
                @endforelse

                <div class="news_pagination">{{ $news->links() }}</div>
                
            </div>

        </div>
   
@endsection
