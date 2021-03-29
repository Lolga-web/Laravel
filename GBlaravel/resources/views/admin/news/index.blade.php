@extends('layouts.main')

@section('title', 'Админка')

@section('content')

    <h1 class="main_title">Админка | Новости</h1> 

    @forelse($news as $item)

        <div class="admin_news_item">
            <div class="admin_news_item_container col-md-9">
                <p class="admin_news_item_date">{{ date('d-m-Y', strtotime($item->date)) }}</p>
                <h2 class="admin_news_item_title">{{ $item->title }}</h2>
            </div>
            
            <form class="admin_news_btns col-md-3" action="{{ route('admin.news.destroy', $item) }}" method="post">
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


