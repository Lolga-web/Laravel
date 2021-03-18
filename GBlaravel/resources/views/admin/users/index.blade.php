@extends('layouts.main')

@section('title', 'Админка')

@section('content')

    <h1 class="main_title">Админка | Пользователи</h1> 
    
    @forelse($users as $item)

        @if ($item->id !== Auth::user()->id && $item->id !== 1)
            <div class="user_item">
                <h2 class="user_item_title col-md-2">{{ $item->name }}</h2>
                <div class="user_item_is_admin custom-control custom-switch  col-md-3">
                    <input type="checkbox" class="custom-control-input" data-id="{{ $item->id }}"
                        @if ($item->is_admin) checked @endif 
                        id="customSwitch{{ $item->id }}">
                    <label class="custom-control-label" for="customSwitch{{ $item->id }}">Назначить админом</label>
                </div>
                <form action="{{ route('admin.users.destroy', $item) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <a href="{{ route('admin.users.edit', $item) }}" type="button" class="btn btn-success">Редактировать</a>
                    <input type="submit" class="btn btn-danger" value="Удалить">
                </form>
            </div>
        @endif

    @empty
        <p>Нет пользователей</p>
    @endforelse

    <script src="{{ asset('assets/js/isAdminAjax.js') }}"></script>

@endsection
