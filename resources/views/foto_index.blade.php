@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="css/app.css">
    <div class="container">
    <div class="row">
        @foreach ($photosList as $foto)
           <div class="col-md-2 ">
               <a class='gallery' href='{{ $foto->getFotoUrl() }}'>
               <img style="max-width:100%; max-height:100%; margin:15px; " src="{{ $foto->getFotoUrl() }}" alt=""><br>
           </a></div>
        @endforeach
    </div>
</div>
@endsection
