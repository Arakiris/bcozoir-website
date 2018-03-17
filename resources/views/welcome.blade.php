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
            <?php $i = 0; ?>
            @foreach($ads as $ad)
                <div class="carousel-img">
                    <!-- <img data-lazy="{{ ($ad->picture->first()) ? asset('storage' . $ad->picture->first()->path) : null }}" alt="Photo d'accueil"> -->
                    <a href="{{ ($ad->picture->first()) ? asset('storage' . $ad->picture->first()->path) : null }}" data-lightbox="welcome-{{ $i }}"><img data-lazy="{{ ($ad->picture->first()) ? asset('storage' . $ad->picture->first()->path) : null }}" alt="Photo d'accueil"></a>
                </div>
                <?php $i++; ?> 
            @endforeach
        </div>
            
    @else
        <div class="main-content-title margin-top-30">
            <h1>Bienvenue sur le site Bowling Club Ozoir</h1>
        </div>
    @endif
@endsection