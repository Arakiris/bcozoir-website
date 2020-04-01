@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="podiums" />
@endsection

@section('content')
<div class="content__title">
    <h1 class="heading-1">PHOTOS PODIUMS</h1>
</div>
<div class="event event__podiums">
        @if(isset($podiums) && $podiums->count()>0)
            <div class="event__table event__table-podiums">
                @foreach($podiums as $podium)
                    @if(isset($podium->pictures) && $podium->pictures->count()>0)
                        <div class="event__single-information">
                            <h2 class="heading-2--event-title"><?php setlocale(LC_TIME, 'fr'); echo utf8_encode(strftime("%d-%B-%Y", $podium->tournament->date->timestamp)); ?></h2>
                            <p class="event__single-paragraphe">{{ $podium->tournament->title }}</p>
                            <p class="event__single-paragraphe">{{ $podium->tournament->is_accredited ? 'Homologué' : 'Non homologué' }}</p>
                            <p class="event__single-paragraphe">{{ $podium->tournament->place }}</p>
                        </div>

                        <div class="event__single-image">
                            <a class="event__single-link" href="{{ route('podiumPhotos', $podium->slug) }}">
                                <img class="event__single-logo occasion-event-podium-logo" src="{{ asset('images/tournament/tournament-pictures.png') }}" alt="Image de présentation afin de montrer les photos du podium">
                            </a>
                        </div>
                    @endif
                @endforeach 
            </div>
            <div class="event__bottom bottom-tournament-league">
                <div class="paginations bottom-div">
                    {{ $podiums->links() }}
                </div>
            </div>
        @else
            <div class="main-content-occasion">
                <p>Il n'y a pas encore de podium d'enregistrer cette saison.</p>
            </div>
        @endif
    </div>
@endsection