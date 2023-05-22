@extends('layouts.app') @section('content')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
<div class="container">
   <div class="shape_hero">
      <svg width="747" height="765" viewBox="0 0 747 765" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path d="M573.913 578.756L747 0H0V765L518.178 632.31C533.36 628.422 540.951 626.478 547.273 622.654C553.611 618.819 559.019 613.623 563.103 607.443C567.177 601.279 569.422 593.771 573.913 578.756Z" fill="#133466" />
      </svg>
   </div>
   <div class="card-body">
      @if (session('status'))
      <div class="alert alert-success" role="alert">
         {{ session('status') }}
      </div>
      @endif
      <div class="card-header text-light offset-md-4" style="font-size:23px; height:4rem;">{{ __('Лист предварительного просмотра') }}</div>
      <div class="lecture">
         @if (session('status'))
         <div class="alert alert-success" role="alert">
            {{ session('status') }}
         </div>
         @endif
         <span class="text-primary">Название курса:</span>
         <br>
         <span class="text-light">{{$lectures->name}}</span>
         <br>
         <span class="text-primary">Краткое описание лекции</span>
         <br>
         <textarea id="w3review" name="w3review" readonly rows="4" cols="50">{{$lectures->description}}</textarea>
         <br>
         <span class="text-primary">Лекция</span>
         <br>
         <textarea id="w3review" name="w3review" readonly rows="4" cols="50">{!!$lectures->text_lectures!!}</textarea>
         @role('admin')
         <form method="POST" action="{{ route('lectures.destroy', $lectures->id) }}">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-danger">Удалить</button>
         </form>
         <a href="{{ route('lectures.edit', ['lecture' => $lectures->id]) }}" class="btn btn-primary">Редактировать</a>
         <a href="{{ url()->previous() }}" class="btn btn-primary">Назад</a>
         @endrole
      </div>
      <div class="ag-format-container">
         <div class="ag-courses_box">
            <div class="blocks">
               @foreach ($tests as $test)
               <a href="{{ route('test.show',['id' => $test->id]) }}" class="m-2 btn btn-success">{{ $test->name }}</a>
               @endforeach
            </div>
         </div>
      </div>
   </div>
</div>
</div>
</div>
@endsection