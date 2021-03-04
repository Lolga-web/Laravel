@extends('layouts.main')

@section('title', 'Админка')

@section('content')

    <h1 class="main_title">Админка</h1> 
      
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Добавить новость') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.create') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="add_news_category" class="col-md-2 col-form-label text-md-right">{{ __('Категория') }}</label>
                            <div class="col-md-9">
                                <select name="category_id" id="add_news_category" class="form-control">
                                    @forelse($categories as $item)
                                        <option
                                            @if ($item['id'] == old('category')) selected
                                            @endif
                                            value="{{ $item['id'] }}">{{ $item['title'] }}
                                        </option>
                                    @empty
                                        <option value="0">Нет категорий</option>
                                    @endforelse
                                </select>
                            </div>                               
                        </div>

                        <div class="form-group row">
                            <label for="add_news_title" class="col-md-2 col-form-label text-md-right">{{ __('Заголовок') }}</label>

                            <div class="col-md-9">
                                <input id="add_news_title" type="text" class="form-control" name="title" value="{{ old('title') }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="add_news_text" class="col-md-2 col-form-label text-md-right">{{ __('Текст') }}</label>

                            <div class="col-md-9">
                                <textarea id="add_news_text" name="text" class="form-control add_news_text">{{ old('text') }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-2">
                                <div class="form-check">
                                    <input @if (old('isPrivate')) checked @endif name="isPrivate" type="checkbox" value="1"
                                        id="add_news_private" class="form-check-input">
                                    <label for="add_news_private">Приватная</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-11">
                                <button type="submit" class="btn btn-primary add_news_btn">
                                    {{ __('Сохранить') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 

@endsection