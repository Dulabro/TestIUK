@extends('layouts.app') @section('content')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
<div class="container">
   <div class="shape_hero">
      <svg width="747" height="765" viewBox="0 0 747 765" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path d="M573.913 578.756L747 0H0V765L518.178 632.31C533.36 628.422 540.951 626.478 547.273 622.654C553.611 618.819 559.019 613.623 563.103 607.443C567.177 601.279 569.422 593.771 573.913 578.756Z" fill="#133466" />
      </svg>
   </div>
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="">
            <div class="card-header text-light">{{ __('Лист создание лекции') }}</div>
            <div class="card-body">
               <form action="/lectures" method="post">
                  @csrf
                  <div class="row mb-3">
                     <label for="name" class="col-md-4 col-form-label text-light text-md-end">{{ __('Введите название лекции') }}</label>
                     <div class="col-md-6">
                        <input type="text" class="form-control" name="name" id="name">
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="name" class="col-md-4 col-form-label text-light text-md-end">{{ __('Введите краткое описание лекции') }}</label>
                     <div class="col-md-6">
                        <textarea name="description" class="form-control" id="description"></textarea>
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="name" class="col-md-4 col-form-label text-light text-md-end">{{ __('Введите содержимое лекции') }}</label>
                     <div class="col-md-6">
                        <textarea class="form-control" name="text_lectures" id="text_lectures"></textarea>
                     </div>
                  </div>
                  <div class="row mb-3">
                     <label for="name" class="col-md-4 col-form-label text-light text-md-end">{{ __('Выберите курс') }}</label>
                     <div class="col-md-6">
                        <select name="courses" class="form-control">
                           @foreach ($allcourses as $courses)
                           <option value="{{ $courses->id }}">{{ $courses->name }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <button class="btn btn-primary" type="submit">Добавить лекцию</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection