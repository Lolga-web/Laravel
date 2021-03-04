@extends('layouts.main')

@section('title', 'Категории')

@section('content')
    <h1 class="main_title">Категории новостей</h1>

    <div class="categories_wrp">

        <div class="categories_list">
            @forelse($categories as $category)
                <div class="categories_item">
                    <a href="{{ route('news.category.show', $category['slug']) }}">
                        <h2 class="categories_item_title">{{ $category['title'] }}</h2>
                    </a>
                </div>
            @empty
                <p>Нет категорий</p> 
            @endforelse
        </div>

    </div>
@endsection
