@extends('layouts.app') @section('content')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
<div class="container">
   <div class="shape_hero">
      <svg width="747" height="765" viewBox="0 0 747 765" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path d="M573.913 578.756L747 0H0V765L518.178 632.31C533.36 628.422 540.951 626.478 547.273 622.654C553.611 618.819 559.019 613.623 563.103 607.443C567.177 601.279 569.422 593.771 573.913 578.756Z" fill="#133466" />
      </svg>
   </div>
   <div class="card-body">
      <div class="card-header text-light" style="font-size:23px; text-align:center; height:4rem;">{{ __('Лист предварительного просмотра') }}</div>
      <div class="card-header text-light" style="font-size:19px; text-align:center; height:4rem;">{{$lectures->name}}</div>
      @if (session('status'))
      <div class="alert alert-success" role="alert">
         {{ session('status') }}
      </div>
      @endif
     
         @if (session('status'))
         <div class="alert alert-success" role="alert">
            {{ session('status') }}
         </div>
         @endif
       
         <div class="lecture">
         <span class="text-light">Краткое описание лекции</span>
         <br>
         <textarea id="w3review" class="form-control" style="overflow: hidden" name="w3review" readonly rows="4" cols="50">{!!$lectures->description!!}</textarea>
      
      </div>
         <span class="text-light">Лекция</span>
         <br>
         <div id="text_lectures" style="overflow: hidden" class="form-control" name="w3review" readonly rows="4" cols="50">{!! $lectures->text_lectures !!}  </div>
         <div class="text-center">
            <a href="{{ route('download', ['id' => $lectures->id]) }}" class="btn main large-button">Скачать документ</a>
            @role('admin')
            <form method="POST" action="{{ route('lectures.destroy', $lectures->id) }}">
               @csrf @method('DELETE')
               <button type="submit" class="btn btn-danger large-button">Удалить</button>
            </form>
            <a href="{{ route('lectures.edit', ['lecture' => $lectures->id]) }}" class="btn main large-button">Редактировать</a>
            <a href="{{ route('course') }}" class="btn main large-button">Назад</a>
            @endrole
          </div>
       
        
     
   </div>
</div>
</div>
</div>
<script>
window.onload = function() {
   const textarea1 = document.getElementById('w3review');
   const textarea2 = document.getElementById('text_lectures');
   textarea1.style.height = 'auto';
   textarea1.style.height = `${textarea1.scrollHeight}px`;
   textarea2.style.height = 'auto';
   textarea2.style.height = `${textarea2.scrollHeight}px`;
};
</script>
@endsection