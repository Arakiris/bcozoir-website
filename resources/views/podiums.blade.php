@extends('layouts.master')

@section('content')
    <div class="main-content-title">
        <h1>Podiums</h1>
    </div>
    @if(isset($podiums) && $podiums->count()>0)
        <div class="main-content-occasion">
            <table class="occasion podium-width">
                @foreach($podiums as $podium)
                    @if(isset($podium->pictures) && $podium->pictures->count()>0)
                        <tr class="occasion-row">
                            <td class="occasion-information podium-information">
                                <h2>{{ $podium->tournament->date->format('Y-m-d') }}</h2>
                                <p>{{ $podium->tournament->title }}</p>
                                <p>{{ $podium->tournament->is_accredited ? 'Homologué' : 'Non homologué' }}</p>
                                <p>{{ $podium->tournament->place }}</p>
                            </td>

                            <td class="occasion-image">
                                <a href="{{ route('podiumPhotos', $podium->id) }}"><img src="images/tournament/Tournament-pictures.jpg" alt="Image de présentation afin de montrer les photos du podium"></a>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </table>
            <div class="bottom-div">
                <div class="bottom-podium">
                    {{ $podiums->links() }}
                </div>
            </div>
        </div>
    @else
        <div class="main-content-occasion">
            <p>Il n'y a pas encore de podium d'enregistrer cette saison.</p>
        </div>
    @endif
@endsection