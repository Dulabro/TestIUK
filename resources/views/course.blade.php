@extends('layouts.app')
@section('content')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
<div class="container">
   <div class="shape_hero">
      <svg width="747" height="765" viewBox="0 0 747 765" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path d="M573.913 578.756L747 0H0V765L518.178 632.31C533.36 628.422 540.951 626.478 547.273 622.654C553.611 618.819 559.019 613.623 563.103 607.443C567.177 601.279 569.422 593.771 573.913 578.756Z" fill="#133466"/>
      </svg>
   </div>
   <div class="card-body">
      @if (session('status'))
      <div class="alert alert-success" role="alert">
         {{ session('status') }}
      </div>
      @endif 
      <div class="card-body">
         @if (session('status'))
         <div class="alert alert-success" role="alert">
            {{ session('status') }}
         </div>
         @endif
         @role("admin")
         <div class="ag-format-container">
            <div class="ag-courses_box">
               @foreach ($courses as $course)
               <div class="course_card">
                  <div class="block">
                     <h2>{{ $course->name }}</h2>
                     <p class="course_text">
                        {{ $course->description }}
                     </p>
                     <div class="course_users">
                        <p>Автор курса:</p>
                        <p>{{ $course->author_name }}</p>
                     </div>
                     <div class="course_info">
                        <div class="course_time">
                           <img src="img\vector-3.svg" alt="time" class="img_block" />
                           <p>{{ $course->duration }}ч</p>
                        </div>
                        <div class="course_lesson">
                           <img src="img\vector-2.svg" alt="lesson" class="img_block" />
                           <p>24 Лекций</p>
                        </div>
                        <div class="course_test">
                           <img src="img\vector-1.svg" alt="test" class="img_block" />
                           <p>10 Тестов</p>
                        </div>
                        <div><a href="courses/{{$course->id}}" class="course_btn">Подробней</a></div>
                     </div>
                  </div>
               </div>
               @endforeach
            </div>
         </div>
         @else
         <form action="/codecourse" method="post">
            @csrf
            <div class="col-md-6">
               <input id="code_course" name="code_course" type="text" placeholder="{{ __('Введите код курса') }}" class="form-control @error('code_course') is-invalid @enderror" required autofocus>
            </div>
            <button class="btn btn-primary" type="submit">Отправить</button>
         </form>
         <div class="col-md-12">
            <div class="ag-format-container">
               <div class="ag-courses_box">
                  @foreach ($courses as $course)
                  <div class="course_card">
                     <div class="block">
                        <h2>{{ $course->courses_name }}</h2>
                        <p class="course_text">
                           {{ $course->courses_description }}
                        </p>
                        <div class="course_users">
                           <p>Автор курса:</p>
                        </div>
                        <div class="course_info">
                           <div class="course_time">
                              <img src="img\vector-3.svg" alt="time" class="img_block" />
                              <p>12hr 20min</p>
                           </div>
                           <div class="course_lesson">
                              <img src="img\vector-2.svg" alt="lesson" class="img_block" />
                              <p>24 Лекций</p>
                           </div>
                           <div class="course_test">
                              <img src="img\vector-1.svg" alt="test" class="img_block" />
                              <p>10 Тестов</p>
                           </div>
                           <div><a href="courses/{{$course->courses_id}}" class="course_btn">Подробней</a></div>
                        </div>
                     </div>
                  </div>
                  @endforeach
               </div>
            </div>
         </div>
         @endif
      </div>
   </div>
</div>
@endsection