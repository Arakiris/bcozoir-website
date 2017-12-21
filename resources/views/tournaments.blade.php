@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="tournois" />
@endsection

@section('content')
    <div class="occasion-content">
        @if(isset($warnings) && !is_null($warnings))
            <div class="main-content-title">
        @else
            <div class="main-content-title margin-top-30">
        @endif
            <h1>{{ $title }}</h1>
        </div>
        @if(isset($tournaments) && $tournaments->count()>0)
            <div class="main-content-occasion">
                @if(!isset($futur))
                    <table class="occasion">
                @else
                    <table class="occasion occasion-futur">
                @endif
                
                    @foreach($tournaments as $tournament)
                        <tr class="occasion-row">
                            <td class="occasion-information tournament-information">
                                @if(isset($tournament->rules_url) || isset($tournament->rules_pdf))
                                    <a class="occasion-link" href="{{ $tournament->is_rules_pdf ? asset('storage' . $tournament->rules_pdf) : $tournament->rules_url }}" target="_blank">
                                        <h2><?php setlocale(LC_TIME, 'fr'); echo utf8_encode(strftime("%d-%B-%Y", $tournament->date->timestamp)); ?></h2>
                                        <p>{{ $tournament->title }}</p>
                                        <p>{{ $tournament->is_accredited ? 'Homologué' : 'Non homologué' }}</p>
                                        <p>{{ $tournament->place }}</p>
                                    </a>
                                @else
                                    <h2><?php setlocale(LC_TIME, 'fr'); echo utf8_encode(strftime("%d-%B-%Y", $tournament->date->timestamp)); ?></h2>
                                    <p>{{ $tournament->title }}</p>
                                    <p>{{ $tournament->is_accredited ? 'Homologué' : 'Non homologué' }}</p>
                                    <p>{{ $tournament->place }}</p>
                                @endif
                            </td>
                            @if(isset($tournament->members) && $tournament->members->count()>0)
                                <td class="occasion-member tournament-member">
                                    @foreach($tournament->members as $member)
                                        <div class="tooltip-occasion">
                                            <p class="{{ ($member->club_id != 1) ? 'otherClub' : '' }}">{{ $member->last_name }} {{ $member->first_name }}</p>
                                            <div class="tooltiptext-occasion {{ ($member->is_licensee == 'Licencié') ?  'licensee' : 'adherent' }}">
                                                <img class="float-left full-size-img" src="{{ ($member->picture->first()->path) ? asset('storage' . $member->picture->first()->path) : null }}" alt="Photo de {{ $member->last_name }} - {{ $member->first_name }}">
                                                <div class="tooltipcontent">
                                                    <p>{{ $member->last_name }} {{ $member->first_name }} - {{ $member->birth_date->diffInYears(Carbon\Carbon::now()) }} ans</p>
                                                    <p>{{ $member->club->name }}</p>
                                                    @if($member->is_licensee === "Licencié")
                                                        <p>Licence : {{ ($member->id_licensee) ? $member->id_licensee : '' }}</p>
                                                        <p>{{ $member->category->title }}</p>
                                                        <p>Moyenne : {{ $member->score ? $member->score->average : "Pas d'enregistrement"  }}</p>
                                                        <p>Handicap : {{ $member->handicap }}</p>
                                                        <p>Bonus : {{ $member->bonus }}</p>
                                                    @else
                                                        <p>{{ $member->is_licensee }}</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </td>
                            @endif

                            @if($title != 'Tournois futurs')
                                @if(isset($tournament->lexer_url))
                                    <td class="occasion-image">
                                        <a href="{{ $tournament->lexer_url }}" target="_blank"><img class="occasion-image-logo" src="{{ asset('images/tournament/Lexer.jpg') }}" alt="Lien lexer du résultat"></a>
                                    </td>
                                @endif

                                @if(isset($tournament->listing))
                                    <td class="occasion-image">
                                        <a href="{{ route('tournoiListing', $tournament->slug) }}"><img class="occasion-image-logo" src="{{ asset('images/tournament/Listing.jpg') }}" alt="Listing du tournoi {{ $tournament->title }}"></a>
                                    </td>
                                @endif

                                @if(isset($tournament->report))
                                    <td class="occasion-image">
                                        <a href="{{ route('tournoiResultat', $tournament->slug) }}"><img class="occasion-image-logo" src="{{ asset('images/tournament/Report.jpg') }}" alt="Image du résultat"></a>
                                    </td>
                                @endif

                                @if(isset($tournament->pictures) && $tournament->pictures->count()>0)
                                    <td class="occasion-image">
                                        <a href="{{ route('tournoiPhotos', $tournament->slug) }}"><img class="occasion-image-logo" src="{{ asset('images/tournament/Tournament-pictures.png') }}" alt="Image de présentation afin de montrer les photos du tournois"></a>
                                    </td>
                                @endif

                                @if(isset($tournament->videos) && $tournament->videos->count()>0)
                                    <td class="occasion-image">
                                        <a href="{{ route('tournoiVideos', $tournament->slug) }}"><img class="occasion-image-logo" src="{{ asset('images/tournament/Tournament-videos.jpg') }}" alt="Image de présentation afin de montrer les vidéos du tournois"></a>
                                    </td>
                                @endif
                            @endif
                        </tr>
                    @endforeach
                </table>

                @if($pagination)
                    <div class="bottom-div">
                        <div class="pagination-middle">
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
    </div>
@endsection