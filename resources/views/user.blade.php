@extends('layouts.app') @section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>
            <div class="card-body">
               @if (session('status'))
               <div class="alert alert-success" role="alert">
                  {{ session('status') }}
               </div>
               @endif
               <span>{{Auth::user()->name}}</span>
               <br>
               <span>{{Auth::user()->email}}</span>
               <br>
               <span>{{Auth::user()->created_at}}</span>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection