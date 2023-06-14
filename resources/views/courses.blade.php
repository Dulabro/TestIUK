@extends('layouts.app')
@section('content')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
<div class="container">
<div class="shape_hero">
   <svg width="747" height="765" viewBox="0 0 747 765" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M573.913 578.756L747 0H0V765L518.178 632.31C533.36 628.422 540.951 626.478 547.273 622.654C553.611 618.819 559.019 613.623 563.103 607.443C567.177 601.279 569.422 593.771 573.913 578.756Z" fill="#133466"/>
   </svg>
</div>
@if (session('status'))
<div class="alert alert-success" role="alert">
   {{ session('status') }}
</div>
@endif 
<div class="row justify-content-center">
   <div class="col-md-12">
      <div class="card-body">
         @if (session('status'))
         <div class="alert alert-success" role="alert">
            {{ session('status') }}
         </div>
         @endif
         <span class="text-light">Название курса:</span>
         <span class="text-light">{{$course->name}}</span>
         <br>
         <span class="text-light">Описание курса:</span>
         <span class="text-light">{{$course->description}}</span>
         <br>
         <span class="text-light">Код курса:</span>
         <span class="text-light">{{$course->code_course}}</span>
         <br>
         <span class="text-light">Автор курса:</span>
         <span class="text-light"> {{$user_name}}</span>
         <br>
         <span class="text-light">Длительность курса:</span>
         <span class="text-light">{{$course->duration}}ч.</span>
         <h2 class="text-light"></h2>
         <div class="row">
            <div class="col-sm">
               @role('admin')
               <div class="blocks">
                  <a href="{{ route('lectures_create') }}" class="m-2 btn main middle-button">Добавить лекцию</a>
                  <a href="{{ route('tests_create') }}" class="m-2 btn main middle-button">Добавить тест</a>
                  <a href="{{ route('courses.members', ['id' => $course->id]) }}" class="m-2 btn main middle-button">Участники курса</a>
                  <form method="POST" action="{{ route('courses.destroy', $course->id) }}">
                     @csrf
                     @method('DELETE')
                     <button type="submit" class="m-2 btn btn-danger large-button">Удалить курс</button>
                  </form>
               </div>
               @endrole 
            </div>
            <div class="col-sm">
               <div class="blocks">
                  @foreach ($lectures as $lecture)
                  <a href="lecture/{{$lecture->id}}" class="m-2 btn main middle-button">{{ $lecture->name }}</a>
                  @endforeach
               </div>
               <br>  
            </div>
            
            <div class="col-sm">
               <div class="blocks">
                  @foreach ($tests as $test)
                  <a href="{{ route('test.show',['id' => $test->id]) }}" class="m-2 btn btn-success middle-button">{{ $test->name }}</a>
                  @endforeach
               </div>
            </div>
           
         </div>
      </div>
   </div>
</div>
@endsection