@extends('layouts.app') 
@section('content')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
<div class="container">
   <div class="shape_hero">
      <svg width="747" height="765" viewBox="0 0 747 765" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path d="M573.913 578.756L747 0H0V765L518.178 632.31C533.36 628.422 540.951 626.478 547.273 622.654C553.611 618.819 559.019 613.623 563.103 607.443C567.177 601.279 569.422 593.771 573.913 578.756Z" fill="#133466"/>
      </svg>
   </div>
   <form method="POST" action="{{ route('lectures.update', $lecture->id) }}">
      @csrf @method('PUT')
      <div class="form-group">
         <label class="text-white" for="name">Введите название лекции</label>
         <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $lecture->name) }}">
      </div>
      <div class="form-group">
         <label class="text-white" for="description">Введите краткое описание лекции</label>
         <textarea class="form-control" id="description" name="description">{{ old('description', $lecture->description) }}</textarea>
      </div>
      <div class="form-group">
         <label class="text-white" for="text_lectures">Введите содержимое лекции</label>
         <textarea class="form-control" id="text_lectures" name="text_lectures">{{ old('text_lectures', $lecture->text_lectures) }}</textarea>
      </div>
      <button type="submit" class="btn btn-primary">Обновить лекцию</button>
   </form>
</div>
@endsection