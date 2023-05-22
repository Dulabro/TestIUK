@extends('layouts.app')

@section('content')
<style>
body {
    background: #252B42;
}
    .shape_hero {
    z-index: -1;
    position: absolute;
    top: 0px;
    left: 0px;
}
.text_welcome {
    padding: 100px 0px;
}
input#email {
    background: transparent;
    color: #ffffff;
}
input#name {
    background: transparent;
    color: #ffffff;
}
input#password {
    background: transparent;
    color: #ffffff;
}
input#password-confirm {
    background: transparent;
    color: #ffffff;
}
select#roles {
    background: transparent;
    color: #ffffff;
}
option {
    color: #000;
}
.trnsprnt{
    background: transparent
}
form {
    display: block;
    padding: 25px 0px;
    width: 100%;
    color: white;
    margin-right: auto;
    margin-left: auto;
}

</style>
<div class="container pt-5 pb-5">
<div class="shape_hero"><svg width="747" height="765" viewBox="0 0 747 765" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M573.913 578.756L747 0H0V765L518.178 632.31C533.36 628.422 540.951 626.478 547.273 622.654C553.611 618.819 559.019 613.623 563.103 607.443C567.177 601.279 569.422 593.771 573.913 578.756Z" fill="#133466"/>
</svg>
 </div>
    <div class="row justify-content-center">
    <div class="col-md-6">
    <div class="text_welcome">
        <h1 class="text-light mb-4">Лучшие возможности обучения</h1>
                <h2 class="text-light mb-4">Представляем лучшие курсы для корпоративного обучения и повышение компетенции ваших сотрудников.</h2>
        </div>
    </div>
        <div class="col-md-6">
            <div class="">
              

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                        <h3 class="text-light offset-md-5">{{ __('Регистрация') }}</h3>
                            <div class="col-md-6 offset-md-4">
                                <input id="name" type="text" placeholder="{{ __('Введите ФИО') }}" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
    
                            <div class="col-md-6 offset-md-4">
                                <input id="email" type="email" placeholder="{{ __('Введите Email') }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">

                            <div class="col-md-6 offset-md-4">
                                <input id="password" type="password" placeholder="{{ __('Введите пароль') }}" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            
                            <div class="col-md-6 offset-md-4">
                                <input id="password-confirm" type="password" placeholder="{{ __('Повторите пароль') }}" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        <div class="mb-3">
                           
                            <div class="col-md-6 offset-md-4">
                            <select name="roles" class="form-control" id="roles">
                             
                                <option value="1">Учитель</option>
                                <option value="2">Ученик</option>
                            </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-group">
                                    <label for="image">Аватарка</label>
                                    <input type="file" class="form-control-file" id="image" name="image" accept="image/*" required>
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                    </div>
                </div>

                        <div class="mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Регистрация') }}
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
