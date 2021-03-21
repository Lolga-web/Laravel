@extends('layouts.main')

@section('title', 'Админка')

@section('content')

    <h1 class="main_title">Админка | Категории | {{ $category->title }}</h1> 

        <div class="col-md-12">
            <form action="{{ route('admin.categories.update', $category) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <input id="add_news_title" type="text" class="col-md-10 form-control" name="title" value="{{ $category->title }}">
                    <input type="submit" class="btn btn-primary add_news_btn" value="Сохранить">
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

@endsection