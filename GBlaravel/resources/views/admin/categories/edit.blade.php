@extends('layouts.main')

@section('title', 'Админка')

@section('content')

    <h1 class="main_title">Админка | Категории | {{ $category->title }}</h1> 

    <div class="add_category_container">
        <form class="add_category_form" action="{{ route('admin.categories.update', $category) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="add_category_title" class="col-form-label text-md-right">Название категории</label>
                @if($errors->has('title'))
                    <div class="alert alert-danger" role="alert">
                        @foreach($errors->get('title') as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <input id="add_category_title" type="text" class="form-control" name="title" value="{{ old('title') ?? $category->title ?? '' }}">
            </div>
            <input type="submit" class="btn btn-primary add_category_btn" value="Сохранить">
        </form>
    </div> 
@endsection