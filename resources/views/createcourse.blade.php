@extends('layouts.app')
@section('content')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
<div class="container">
   <div class="shape_hero">
      <svg width="747" height="765" viewBox="0 0 747 765" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path d="M573.913 578.756L747 0H0V765L518.178 632.31C533.36 628.422 540.951 626.478 547.273 622.654C553.611 618.819 559.019 613.623 563.103 607.443C567.177 601.279 569.422 593.771 573.913 578.756Z" fill="#133466"/>
      </svg>
   </div>
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="">
            <div class="card-body">
               <form action="/courses" method="post">
                  @csrf
                  <label class="text-white" for="name" class="col-md-4 col-form-label text-md-end">{{ __('Название курса') }}</label>
                  <input type="text" class="form-control" name="name" id="name">
                  <label class="text-white"  for="name" class="col-md-4 col-form-label text-md-end">{{ __('Введите краткое описание курса') }}</label>
                  <textarea name="description" class="form-control" id="description"></textarea>
                  <label class="text-white"  for="name" class="col-md-4 col-form-label text-md-end">{{ __('Длительность курса') }}</label>
                  <input type="number" class="form-control" name="duration" id="duration">
                  <label class="text-white"  for="name" class="col-md-4 col-form-label text-md-end">{{ __('Код курса') }}</label>
                  <input type="text" class="form-control" name="code_course" id="code_course">
                  <button class="btn btn-primary" type="submit">Создать курс</button>
               </form>
               <button class="btn btn-warning" onclick="rand()">Генерировать код</button>
            </div>
         </div>
      </div>
   </div>
</div>
<script>
   function rand() {
     document.getElementById("code_course").value = generateRandStr();
   }
   
   function generateRandStr() {
     var candidates = "ABCDEFGHIJKLMNOPQRSTUVWXY123456789";
     var result = "", rand;
     for (var i = 0; i < 4; i++) {
         for (var j = 0; j < 4; j++) {
             rand = Math.floor(Math.random() * candidates.length);
             result += candidates.charAt(rand);
         }
         if (i != 3) {
             result += "-";
         }
     }
     return result;
   }
</script>
@endsection