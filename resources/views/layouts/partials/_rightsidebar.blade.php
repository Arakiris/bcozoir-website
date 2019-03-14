<aside class="aside-right">
    <div class="nextTournament">
        <div class="nextTournamentTitle"><h2>PROCHAINS TOURNOIS (BC Ozoir)</h2></div>
        <div class="nextTournamentContent">
        @foreach($ozoirTounaments as $tournament)
            <div>
                <a href="{{ route('tournois.show', $tournament->slug) }}">
                    <h3>{{ $tournament->date->format('d/m/Y') }} - {{ ($tournament->is_accredited) ? 'Homologué' : 'Non homologué' }}</h3>
                    <p>{{ $tournament->title }} ({{ $tournament->place }})</p>
                </a>
            </div>
        @endforeach
        </div>
    </div>
    <div class="nextTournament">
        <div class="nextTournamentTitle"><h2>PROCHAINS AUTRES TOURNOIS (privés ou fédéraux)</h2></div>
        <div class="nextTournamentContent">
        @foreach($otherTournaments as $tournament)
            <div>
                <a href="{{ route('tournois.show', $tournament->slug) }}">
                    <h3>{{ $tournament->date->format('d/m/Y') }} - {{ ($tournament->is_accredited) ? 'Homologué' : 'Non homologué' }}</h3>
                    <p>{{ $tournament->title }} ({{ $tournament->place }})</p>
                </a>
            </div>
        @endforeach
        </div>
    </div>
    <div class="frameRandomPicture">
        <div class="frameRandomPictureTitle">Souvenirs...</div>
        <div class="pictures-carousel frameRandomPictureContent">
            <?php $i = 0; ?>
            @foreach($randompictures as $picture)
                <div>
                    <a href="{{ asset('storage' . $picture->path)  }}" data-lightbox="randomPic-{{ $i }}"><img data-lazy="{{ asset('storage' . $picture->path)  }}" alt="Photo au hasard" class="randomPicture"></a>
                    <div class="pictureText">
                        {!! $picture->title !!}
                    </div>
                </div>
                 <?php $i++; ?>
            @endforeach
        </div>

    </div>
</aside>