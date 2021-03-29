@extends('layouts.main')

@section('title', 'Админка')

@section('content')

    <h1 class="main_title">Админка | Загрузка новостей</h1>

    <a href="{{ route('admin.parse') }}" class="parse_btn" onclick="btnLoad()">
        <p class="btn btn-primary btn_active">Загрузить новости</p>
        
        <button class="btn btn-primary btn_load" type="button" disabled>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Загрузка...
        </button>
    </a>

    <div class="resource_container">
        <div class="resource_list col-md-8">
            @forelse($resources as $item)

                <div class="resource_item">
                    <p class="resource_title">{{ $item->title }}</p>
                    <p class="resource_url">{{ $item->url }}</p>
                    <form action="{{ route('admin.resources.destroy', $item) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="btn btn-danger" value="Удалить">
                    </form>
                </div>

            @empty
                <p>Нет ресурсов</p>
            @endforelse
        </div>

        <div class="resource_add_container col-md-4">
            <form action="{{ route('admin.resources.store') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="resource_add_title" class="col-form-label text-md-right">Название ресурса</label>
                    @if($errors->has('title'))
                        <div class="alert alert-danger" role="alert">
                            @foreach($errors->get('title') as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <input id="resource_add_title" type="text" class="form-control" name="title" value="{{ old('title') ?? '' }}">
                </div>
                <div class="form-group">
                    <label for="resource_add_url" class="col-form-label text-md-right">Адрес ресурса</label>
                    @if($errors->has('url'))
                        <div class="alert alert-danger" role="alert">
                            @foreach($errors->get('url') as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <input id="resource_add_url" type="text" class="form-control" name="url" value="{{ old('url') ?? '' }}">
                </div>
                <input type="submit" class="btn btn-primary" value="Добавить ресурс">   
            </form>
        </div> 
    </div>

    <script src="{{ asset('assets/js/parseBtnLoad.js') }}"></script>

@endsection