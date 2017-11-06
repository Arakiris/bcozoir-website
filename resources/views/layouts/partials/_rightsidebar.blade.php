<aside class="aside-right">
    <div class="nextTournament">
        <div class="nextTournamentTitle"><h2>Prochain tournois BC Ozoir</h2></div>
        @foreach($ozoirTounaments as $tournament)
            <div class="nextTournamentContent">
                <h3>{{ date('d/m/Y', strtotime($tournament->start_season)) }} - {{ ($tournament->is_accredited) ? 'Homologué' : 'Non homologué' }}</h3>
                <p>{{ $tournament->title }} ({{ $tournament->place }})</p>
            </div>
        @endforeach
    </div>
    <div class="nextTournament">
        <div class="nextTournamentTitle"><h2>Prochain autres tournois</h2></div>
        @foreach($otherTournaments as $tournament)
            <div class="nextTournamentContent">
                <h3>{{ date('d/m/Y', strtotime($tournament->start_season)) }} - {{ ($tournament->is_accredited) ? 'Homologué' : 'Non homologué' }}</h3>
                <p>{{ $tournament->title }} ({{ $tournament->place }})</p>
            </div>
        @endforeach
    </div>
    <div class="frameRandomPicture">
        <div class="frameRandomPictureTitle">Photos</div>
        <div class="pictures-carousel frameRandomPictureContent">
            @foreach($randompictures as $picture)
                <div>
                    <img src="{{ asset('storage' . $picture->path)  }}" alt="Photo au hasard" class="randomPicture">
                    <div class="pictureText">
                        {!! $picture->title !!}
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</aside>