@extends('layouts.main')

@section('title', 'Админка')

@section('content')

    <h1 class="main_title">Админка | Категории</h1>

    <div class="add_category_container">
        <form class="add_category_form" action="{{ route('admin.categories.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="add_category_title" class="col-form-label text-md-right">Название категории</label>
                @if($errors->has('title'))
                    <div class="alert alert-danger" role="alert">
                        @foreach($errors->get('title') as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                <input id="add_category_title" type="text" class="form-control" name="title" value="{{ old('title') ?? '' }}">
            </div>
            <input type="submit" class="btn btn-primary add_category_btn" value="Добавить категорию">
        </form>
    </div> 

    <div class="admin_category_container">
        @forelse($categories as $item)

            <div class="admin_category_item">
                <h2 class="admin_category_item_title">{{ $item->title }}</h2>
                <form class="admin_category_btns" action="{{ route('admin.categories.destroy', $item) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('admin.categories.edit', $item) }}" type="button" class="btn btn-success">Редактировать</a>
                    <input type="submit" class="btn btn-danger" value="Удалить">
                </form>
            </div>

        @empty
            <p>Нет категорий</p>
        @endforelse
    </div>

@endsection