@extends('layouts.app') @section('content')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
<script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
<div class="container">
   <div class="shape_hero">
      <svg width="747" height="765" viewBox="0 0 747 765" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path d="M573.913 578.756L747 0H0V765L518.178 632.31C533.36 628.422 540.951 626.478 547.273 622.654C553.611 618.819 559.019 613.623 563.103 607.443C567.177 601.279 569.422 593.771 573.913 578.756Z" fill="#133466" />
      </svg>
   </div>
   <div class="row justify-content-center">
      <div class="col-md-6">
         <div class="">
            <div class="card-header text-light" style="font-size:23px; text-align:center; height:4rem;">{{ __('Лист создания лекции') }}</div>
            <div class="card-body">
               <form action="/lectures" method="post" enctype="multipart/form-data">
                  @csrf
                  <div class="mb-3">
                     <label class="text-white" for="name" class="col-md-4 col-form-label text-md-end">{{ __('Введите название лекции') }}</label>
                     <div class="col-md-12">
                        <input type="text" placeholder="Введите название лекции" class="form-control" name="name" id="name">
                     </div>
                  </div>
                  <div class="mb-3">
                     <label class="text-white" for="name" class="col-md-4 col-form-label text-md-end">{{ __('Выберите курс') }}</label>
                     <div class="col-md-12">
                        <select name="courses" class="form-control">
                           @foreach ($allcourses as $courses)
                           <option value="{{ $courses->id }}">{{ $courses->name }}</option>
                           @endforeach
                        </select>
                     </div>
                  </div>
                  <div class="mb-3">
                     <label class="text-white" for="name" class="col-md-4 col-form-label text-md-end">{{ __('Введите краткое описание лекции') }}</label>
                     <div class="col-md-12">
                        <input type="text"  id="" name="description" placeholder="Введите краткое описание лекции" class="form-control"/>
                     </div>
                  </div>
                  <div class="mb-3">
                     <label class="text-white" for="name" class="col-md-4 col-form-label text-md-end">{{ __('Введите содержимое лекции') }}</label>
                     <div class="col-md-12">
                        <input class="tinymce" id="editor" class="form-control" placeholder="Введите содержимое лекции'" name="text_lectures"/>
                     </div>
                  </div>
               </div>
                  <div class="mb-3">
                     <label class="text-white" for="name" class="col-md-4 col-form-label text-md-end">{{ __('Добавьте документ') }}</label>
                     <div class="col-md-6">
                        <input type="file" name="file_document" id="file_document">
                     </div>
                  </div>
                  <div class="text-center">
                     <button class="btn main large-button" type="submit">Добавить лекцию</button>
                   </div>
               
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<script>
   tinymce.init({
     selector: '#editor',
     plugins: 'powerpaste advcode code casechange searchreplace autolink directionality advcode visualblocks visualchars image link media mediaembed codesample table charmap pagebreak nonbreaking anchor tableofcontents insertdatetime advlist lists checklist wordcount tinymcespellchecker editimage help formatpainter permanentpen charmap linkchecker emoticons advtable export autosave',
     toolbar: 'code | undo redo formatpainter | visualblocks | alignleft aligncenter alignright alignjustify | blocks fontfamily fontsize | bold italic underline forecolor backcolor | lineheight | removeformat',
     height: '400px',
   });
</script>
@endsection