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
   <div class="row justify-content-center">
      <div class="col-md-6">
         <div class="card-header text-light" style="font-size:23px; text-align:center; height:4rem;">{{ __('Лист предпросмотра теста') }}</div>
         <div class="card-header text-light" style="font-size:23px; text-align:center; height:4rem;">{{ $tests->name }}</div>
         <div class="card-body">
            <form method="post" action="{{ route('test.calculateValue', ['id' => $tests->id]) }}">
               @csrf @foreach ($questions as $question)
               <input type="text" class="form-control"  id="name" value="{{ old('question', $question->question) }}" readonly>
               {{-- <h2 class="text-light">{{ $question->question }}</h2> --}}
               <div>
                  @foreach ($question->answers as $answer)
                  <div class="block-test mt-4 mb-4">
                     <input type="text" class="form-control" value="{{ old('question', $answer->answer) }}" readonly>
                     <input type="checkbox" class="checkbox ml-2" name="answers[]" value="{{ $answer->valid }}" id="">

                     {{-- <label class="text-light" for="answer_{{ $answer->id }}">{{ $answer->answer }}</label> --}}
                  </div>
                  @endforeach
               </div>
               @endforeach
               <div class="text-center">
               <button class="btn main large-button" type="submit">Отправить</button>
               </div>
            </form>
            <div class="text-center">
               <a href="{{ route('tests.edit', ['test' => $tests->id]) }}" class="btn main large-button">Редактировать</a>
               </div>
         </div>
      </div>
   </div>
</div>
<script>
   function calculateValue() {
   const checkboxes = document.querySelectorAll('input[type=checkbox]:checked');
   let totalValue = 0;
   checkboxes.forEach(function(checkbox) {
       const answerValue = parseInt(checkbox.value);
       if (!isNaN(answerValue)) {
           totalValue += answerValue;
       }
   });
   alert('Total value: ' + totalValue);
   }
</script>
@endsection