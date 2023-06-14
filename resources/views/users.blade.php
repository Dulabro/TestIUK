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
    color: #fff;
}
   form {
   display: inline-block;
   }
   button[type="submit"] {
   padding: 6px 12px;
   background-color: #f44336;
   color: #fff;
   border: none;
   cursor: pointer;
   }
</style>
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
      <div class="col-md-8">
         <table>
            <thead>
               <tr>
                  <th>ФИО</th>
                  <th>Email</th>
                  <th>Действия</th>
               </tr>
            </thead>
            <tbody>
               @foreach ($users as $user)
               <tr>
                  <td class="text-light">{{ $user['name'] }}</td>
                  <td class="text-light">{{ $user['email'] }}</td>
                  <td>
                     {{--  --}}
                     <form action="{{ route('deleteUser', ['id' => $user['id']]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Удалить</button>
                    </form>
                  </td>
               </tr>
               @endforeach
            </tbody>
         </table>
      </div>
   </div>
</div>
@endsection