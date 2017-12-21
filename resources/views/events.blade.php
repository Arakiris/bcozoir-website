@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="evenements, fêtes" />
@endsection


@section('content')
    <div class="occasion-content">
        @if(isset($warnings) && !is_null($warnings))
            <div class="main-content-title">
        @else
            <div class="main-content-title margin-top-30">
        @endif
            <h1>Évènements</h1>
        </div>
        @if(isset($events) && $events->count()>0)
            <div class="main-content-occasion">
                <table class="occasion podium-width">
                    @foreach($events as $event)
                            <tr class="occasion-row">
                                <td class="occasion-information podium-information">
                                    <h2><?php setlocale(LC_TIME, 'fr'); echo strftime("%d-%B-%Y", $event->date->timestamp); ?></h2>
                                    <p>{{ $event->name }}</p>
                                    <p>{{ $event->place }}</p>
                                </td>

                                @if(isset($event->pictures) && $event->pictures->count()>0)
                                    <td class="occasion-image">
                                        <a href="{{ route('eventPhotos', $event->slug) }}"><img class="occasion-event-podium-logo" src="images/tournament/Tournament-pictures.png" alt="Image de présentation afin de montrer les photos de l'évènement"></a>
                                    </td>
                                @endif

                                @if(isset($event->videos) && $event->videos->count()>0)
                                    <td class="occasion-image">
                                        <a href="{{ route('eventVideos', $event->slug) }}"><img class="occasion-event-podium-logo" src="images/tournament/Tournament-videos.jpg" alt="Image de présentation afin de montrer les vidéos de l'évènement"></a>
                                    </td>
                                @endif
                            </tr>
                    @endforeach
                </table>
                <div class="bottom-div">
                    <div class="pagination-middle">
                        {{ $events->links() }}
                    </div>
                </div>
            </div>
        @else
            <div class="main-content-occasion">
                <p>Il n'y a pas encore de podium d'enregistrer cette saison.</p>
            </div>
        @endif
    </div>
@endsection