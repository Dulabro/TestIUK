<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'Laravel') }}</title>
      <!-- Scripts -->
      <script src="{{ asset('js/app.js') }}" defer></script>
   

      <!-- Fonts -->
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

      <!-- Styles -->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      <script src="{{ asset('js/clear-session.js') }}"></script>
      <script src="{{ asset('js/logout-on-close.js') }}"></script>
   </head>
   <body>
      <div id="app">
         <nav class="navbar navbar-expand-md navbar-light">
            <div class="container">
               <a class="navbar-brand text-light" href="{{ url('/') }}">
               {{ config('app.name', 'Corporate DLS') }}
               </a>
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Corporate DLS">
               <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <!-- Left Side Of Navbar -->
                  @guest
                  {{-- 
                  <ul class="navbar-nav">
                     <li class="nav-item active">
                        <a class="nav-link text-light" href="#">Главная</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-light" href="#">О проекте</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-light" href="#">Курсы</a>
                     </li>
                     <li class="nav-item">
                        <a class="nav-link text-light" href="#">Контакты</a>
                     </li>
                  </ul>
                  --}}
                  @endguest   
                  <!-- Right Side Of Navbar -->
                  <ul class="navbar-nav ms-auto">
                     @role('admin')
              
                     <a href="{{ route('course') }}" class="btn main m-1">{{ __('Лист курсов') }}</a>
                     <a href="{{ route('courses') }}" class="btn main m-1">{{ __('Создать курс') }}</a>
                     <a href="{{ route('home') }}" class="btn main m-1">{{ __('Личный кабинет') }}</a>
                     <a href="{{ route('logout') }}" class="btn main m-1" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Выход') }}</a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                     </form>
                     @else
                     @auth
                     
                     <a href="{{ route('course') }}" class="btn main m-1">{{ __('Лист курсов') }}</a>
                     <a href="{{ route('home') }}" class="btn main m-1">{{ __('Личный кабинет') }}</a>
                     <a href="{{ route('logout') }}" class="btn main m-1" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Выход') }}</a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                     </form>
                     @endif
         
                     @endif     
                         
                             @guest
                             @if (Route::has('login'))
                                 <a href="{{ route('login') }}" class="btn btn-outline-primary m-1">{{ __('Вход') }}</a>     
                             @endif
                             @if (Route::has('register'))
                                 <a href="{{ route('register') }}" class="btn main m-1">{{ __('Регистрация') }}</a>
                             @endif
                         
                           
                         @endguest
                  </ul>
               </div>
            </div>
         </nav>
         <main class="py-4">
            @yield('content')
         </main>
      </div>
    
   </body>
</html>