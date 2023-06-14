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
      <div class="lecture">
      <div class="form-group">
         <label class="text-white" for="name">Введите название лекции</label>
         <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $lecture->name) }}">
      </div>
    
      <div class="form-group">
         <label class="text-white" for="description">Введите краткое описание лекции</label>
         <textarea class="form-control" id="description" style="overflow: hidden" name="description">{{ old('description', $lecture->description) }}</textarea>
      </div>
   </div>

      <div class="form-group">
         <label class="text-white" for="text_lectures">Введите содержимое лекции</label>
         <input class="tinymce" id="editor" class="form-control" value="{{ old('text_lectures', $lecture->text_lectures) }}" placeholder="Введите содержимое лекции'" name="text_lectures"/>
         {{-- <textarea class="form-control" id="text_lectures" style="overflow: hidden" name="text_lectures">{{ old('text_lectures', $lecture->text_lectures) }}</textarea> --}}
      </div>
      <div class="text-center">
      <button type="submit" class="btn main large-button">Обновить лекцию</button>
      <a href="{{ url()->previous()->previous()  }}" class="btn main large-button">Назад</a>
   </div>
   </form>
</div>
<script>
   tinymce.init({
     selector: '#editor',
     plugins: 'powerpaste advcode code casechange searchreplace autolink directionality advcode visualblocks visualchars image link media mediaembed codesample table charmap pagebreak nonbreaking anchor tableofcontents insertdatetime advlist lists checklist wordcount tinymcespellchecker editimage help formatpainter permanentpen charmap linkchecker emoticons advtable export autosave',
     toolbar: 'code | undo redo formatpainter | visualblocks | alignleft aligncenter alignright alignjustify | blocks fontfamily fontsize | bold italic underline forecolor backcolor | lineheight | removeformat',
     height: '400px',
   });
</script>
<script>
$(document).ready(function() {
    // Configure/customize these variables.
    var showChar = 100;  // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Show more >";
    var lesstext = "Show less";
    

    $('.more').each(function() {
        var content = $(this).html();
 
        if(content.length > showChar) {
 
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);
 
            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
 
            $(this).html(html);
        }
 
    });
 
    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});
</script>
@endsection