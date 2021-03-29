@extends('layouts.main')

@section('content')

<h1 class="main_title">Админка | Редактировать пользователя</h1>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.users.update', $user) }}">
                        @csrf
                        @method('PUT')
                        @if ($user->is_admin)
                            <div class="form-group row">
                                <p class="col-md-4 col-form-label text-md-right">Статус:</p>
                                <p class="col-md-6 col-form-label">Админ</p>
                            </div>
                        @endif
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Имя пользователя</label>

                            <div class="col-md-6">
                                @if ($errors->has('name'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach ($errors->get('name') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') ?? $user->name }}" autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label>

                            <div class="col-md-6">
                                @if ($errors->has('email'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach ($errors->get('email') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') ?? $user->email }}">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Новый пароль</label>

                            <div class="col-md-6">
                                @if ($errors->has('newPassword'))
                                    <div class="alert alert-danger" role="alert">
                                        @foreach ($errors->get('newPassword') as $error)
                                            {{ $error }}
                                        @endforeach
                                    </div>
                                @endif
                                <input id="password-confirm" type="password" class="form-control" name="newPassword">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Изменить пользователя
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection