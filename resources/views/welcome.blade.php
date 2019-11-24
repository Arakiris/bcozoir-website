@extends('layouts.master')

@section('content')
    @if(isset($ads) && $ads->count() > 0)
        <div class="content__title">
            <h1 class="heading-1">Bienvenue sur le site Bowling Club Ozoir</h1>
            <p class="content__paragraph">Poser la souris sur l'image pour arr&ecirc;ter le d&eacute;filement</p>
        </div>
        <div class="welcome-carousel">
            <?php $i = 0; ?>
            @foreach($ads as $ad)
                <div class="welcome-carousel__img">
                    <img src="{{ ($ad->picture->first()) ? asset('storage' . $ad->picture->first()->path) : null }}" alt="">
                    {{-- <a href="{{ ($ad->picture->first()) ? asset('storage' . $ad->picture->first()->path) : '#' }}" data-lightbox="welcome-{{ $i }}">
                        <img data-lazy="{{ ($ad->picture->first()) ? asset('storage' . $ad->picture->first()->path) : null }}" alt="Photo d'accueil">
                    </a> --}}
                </div>
                <?php $i++; ?> 
            @endforeach
        </div>
            
    @else
        <div class="content__title">
            <h1 class="heading-1">Bienvenue sur le site Bowling Club Ozoir</h1>
        </div>
    @endif
@endsection