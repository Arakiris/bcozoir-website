@extends('layouts.master')

@section('content')
    @if(isset($ads) && $ads->count() > 0)
        @if(isset($warnings) && !is_null($warnings))
            <div class="main-content-title">
        @else
            <div class="main-content-title margin-top-30">
        @endif
            <h1>Bienvenue sur le site Bowling Club Ozoir</h1>
        </div>
        <div class="ads-carousel">
            @foreach($ads as $ad)
                <div class="carousel-img">
                    <img data-lazy="{{ ($ad->picture->first()->path) ? asset('storage' . $ad->picture->first()->path) : null }}" alt="">
                </div> 
            @endforeach
        </div>
    @endif
@endsection