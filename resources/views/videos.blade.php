@extends('layouts.master')

@section('content')
    <div class="show-videos-content">
        @if(isset($warnings) && !is_null($warnings))
            <div class="main-content-title">
        @else
            <div class="main-content-title margin-top-30">
        @endif
            <h1>{{ $title }}</h1>
            @if(isset($tournament))  
                <div class="photos-information">
                    <div class="photos-title"> <b>{{ $tournament->date->format('d-m-Y') }}</b> &nbsp;&nbsp; {{ $tournament->title }} </div>
                    <div class="photos-place"> {{ $tournament->place }}</div>
                </div>
            @elseif(isset($event))
                <div class="photos-information">
                    <div class="photos-title"> <b>{{ $event->date->format('d-m-Y') }}</b> &nbsp;&nbsp; {{ $event->name }} </div>
                    <div class="photos-place"> {{ $event->place }}</div>
                </div>
            @elseif(isset($news))
                <div class="photos-information">
                    <div class="photos-title"> <b>{{ $news->date->format('d-m-Y') }}</b> &nbsp;&nbsp; {{ $news->title }} </div>
                </div>
            @endif
        </div>
        <div class="main-content-videos">
            <div class="videos-wrapper">
                @foreach($videos as $video)
                    <video class="video" controls>
                        <source src="{{ ($video->path_mp4) ? asset('storage' . $video->path_mp4) : null }}" type="video/mp4">
                        <source src="{{ ($video->path_webm) ? asset('storage' . $video->path_webm) : null }}" type="video/ogg">
                        Votre navigateur internet ne support pas les tags vidéos.
                    </video>
                @endforeach
            </div>
            <div class="bottom-div">
                <div class="pagination-middle">
                    {{ $videos->links() }}
                </div>
            </div>     
        </div>
    </div>
@endsection