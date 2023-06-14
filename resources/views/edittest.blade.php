@extends('layouts.app')

@section('content')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">

<div class="container">
   <div class="shape_hero">
      <svg width="747" height="765" viewBox="0 0 747 765" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path d="M573.913 578.756L747 0H0V765L518.178 632.31C533.36 628.422 540.951 626.478 547.273 622.654C553.611 618.819 559.019 613.623 563.103 607.443C567.177 601.279 569.422 593.771 573.913 578.756Z" fill="#133466" />
      </svg>
   </div>
   <div class="row justify-content-center">
      <div class="col-md-6">
         <div class="card-body">
            <div class="card-header text-light" style="font-size:23px; text-align:center; height:4rem;">{{ __('Лист редактирование теста') }}</div>
            <form method="POST" action="{{ route('tests.update', $test->id) }}">
               @csrf
               @method('PUT')
               <div class="form-group">
                  <label class="text-white" for="name">Введите название теста</label>
                  <input type="text" placeholder="Введите название теста" name="name" id="name" class="form-control" value="{{ $test->name }}" required>
               </div>
               <div class="form-group" style="margin-bottom: 70px;">
                  <label class="text-white" for="course_id">course ID</label>
                  <select name="id_course" id="course_id" class="form-control">
                     @foreach ($courses as $course)
                     <option value="{{ $course->id }}" {{ $course->id == $test->course_id ? 'selected' : '' }}>{{ $course->name }}</option>
                     @endforeach
                  </select>
               </div>
               <div id="questions-container">
                  @foreach ($test->questions as $index => $question)
                  <div class="question-group">
                     <div class="form-group">
                        <label class="text-white" for="question_{{ $index }}">Введите вопрос теста</label>
                        <input type="text" name="questions[{{ $index }}][question]" id="question_{{ $index }}" class="form-control" value="{{ $question->question }}" required>
                     </div>
                     @foreach ($question->answers as $answerIndex => $answer)
                     <div class="form-group">
                        <label class="text-white" style="margin-left: 10%;" for="answer_{{ $index }}_{{ $answerIndex }}">Введите ответ на вопрос теста</label>
                        <div class="block-test">
                           <input type="text" name="questions[{{ $index }}][answers][{{ $answerIndex }}][answer]" id="answer_{{ $index }}_{{ $answerIndex }}" class="form-control" value="{{ $answer->answer }}" required>
                           <input type="hidden" name="questions[{{ $index }}][answers][{{ $answerIndex }}][valid]" value="0">
                           <input type="checkbox" name="questions[{{ $index }}][answers][{{ $answerIndex }}][valid]" value="1" class="checkbox ml-2" {{ $answer->valid == 1 ? 'checked' : '' }}>
                           <label class="text-white" for="answer_{{ $index }}_{{ $answerIndex }}_valid"></label>
                        </div>
                     </div>
                     @endforeach
                     <div class="form-group">
                        <div class="text-center">
                           <button type="button" class="btn btn-sm btn-danger remove-question-button large-button">Удалить ответ</button>
                        </div>
                     </div>
                  </div>
                  @endforeach
               </div>
               <div class="text-center">
                  <div class="form-group">
                     <button type="button" id="add-question-button" class="btn main large-button">Добавить ответ</button>
                  </div>
                  <div class="form-group">
                     <button type="submit" class="btn main large-button">Сохранить тест</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
   $(document).ready(function() {
   
   var questionIndex = {{ count($test->questions) }};
   
   // функция для добавления нового вопроса
   function addQuestion() {
   questionIndex++;
   
   var newQuestion = `
       <div class="question-group">
           <div class="form-group">
               <label class="text-white" for="question_${questionIndex}">Введите вопрос теста ${questionIndex + 1}</label>
               <input type="text"  name="questions[${questionIndex}][question]" id="question_${questionIndex}" class="form-control" placeholder="Введите название теста" required>
           </div>
           <div class="form-group">
               <label class="text-white" style="margin-left: 10%;" for="answer_${questionIndex}_1">Введите ответ на вопрос теста</label>
               <div class="block-test">
               <input type="text" name="questions[${questionIndex}][answers][0][answer]" id="answer_${questionIndex}_1" class="form-control" required>
               <input type="hidden" name="questions[${questionIndex}][answers][0][valid]" value="0">
               <input type="checkbox" name="questions[${questionIndex}][answers][0][valid]" value="1" class="checkbox ml-2">
               <label class="text-white" for="answer_${questionIndex}_1_valid"></label>
            </div>
           </div>
           <div class="form-group">
               <label class="text-white" style="margin-left: 10%;" for="answer_${questionIndex}_2">Введите ответ на вопрос теста</label>
               <div class="block-test">
               <input type="text" name="questions[${questionIndex}][answers][1][answer]" id="answer_${questionIndex}_2" class="form-control" required>
               <input type="hidden" name="questions[${questionIndex}][answers][1][valid]" value="0">
               <input type="checkbox" name="questions[${questionIndex}][answers][1][valid]" value="1" class="checkbox ml-2">
               <label class="text-white" for="answer_${questionIndex}_2_valid"></label>
            </div>
           </div>
           <div class="form-group">
               <label class="text-white" style="margin-left: 10%;" for="answer_${questionIndex}_3">Введите ответ на вопрос теста</label>
               <div class="block-test">
               <input type="text" name="questions[${questionIndex}][answers][2][answer]" id="answer_${questionIndex}_3" class="form-control" required>
               <input type="hidden" name="questions[${questionIndex}][answers][2][valid]" value="0">
               <input type="checkbox" name="questions[${questionIndex}][answers][2][valid]" value="1" class="checkbox ml-2">
               <label class="text-white" for="answer_${questionIndex}_3_valid"></label>
            </div>
           </div>
           <div class="form-group">
               <div class="text-center">
                  <button type="button" class="btn btn-sm btn-danger remove-question-button large-button">Удалить ответ</button>
                </div>
            </div>
       </div>
   `;
   
   $('#questions-container').append(newQuestion);
   }
   
   // функция для удаления вопроса
   function removeQuestion() {
   $(this).closest('.question-group').remove();
   }
   
   // добавить новый вопрос при нажатии на кнопку "Добавить ответ"
   $('#add-question-button').click(function() {
   addQuestion();
   });
   
   // удалить вопрос при нажатии на кнопку "Удалить ответ"
   $(document).on('click', '.remove-question-button', removeQuestion);
   
   });
</script>
@endsection
