@extends('layouts.main')

@section('title', 'Админка')

@section('content')

    <h1 class="main_title">Админка | Категории</h1>

    <div class="col-md-12">
        <form action="{{ route('admin.categories.store') }}" method="post">
            @csrf
            <div class="form-group row">
                <input id="add_news_title" type="text" class="col-md-10 form-control" name="title" value="">
                <input type="submit" class="btn btn-primary add_news_btn" value="Добавить категорию">
            </div>
        </form>
    </div> 
    @if($errors->has('title'))
        <div class="alert alert-danger" role="alert">
            @foreach($errors->get('title') as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @forelse($categories as $item)

        <div class="news_item">
            <h2 class="news_item_title">{{ $item->title }}</h2>
            <form action="{{ route('admin.categories.destroy', $item) }}" method="post">
                @csrf
                @method('DELETE')
                <a href="{{ route('admin.categories.edit', $item) }}" type="button" class="btn btn-success">Редактировать</a>
                <input type="submit" class="btn btn-danger" value="Удалить">
            </form>
        </div>

    @empty
        <p>Нет новостей</p>
    @endforelse

@endsection