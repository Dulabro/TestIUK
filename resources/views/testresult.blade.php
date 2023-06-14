@extends('layouts.app') @section('content')
<link href="{{ asset('css/home.css') }}" rel="stylesheet">
<style>
   table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  border: 1px solid #caf0f8;
  padding: 8px;
  text-align: left;
}

th {
  background-color: #184c99;
  font-weight: bold;
}

</style>
<div class="container">
   <div class="shape_hero">
      <svg width="747" height="765" viewBox="0 0 747 765" fill="none" xmlns="http://www.w3.org/2000/svg">
         <path d="M573.913 578.756L747 0H0V765L518.178 632.31C533.36 628.422 540.951 626.478 547.273 622.654C553.611 618.819 559.019 613.623 563.103 607.443C567.177 601.279 569.422 593.771 573.913 578.756Z" fill="#133466" />
      </svg>
   </div>
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="">
            <div class="card-header text-light" style="font-size:23px; text-align:center; height:4rem;">{{ __('Результат теста') }}</div>
            <div class="card-body">
               @if (session('status'))
               <div class="alert alert-success" role="alert">
                  {{ session('status') }}
               </div>
               @endif  
               <table style="color:white">
                  <tr>
                    <th>ID Теста</th>
                    <th>Участник</th>
                    <th>Количество правильных ответов</th>
                  </tr>
                  <tr>
                    <td><?php echo $test->name; ?></td>
                    <td><?php echo $user->name; ?></td>
                    <td><?php echo $testResult->total_value; ?></td>
                  </tr>
                </table>
                <div class="text-">
                <a href="{{ url('home') }}"class="btn main large-button">Главная</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection