@extends('layouts.master')

@section('content')
    <div class="main-content-title">
        <h1>{{ $title }}</h1>
    </div>
    @if(isset($tournaments) && $tournaments->count()>0)
        <div class="main-content-occasion">
            <table class="occasion">
                @foreach($tournaments as $tournament)
                    <tr class="occasion-row">
                        <td class="occasion-information tournament-information">
                            <h2>{{ $tournament->date->format('Y-m-d') }}</h2>
                            <p>{{ $tournament->title }}</p>
                            <p>{{ $tournament->is_accredited ? 'Homologué' : 'Non homologué' }}</p>
                            <p>{{ $tournament->place }}</p>
                        </td>
                        @if(isset($tournament->members) && $tournament->members->count()>0)
                            <td class="occasion-member tournament-member">
                                @foreach($tournament->members as $member)
                                    <p class="{{ ($member->club_id != 1) ? 'otherClub' : '' }}">{{ $member->last_name }} - {{ $member->first_name }}</p>
                                @endforeach
                            </td>
                        @endif

                        @if(isset($tournament->rules_url) || isset($tournament->rules_pdf))
                            <td class="occasion-image">
                                <a href="{{ $tournament->is_rules_pdf ? asset('storage' . $tournament->rules_pdf) : $tournament->rules_url }}" target="_blank"><img src="{{ asset('images/tournament/Lexer.jpg') }}" alt="Image du lien"></a>
                            </td>
                        @endif

                        @if(isset($tournament->listing))
                            <td class="occasion-image">
                                <a href="{{ route('tournoiListing', $tournament->id) }}"><img src="{{ asset('images/tournament/Listing.jpg') }}" alt="Listing du tournoi {{ $tournament->title }}"></a>
                            </td>
                        @endif

                        @if(isset($tournament->report))
                            <td class="occasion-image">
                                <a href="{{ route('tournoiResultat', $tournament->id) }}"><img src="{{ asset('images/tournament/Report.jpg') }}" alt="Image du résultat"></a>
                            </td>
                        @endif

                        @if(isset($tournament->pictures) && $tournament->pictures->count()>0)
                            <td class="occasion-image">
                                <a href="{{ route('tournoiPhotos', $tournament->id) }}"><img src="{{ asset('images/tournament/Tournament-pictures.jpg') }}" alt="Image de présentation afin de montrer les photos du tournois"></a>
                            </td>
                        @endif

                        @if(isset($tournament->videos) && $tournament->videos->count()>0)
                            <td class="occasion-image">
                                <a href="{{ route('tournoiVideos', $tournament->id) }}"><img src="{{ asset('images/tournament/Tournament-videos.jpg') }}" alt="Image de présentation afin de montrer les vidéos du tournois"></a>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </table>

            @if($pagination)
                <div class="bottom-div">
                    <div>
                        {{ $tournaments->links() }}
                    </div>
                </div>
            @endif
        </div>
    @else
        <div class="main-content-occasion">
            <p>Il n'y a pas encore de tournoi d'enregistrer cette saison.</p>
        </div>
    @endif
@endsection