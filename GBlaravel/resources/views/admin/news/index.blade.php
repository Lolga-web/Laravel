@extends('layouts.main')

@section('title', 'Админка')

@section('content')

    <h1 class="main_title">Админка | Новости</h1> 

    @forelse($news as $item)

        <div class="news_item">
            <h2 class="news_item_title">{{ $item->title }}</h2>
            <form action="{{ route('admin.news.destroy', $item) }}" method="post">
                @csrf
                @method('DELETE')
                <a href="{{ route('admin.news.edit', $item) }}" type="button" class="btn btn-success">Редактировать</a>
                <input type="submit" class="btn btn-danger" value="Удалить">
            </form>
        </div>

    @empty
        <p>Нет новостей</p>
    @endforelse

    {{ $news->links() }}

@endsection


