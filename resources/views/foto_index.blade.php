@extends('layouts.unify')


@section('content')
    <link rel="stylesheet" href="css/app.css">

        @foreach ($photosList->chunk(6) as $list)
            <div class="row margin-bottom-20">
                @foreach($list as $foto)
                    <div class="col-sm-2 sm-margin-bottom-20">
                          <a href="{{ $foto->getFotoUrl() }}" rel="gallery3" class="fancybox img-hover-v1" title="{{$foto->file_name}} [ {{$foto->exif_date_time}} ]">
                              <span><img class="img-responsive" src="{{ $foto->getThumb('300x200') }}" alt=""></span>
                         </a>
                    </div>
                @endforeach
            </div>
        @endforeach


@endsection
