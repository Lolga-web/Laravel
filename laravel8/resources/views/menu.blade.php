
<li class="nav-item">
    <a class="nav-link" href="{{ route('home') }}">Главная</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('news.index') }}">Новости</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('news.category.index') }}">Категории</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="{{ route('about') }}">О нас</a>
</li>
<li class="nav-item dropdown">
    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
        Админка</a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('admin.index') }}">Добавить новость</a>
    </div>
</li>

