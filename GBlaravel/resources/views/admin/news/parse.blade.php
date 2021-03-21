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

    <script src="{{ asset('assets/js/parseBtnLoad.js') }}"></script>

@endsection