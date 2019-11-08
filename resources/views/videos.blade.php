@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="videos" />
@endsection

@section('content')
    <div class="content__title">
    {{-- <div class="show-videos-content"> --}}
        <h1 class="heading-1">{{ $title }}</h1>
        @if(isset($tournament))   
            <div class="photos__heading">
                <div class="photos__heading-title"> <b><?php setlocale(LC_TIME, 'fr'); echo utf8_encode(strftime("%d-%B-%Y", $tournament->date->timestamp)); ?></b> &nbsp;&nbsp; {{ $tournament->title }} </div>
                <div class="photos__heading-place"> {{ $tournament->place }}</div>
            </div>
        @elseif(isset($event))
            <div class="photos__heading">
                <div class="photos__heading-title"> <b>{{ $event->date->format('d-m-Y') }}</b> &nbsp;&nbsp; {{ $event->name }} </div>
                <div class="photos__heading-place"> {{ $event->place }}</div>
            </div>
        @elseif(isset($news))
            <div class="photos__heading">
                <div class="photos__heading-title"> <b>{{ $news->date->format('d-m-Y') }}</b> &nbsp;&nbsp; {{ $news->title }} </div>
            </div>
        @endif
    </div>
    <div class="videos__wrapper">
        <div class="videos__content {{ $videos->count() > 1 ? '' : 'videos__content-solo' }}">
        {{-- <div class="videos-wrapper"> --}}
            @foreach($videos as $video)
                <video preload="none" class="videos__video" controls>
                    <source src="{{ ($video->path_mp4) ? asset('storage' . $video->path_mp4) : null }}" type="video/mp4">
                    <source src="{{ ($video->path_webm) ? asset('storage' . $video->path_webm) : null }}" type="video/ogg">
                    Votre navigateur internet ne support pas les tags vidéos.
                </video>
            @endforeach
        </div>
    </div>
@endsection