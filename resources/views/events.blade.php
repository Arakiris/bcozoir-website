@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="evenements, fêtes" />
@endsection


@section('content')
<div class="content__title">
    <h1 class="heading-1">Évènements</h1>
</div>
<div class="event event__occasion">
    @if(isset($events) && $events->count()>0)
        <div class="event__table event__table-occasion">
            @foreach($events as $event)
                <div class="event__single-information">
                    <h2 class="heading-2--event-title"><?php setlocale(LC_TIME, 'fr'); echo utf8_encode(strftime("%d-%B-%Y", $event->date->timestamp)); ?></h2>
                    <p class="event__single-paragraphe">{{ $event->name }}</p>
                    <p class="event__single-paragraphe">{{ $event->place }}</p>
                </div>

                @if(isset($event->pictures) && $event->pictures->count()>0)
                    <div class="event__single-image">
                        <a class="event__single-link" href="{{ route('eventPhotos', $event->slug) }}">
                            <img class="event__single-logo" src="{{ asset('images/tournament/tournament-pictures.png') }}" alt="Image de présentation afin de montrer les photos de l'évènement">
                        </a>
                    </div>
                @else
                    <div class="event__single-image--disable">
                        <div class="event__cell--disable">
                            <img class="event__single-logo occasion-image-logo" src="{{ asset('images/tournament/tournament-pictures.png') }}" alt="Image de présentation afin de montrer les photos de l'évènement">
                        </div>
                    </div>
                @endif

                @if(isset($event->videos) && $event->videos->count()>0)
                    <div class="event__single-image">
                        <a class="event__single-link" href="{{ route('eventVideos', $event->slug) }}">
                            <img class="event__single-logo occasion-image-logo" src="{{ asset('images/tournament/Tournament-videos.jpg') }}" alt="Image de présentation afin de montrer les vidéos de l'évènement">
                        </a>
                    </div>
                @else
                    <div class="event__single-image--disable">
                        <div class="event__cell--disable">
                            <img class="event__single-logo occasion-image-logo" src="{{ asset('images/tournament/Tournament-videos.jpg') }}" alt="Image de présentation afin de montrer les vidéos de l'évènement">
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="event__bottom bottom-tournament-league">
            <div class="paginations bottom-div">
                {{ $events->links() }}
            </div>
        </div>
    @else
        <div class="main-content-occasion">
            <p>Il n'y a pas encore d'évènements d'enregistrer cette saison.</p>
        </div>
    @endif
</div>
@endsection