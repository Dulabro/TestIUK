@extends('layouts.app') @section('content')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
<div class="container">
   <div class="shape_hero">
      <svg width="747" height="765" viewBox="0 0 747 765" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path d="M573.913 578.756L747 0H0V765L518.178 632.31C533.36 628.422 540.951 626.478 547.273 622.654C553.611 618.819 559.019 613.623 563.103 607.443C567.177 601.279 569.422 593.771 573.913 578.756Z" fill="#133466" />
      </svg>
   </div>
   @if(session('success'))
   <div class="alert alert-success">
      {{ session('success') }}
   </div>
   @endif
   <div class="card-header text-light offset-md-4" style="font-size:23px; height:4rem;">{{ __('Личный кабинет пользователя') }}</div>
   <div class="card-body">
      @if (session('status'))
      <div class="alert alert-success" role="alert">
         {{ session('status') }}
      </div>
      @endif
      <div class='row'>
         <div class="col-md-6">
            <div class='row'>
               <div class="col-md-4">
                  @if($user->image=="NULL")
                  <img class="profile_image" src="" alt="">
                  @else
                  <img class="profile_image" src="{{ asset('storage/' . $user->image) }}" alt="">
                  @endif
               </div>
               <div class="col-md-8">
                  <span class="text-primary">Пользователь:</span>
                  <br>
                  <span class="text-light">{{$user->name}}</span>
                  <br>
                  <span class="text-primary">Email:</span>
                  <br>
                  <span class="text-light">{{$user->email}}</span>
                  <br>
                  <span class="text-primary">Ваш статус:</span>
                  @role('admin')
                  <br>
                  <span class="text-light">Преподователь</span>
                  @else
                  <br>
                  <span class="text-light">Ученик</span>
                  @endrole 
               </div>
            </div>
            <button class="btn btn-primary" id="myBtn">Редактировать профиль</button>
         </div>
         @role('admin')
         <div class="col-md-6">
            <form method="POST" action="{{ route('change-password') }}">
               @csrf
               <div>
                  <label class="text-light" for="current_password">Введите старый пароль</label>
                  <input type="password" class="form-control" id="current_password" name="current_password">
                  @error('current_password')
                  <div>{{ $message }}</div>
                  @enderror
               </div>
               <div>
                  <label class="text-light" for="new_password">Введите новый пароль</label>
                  <input type="password" class="form-control" id="new_password" name="new_password">
                  @error('new_password')
                  <div>{{ $message }}</div>
                  @enderror
               </div>
               <div>
                  <label class="text-light" for="new_password_confirmation">Введите еще раз новый пароль</label>
                  <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                  @error('new_password_confirmation')
                  <div>{{ $message }}</div>
                  @enderror
               </div>
               <button class="btn btn-primary" type="submit">Изменить пароль</button>
            </form>
         </div>
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
                        {{ $course->author_name }}
                     </div>
                     <div class="course_info">
                        <div class="course_time">
                           <img src="img\vector-3.svg" alt="time" class="img_block" />
                           <p> {{ $course->duration }}</p>
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
                     <br>
                     <div class="course_users">
                        <p>Автор курса:</p>
                        {{ $course->courses_description }}
                     </div>
                     <div class="course_info">
                        <div class="course_time">
                           <img src="img\vector-3.svg" alt="time" class="img_block" />
                           <p></p>
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
      @endrole
   </div>
</div>
<div id="myModal" class="modal">
   <!-- Modal content -->
   <div class="modal-content">
      <div class="modal-header">
         <h5 class="modal-title" id="editProfileModalLabel">Редактировать профиль</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
      </div>
      <div class="modal-body">
         <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
               <label for="name">ФИО</label>
               <input id="name" type="text" name="name" class="form-control" value="" required>
            </div>
            <div class="form-group">
               <label for="email">Email</label>
               <input id="email" type="email" name="email" class="form-control" value="" required>
            </div>
            <div class="form-group">
               <label for="image">Изображение профиля</label>
               <input id="image" type="file" name="image" class="form-control-file">
            </div>
            <button type="submit" class="btn btn-primary">Изменить</button>
         </form>
      </div>
   </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
   // Get the modal
   var modal = document.getElementById("myModal");
   
   // Get the button that opens the modal
   var btn = document.getElementById("myBtn");
   
   // Get the <span> element that closes the modal
   var span = document.getElementsByClassName("close")[0];
   
   // When the user clicks on the button, open the modal
   btn.onclick = function() {
   modal.style.display = "block";
   }
   
   // When the user clicks on <span> (x), close the modal
   span.onclick = function() {
   modal.style.display = "none";
   }
   
   // When the user clicks anywhere outside of the modal, close it
   window.onclick = function(event) {
   if (event.target == modal) {
     modal.style.display = "none";
   }
   }
</script>
@endsection