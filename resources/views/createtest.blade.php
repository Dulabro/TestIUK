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
         <form method="POST" action="{{ route('tests.store') }}">
            @csrf
            <div class="form-group">
               <label class="text-white" for="name">Введите название теста</label>
               <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
               <label class="text-white" for="lesson_id">Lesson ID</label>
               <select name="id_lessons" id="lesson_id" class="form-control">
                  @foreach ($lessons as $lesson)
                  <option value="{{ $lesson->id }}">{{ $lesson->name }}</option>
                  @endforeach
               </select>
            </div>
            <div id="questions-container">
               <div class="question-group">
                  <div class="form-group">
                     <label class="text-white" for="question_0">Вопрос 1</label>
                     <input type="text" name="questions[0][question]" id="question_0" class="form-control" required>
                  </div>
                  <div class="form-group">
                     <label class="text-white" for="answer_0_1">Ответ 1</label>
                     <input type="text" name="questions[0][answers][0][answer]" id="answer_0_1" class="form-control" required>
                     <input type="hidden" name="questions[0][answers][0][valid]" value="0">
                     <input type="checkbox" name="questions[0][answers][0][valid]" value="1" class="ml-2">
                     <label class="text-white" for="answer_0_1_valid">Правильный</label>
                  </div>
                  <div class="form-group">
                     <label class="text-white" for="answer_0_2">Ответ 2</label>
                     <input type="text" name="questions[0][answers][1][answer]" id="answer_0_2" class="form-control" required>
                     <input type="hidden" name="questions[0][answers][1][valid]" value="0">
                     <input type="checkbox" name="questions[0][answers][1][valid]" value="1" class="ml-2">
                     <label class="text-white" for="answer_0_2_valid">Правильный</label>
                  </div>
                  <div class="form-group">
                     <button type="button" class="btn btn-sm btn-danger remove-question-button">Удалить ответ</button>
                  </div>
               </div>
            </div>
            <div class="form-group">
               <button type="button" id="add-question-button" class="btn btn-sm btn-success">Добавить ответ</button>
            </div>
            <button type="submit" class="btn btn-primary">Создать тест</button>
         </form>
      </div>
   </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>
   $(document).ready(function() {
   
   var questionIndex = 0;
   
   // функция для добавления нового вопроса
   function addQuestion() {
   questionIndex++;
   
   var newQuestion = `
       <div class="question-group">
           <div class="form-group">
               <label class="text-white" for="question_${questionIndex}">Вопрос ${questionIndex + 1}</label>
               <input type="text" name="questions[${questionIndex}][question]" id="question_${questionIndex}" class="form-control" required>
           </div>
           <div class="form-group">
               <label class="text-white" for="answer_${questionIndex}_1">Ответ 1</label>
               <input type="text" name="questions[${questionIndex}][answers][0][answer]" id="answer_${questionIndex}_1" class="form-control" required>
               <input type="hidden" name="questions[${questionIndex}][answers][0][valid]" value="0">
               <input type="checkbox" name="questions[${questionIndex}][answers][0][valid]" value="1" class="ml-2">
               <label class="text-white" for="answer_${questionIndex}_1_valid">Правильный</label>
           </div>
           <div class="form-group">
               <label class="text-white" for="answer_${questionIndex}_2">Ответ 2</label>
               <input type="text" name="questions[${questionIndex}][answers][1][answer]" id="answer_${questionIndex}_2" class="form-control" required>
               <input type="hidden" name="questions[${questionIndex}][answers][1][valid]" value="0">
               <input type="checkbox" name="questions[${questionIndex}][answers][1][valid]" value="1" class="ml-2">
               <label class="text-white" for="answer_${questionIndex}_2_valid">Правильный</label>
           </div>
           <div class="form-group">
               <button type="button" class="btn btn-sm btn-danger remove-question-button">Удалить ответ</button>
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