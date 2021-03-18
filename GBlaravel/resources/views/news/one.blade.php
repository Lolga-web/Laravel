@extends('layouts.main')

@section('title', 'Новость')

@section('content')
    @if ($news)
        @if ($news->isPrivate && !Auth::user())
            <p>Зарегистрируйтесь для просмотра</p>
        @else
            <h1 class="main_title">{{ $news->title }}</h1>
            <div class="news_item_img" style="background-image: url({{ $news->image ?? asset('storage/default.jpg') }})"></div>
            <p>{{ $news->text }}</p>
        @endif
    @else
        <p>Нет новости с таким id</p>
    @endif
@endsection
