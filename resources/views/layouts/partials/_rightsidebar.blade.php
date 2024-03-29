<aside class="aside-right">
    <div class="aside-right-tournament">
        <div class="aside-right-tournament__next nextTournament">
            <div class="aside-right-tournament__title nextTournamentTitle">
                <h2>
                    <img src="{{ (isset($title_list_tournament_1) && isset($title_list_tournament_1->path)) ? asset('storage' . $title_list_tournament_1->path) : asset('images/Tournois à venir ABC IDF (230x80 pixels).png') }}" alt="PROCHAINS TOURNOIS (ABC IDF)">
                </h2>
            </div>
            <div class="aside-right-tournament__content nextTournamentContent">
            @foreach($ozoirTounaments as $tournament)
                <div class="aside-right-tournament__content-single">
                    <a class="aside-right-tournament__content-link" href="{{ route('tournois.show', $tournament->slug) }}">
                        <h3 class="heading-3 aside-right-tournament__content-heading">{{ $tournament->date->format('d/m/Y') }} - {{ ($tournament->is_accredited) ? 'Homologué' : 'Non homologué' }}</h3>
                        <p class="aside-right-tournament__content-text">{{ $tournament->title }} ({{ $tournament->place }})</p>
                    </a>
                </div>
            @endforeach
            </div>
        </div>

        <div class="aside-right-tournament__next nextTournament">
            <div class="aside-right-tournament__title nextTournamentTitle">
                <h2>
                    <img src="{{ (isset($title_list_tournament_2) && isset($title_list_tournament_2->path)) ? asset('storage' . $title_list_tournament_2->path) : asset('images/Tournois à venir Privés ou Championnats fédéraux (230x80 pixels).png') }}" alt="PROCHAINS AUTRES TOURNOIS (privés ou fédéraux)">
                </h2>
            </div>
            <div class="aside-right-tournament__content nextTournamentContent">
            @foreach($otherTournaments as $tournament)
                <div class="aside-right-tournament__content-single">
                    <a class="aside-right-tournament__content-link" href="{{ route('tournois.show', $tournament->slug) }}">
                        <h3 class="heading-3 aside-right-tournament__content-heading">{{ $tournament->date->format('d/m/Y') }} - {{ ($tournament->is_accredited) ? 'Homologué' : 'Non homologué' }}</h3>
                        <p class="aside-right-tournament__content-text">{{ $tournament->title }} ({{ $tournament->place }})</p>
                    </a>
                </div>
            @endforeach
            </div>
        </div>
    </div>

    <div class="random-pic random-pic__left partnerFrame">
        <div class="random-pic__title partnerAdsTitle"> <a href="{{ route('becomePartner') }}" class="random-pic__title-link partner-link-become">Partenaires </a></div>
        <div class="random-pic__content partners-carousel">
            @foreach($partnerAds as $partner)
                <div class="random-pic__content-left">
                    <div class="random-pic__content-single">
                        @if (!empty($partner->url))
                            <a class="random-pic__link-single" href="{{ $partner->url }}" target="_blank">
                                <img data-lazy="{{ ($partner->picture->first()) ? asset('storage' . $partner->picture->first()->path) : asset('images/default_img.jpg') }}" alt="Photo au hasard" class="random-pic__photo-left partnerRandomPicture">
                            </a>
                        @else
                            <img data-lazy="{{ ($partner->picture->first()) ? asset('storage' . $partner->picture->first()->path) : asset('images/default_img.jpg')  }}" alt="Photo au hasard" class="random-pic__photo-left partnerRandomPicture">
                        @endif
                        <div class="random-pic__text-single partnerAdsText">
                            {!! $partner->title !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    
    <div class="random-pic random-pic__right frameRandomPicture">
        <div class="random-pic__title-right frameRandomPictureTitle">Souvenirs...</div>
        <div class="random-pic__content pictures-carousel frameRandomPictureContent">
            <?php $i = 0; ?>
            @foreach($randompictures as $picture)
                <div>
                    <a href="{{ asset('storage' . $picture->path)  }}" data-lightbox="randomPic-{{ $i }}">
                        <img data-lazy="{{ isset($picture->thumbnail) ? asset('storage' . $picture->thumbnail) : asset('storage' . $picture->path) }}" 
                        alt="Photo au hasard" 
                        class="random-pic__photo random-pic__photo-right">
                    </a>
                    <div class="random-pic__text-right pictureText">
                        {!! $picture->title !!}
                    </div>
                </div>
                 <?php $i++; ?>
            @endforeach
        </div>

    </div>
</aside>