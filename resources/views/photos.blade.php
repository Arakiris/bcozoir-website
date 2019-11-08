@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="photos, {{ $title }}" />
@endsection

@section('styles')
    <link type="text/css" rel="stylesheet" href="{{ asset('css/lightgallery.min.css') }}" /> 
@endsection

@section('content')
    <div class="content__title photos__main-heading">
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
    <div class="photos__wrapper">
        <div class="photos__content" id="lightgallery">
            @foreach($pictures as $picture)
                <a class="photos__link" href="{{ asset('storage' . $picture->path) }}">
                    <img class="photos__pictures lazy" src="https://via.placeholder.com/180x180?text=Chargement"
                    data-src="{{ (isset($picture->thumbnail) ? asset('storage' . $picture->thumbnail) : asset('storage' . $picture->path)) }}"
                    alt="Photos du tournoi">
                </a>
            @endforeach
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
    <script src="{{ asset('js/lightgallery.min.js') }}"></script>
    <script src="{{ asset('js/lg-autoplay.min.js') }}"></script>
    <script>
        $(function(){ 
            $('#lightgallery').lightGallery({
                autoplay: true,
                pause: 3000,
                progressBar: true
            }); 
        });
    </script>
@endsection