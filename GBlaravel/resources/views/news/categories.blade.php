@extends('layouts.main')

@section('title', 'Категории')

@section('content')
    <h1 class="main_title">Категории новостей</h1>

    <div class="categories_list_container">

        <div class="categories_list">
            @forelse($categoriesWithNews as $category)
                <div class="categories_item btn btn-primary">
                    <a class="categories_item_link" href="{{ route('news.category.show', $category->slug) }}">
                        <h2 class="categories_item_title">{{ $category->title }}</h2>
                    </a>
                </div>
            @empty
                <p>Нет категорий</p> 
            @endforelse
        </div>

    </div>

    <div class="categories_news_container">

        @foreach($categoriesWithNews as $category)
            @if (count($category->news) >= 3)

            <div class="categories_news_category">
                <a href="{{ route('news.category.show', $category->slug) }}" class="category_news_link">
                    <h2 class="category_news_title">{{ $category->title }}</h2>
                </a> 
                
                <div class="category_news_list">
                    @foreach($category->news as $item)
                        
                        @if ($loop->iteration <= 3)
                        <a class="category_news_item_link" href="{{ route('news.show', $item) }}">
                            <div class="category_news_item">
                                <div class="card-img-top category_news_item_img" 
                                    style="background-image: url({{ $item->image ?? asset('storage/default.jpeg') }})">   
                                </div>
                                <div class="category_news_item_container">
                                    <h3 class="category_news_item_title">{{ $item->title }}</h3>
                                    <div class="category_news_item_date">
                                        @if (date('d-m-Y', strtotime($item->date)) == date('d-m-Y'))
                                            Сегодня {{ date('H:i', strtotime($item->date)) }} 
                                        @else
                                            {{ date('d-m-Y', strtotime($item->date)) }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                        @else
                            @break
                        @endif

                    @endforeach
                </div>

                <a href="{{ route('news.category.show', $category->slug) }}" class="category_news_bottom_link">Все материалы</a> 
            </div>

            @endif
        @endforeach
      
    </div>


@endsection
