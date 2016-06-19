@extends('layouts.unify')


@section('content')


    <div class="row">
        <div class="col-sm-12 text-center">
            {{ $photosList->links() }}
        </div>
    </div>
    <link rel="stylesheet" href="css/app.css">

        @foreach ($photosList->chunk(6) as $list)
            <div class="row margin-bottom-20">
                @foreach($list as $foto)
                    <div class="col-sm-2 sm-margin-bottom-10">
                          <a href="{{ $foto->getThumb('1200x1200') }}" rel="gallery3" class="fancybox img-hover-v1" title="{{$foto->file_name}} [ {{$foto->exif_date_time}} ]">
                              <span><img  class="img-responsive  rounded-2x" src="{{ $foto->getThumb('300x200') }}" alt=""></span>
                         </a>
                    </div>
                @endforeach
            </div>
        @endforeach

<div class="row">
    <div class="col-sm-12 text-center">
        {{ $photosList->links() }}
    </div>
</div>
@endsection
