@extends('layouts.master')

@section('content')
    <div class="main-content-title">
        <h1>Évènements</h1>
    </div>
    @if(isset($events) && $events->count()>0)
        <div class="main-content-occasion">
            <div class="occasion podium-width">
                @foreach($events as $event)
                        <div class="occasion-row">
                            <div class="occasion-information podium-information">
                                <h2>{{ $event->date->format('Y-m-d') }}</h2>
                                <p>{{ $event->name }}</p>
                                <p>{{ $event->place }}</p>
                            </div>

                            @if(isset($event->pictures) && $event->pictures->count()>0)
                                <div class="occasion-image">
                                    <a href="{{ route('eventPhotos', $event->id) }}"><img src="images/tournament/Tournament-pictures.jpg" alt="Image de présentation afin de montrer les photos de l'évènement"></a>
                                </div>
                            @endif

                            @if(isset($event->videos) && $event->videos->count()>0)
                                <div class="occasion-image">
                                    <a href="{{ route('eventVideos', $event->id) }}"><img src="images/tournament/Tournament-videos.jpg" alt="Image de présentation afin de montrer les vidéos de l'évènement"></a>
                                </div>
                            @endif
                            <div class="clear"></div>
                        </div>
                @endforeach
                <div class="bottom-div">
                    <div>
                        {{ $events->links() }}
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="main-content-occasion">
            <p>Il n'y a pas encore de podium d'enregistrer cette saison.</p>
        </div>
    @endif
@endsection