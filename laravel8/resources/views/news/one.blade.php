@extends('layouts.main')

@section('title', 'Новость')

@section('content')
    @if ($news)
        @if (!$news['isPrivate'])
            <h1 class="main_title">{{ $news['title'] }}</h1>
            <p>{{ $news['text'] }}</p>
        @else
            <p>Зарегистрируйтесь для просмотра</p>
        @endif
    @else
        <p>Нет новости с таким id</p>
    @endif
@endsection
