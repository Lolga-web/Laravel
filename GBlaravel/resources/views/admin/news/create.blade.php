@extends('layouts.main')

@section('title', 'Админка')

@section('content')

    <h1 class="main_title">Админка | @if ($news->id){{__('Изменить')}}@else{{__('Добавить')}}@endif новость</h1> 
      
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">{{ __('Добавить новость') }}</div>

                <div class="card-body">
                    <form method="POST" action="@if (!$news->id){{ route('admin.news.store') }}@else{{ route('admin.news.update', $news) }}@endif" 
                        enctype="multipart/form-data">
                        @csrf
                        @if ($news->id) @method('PUT') @endif
                        <div class="form-group">
                            <label for="add_news_category" class="col-form-label text-md-right">{{ __('Категория') }}</label>
                            @if ($errors->has('category_id'))
                                <div class="alert alert-danger" role="alert">
                                    @foreach ($errors->get('category_id') as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            @endif
                            <select name="category_id" id="add_news_category" class="form-control">
                                @forelse($categories as $item)
                                    @if (old('category_id'))
                                        <option @if ($item->id == old('category_id')) selected
                                                @endif value="{{ $item->id }}">{{ $item->title }}</option>
                                    @else
                                        <option @if ($item->id == $news->category_id) selected
                                                @endif value="{{ $item->id }}">{{ $item->title }}</option>
                                    @endif
                                @empty
                                    <option value="0">Нет категорий</option>
                                @endforelse
                                <option value="123">Ошибка</option>
                            </select>                                
                        </div>

                        <div class="form-group">
                            <label for="add_news_title" class="col-form-label text-md-right">{{ __('Заголовок') }}</label>
                            @if($errors->has('title'))
                                <div class="alert alert-danger" role="alert">
                                    @foreach($errors->get('title') as $error)
                                        <p>{{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif
                            <input id="add_news_title" type="text" class="form-control" name="title" 
                                value="{{ old('title') ?? $news->title ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="add_news_text" class="col-form-label text-md-right">{{ __('Текст') }}</label>
                            @if ($errors->has('text'))
                                <div class="alert alert-danger" role="alert">
                                    @foreach ($errors->get('text') as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            @endif
                            <textarea id="add_news_text" name="text" class="form-control add_news_text">{{ old('text') ?? $news->text }}</textarea>
                        </div>

                        <div class="form-check">
                            <input @if ($news->isPrivate == 1 || old('isPrivate')) checked @endif 
                                name="isPrivate" type="checkbox" value="1"
                                id="add_news_private" class="form-check-input">
                            <label for="add_news_private">Приватная</label>
                        </div>
                        @if ($errors->has('isPrivate'))
                            <div class="alert alert-danger" role="alert">
                                @foreach ($errors->get('isPrivate') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif

                        <div class="form-group">
                            <input type="file" name="image">
                        </div>
                        @if ($errors->has('image'))
                            <div class="alert alert-danger" role="alert">
                                @foreach ($errors->get('image') as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary add_news_btn">
                                @if ($news->id){{__('Изменить')}}@else{{__('Добавить')}}@endif новость
                            </button> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 

@endsection