<!-- Right Side Of Navbar -->
<ul class="navbar-nav ml-auto">
    <!-- Authentication Links -->
    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Авторизация') }}</a>
            </li>
        @endif
        
        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Регистрация') }}</a>
            </li>
        @endif
    @else
        <img src="{{ Auth::User()->avatar }}" width="40" alt="">
        
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                @if (Auth::user()->is_admin)
                    <a class="dropdown-item" href="{{ route('admin.news.create') }}">Добавить новость</a>
                    <a class="dropdown-item" href="{{ route('admin.index') }}">Редактировать новости</a>
                    <a class="dropdown-item" href="{{ route('admin.categories.index') }}">Редактировать категории</a>
                    <a class="dropdown-item" href="{{ route('admin.users.index') }}">Редактировать пользователей</a>
                    <a class="dropdown-item" href="{{ route('admin.resources.index') }}">Парсить новости</a>
                    <!-- <a class="dropdown-item" href="{{ route('admin.download') }}">Скачать данные</a> -->
                @endif
                <a class="dropdown-item" href="{{ route('user.updateProfile') }}">Профиль</a>
                <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    {{ __('Выйти') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
</ul>