@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @foreach ($photosList as $foto)
           <div class="col-md-2 ">
               <img  style="max-width:100%; max-height:100%; margin:15px; " src="{{ $foto->getFotoUrl() }}" alt=""><br>
           </div>
        @endforeach
    </div>
</div>
@endsection
