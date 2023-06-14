@extends('layouts.app')

@section('content')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
<div class="container pt-5 pb-5">
<div class="shape_hero"><svg width="747" height="765" viewBox="0 0 747 765" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M573.913 578.756L747 0H0V765L518.178 632.31C533.36 628.422 540.951 626.478 547.273 622.654C553.611 618.819 559.019 613.623 563.103 607.443C567.177 601.279 569.422 593.771 573.913 578.756Z" fill="#133466"/>
</svg>
 </div>
    <div class="row justify-content-center">
    <div class="col-md-6">
        <div class="text_welcome">
        <h1 class="text-light mb-4" style="font-size: 60px; font-weight:700;">Лучшие возможности обучения</h1>
                <h3 class="text-light mb-4">Представляем лучшие курсы для корпоративного обучения и повышение компетенции ваших сотрудников.</h3>
        </div>

    </div>
        <div class="col-md-6">
            <div class="trnsprnt">
               

                <div class="card-body">
              
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                        <h3 class="text-light text-center">{{ __('Вход') }}</h3>
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <label class="text-white" for="name" style="font-size: 15px;" class="col-md-4 col-form-label text-md-end">{{ __('Введите Email') }}</label>
                                <input id="email" type="email" placeholder="{{ __('Введите Email') }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                        <div class="mb-3">
                            <div class="row justify-content-center">
                            <div class="col-md-6">
                                <label class="text-white" for="name" style="font-size: 15px;" class="col-md-4 col-form-label text-md-end">{{ __('Введите пароль') }}</label>
                                <input id="password" type="password" placeholder="{{ __('Введите пароль') }}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        </div>

                        <div class="mb-3">
                            <div class="text-center">
                                <button type="submit" class="btn middle-button" style="background-color: #184C99;color: #ffffff;">
                                    {{ __('Авторизоваться') }}
                                </button>
                             </div>
            
                            <hr class="hr" style="margin: 20px 100px 50px 200px;" />
                        </div>
                        <div class="mb-3">
                            <div class="col-md-6 offset-md-4">
                                
                                {{-- <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label labels" for="remember">
                                        {{ __('Запомнить меня') }}
                                    </label>
                                </div> --}}
                                {{-- @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Забыли пароль?') }}
                                </a>
                            @endif --}}
                            </div>
                        </div>

                    </form>
               
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
