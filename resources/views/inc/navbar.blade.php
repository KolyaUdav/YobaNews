<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
        <img src="{{asset('images/logo.png')}}" alt="" width="24" height="24" class="d-inline-block align-text-top">
        YobaNews
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/">Главная</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/posts">Новости</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">О нас</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Контакты</a>
        </li>
      </ul>

      @guest
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="/login" class="nav-link">Войти</a>
          </li>
          <li class="nav-item">
            <a href="/register" class="nav-link">Регистрация</a>
          </li>
        </ul>
      @endguest

      @auth
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="/posts/dashboard" class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item">
          <a href="/posts/create" class="nav-link">Добавить новость</a>
        </li>
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                {!! Form::open(['route' => 'logout', 'method' => 'POST', 'id' => 'logout-form']) !!}
                {!! Form::close() !!}
            </div>
        </li>
      </ul>
      @endauth

    </div>
  </div>
</nav>