@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="podiums" />
@endsection

@section('content')
    <div class="occasion-content">
        @if(isset($warnings) && !is_null($warnings))
            <div class="main-content-title">
        @else
            <div class="main-content-title margin-top-30">
        @endif
            <h1>Podiums</h1>
        </div>
        @if(isset($podiums) && $podiums->count()>0)
            <div class="main-content-occasion">
                <table class="occasion podium-width">
                    @foreach($podiums as $podium)
                        @if(isset($podium->pictures) && $podium->pictures->count()>0)
                            <tr class="occasion-row">
                                <td class="occasion-information podium-information">
                                    <h2><?php setlocale(LC_TIME, 'fr'); echo utf8_encode(strftime("%d-%B-%Y", $podium->tournament->date->timestamp)); ?></h2>
                                    <p>{{ $podium->tournament->title }}</p>
                                    <p>{{ $podium->tournament->is_accredited ? 'Homologué' : 'Non homologué' }}</p>
                                    <p>{{ $podium->tournament->place }}</p>
                                </td>

                                <td class="occasion-image">
                                    <a href="{{ route('podiumPhotos', $podium->slug) }}"><img class="occasion-event-podium-logo" src="images/tournament/Tournament-pictures.png" alt="Image de présentation afin de montrer les photos du podium"></a>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </table>
            </div>
            <div class="bottom-tournament-league">
                <div class="bottom-div">
                    <div class="pagination-middle">
                        {{ $podiums->links() }}
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