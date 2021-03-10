@extends('layouts.main')

@section('title', 'Админка')

@section('content')

    <h1 class="main_title">Админка | Категории | {{ $category->title }}</h1> 

        <div class="col-md-12 news_item">
            <form action="{{ route('admin.categories.update', $category) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <input id="add_news_title" type="text" class="col-md-10 form-control" name="title" value="{{ $category->title }}" required>
                    <input type="submit" class="btn btn-primary add_news_btn" value="Сохранить">
                </div>
            </form>
        </div>

@endsection