@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="adherent, adherents, membre, membres" />
@endsection

@section('content')
<div class="content__title main-content-title">
    <h1 class="heading-1">Membres (Fiche / Palmarès / Futurs tournois)</h1>
    <p class="content__paragraph">ROUGE : Licenci&eacute;s  /  BLEU : Adh&eacute;rents</p>
    <p class="content__paragraph">Cliquer sur la photo pour consulter son palmarès et ses futurs tournois programmés</p>
</div>
<div class="members">
    <div class="members__content content-members">
        @foreach($members as $member)
            <div class="members__tooltip tooltip {{ $member->is_licensee === 'Licencié' ? 'members__tooltip-l' : 'members__tooltip-a' }}">
                <a href="{{route('membersPrize', $member->id)}}">
                    <img class="members__thumbnail lazy" 
                    src="https://via.placeholder.com/120x144?text=Chargement"
                    data-src="{{ ($member->picture->first()) ? (isset($member->picture->first()->thumbnail) ? asset('storage' . $member->picture->first()->thumbnail) : asset('storage' . $member->picture->first()->path)) : null }}" 
                    alt="Photo de {{ $member->last_name }} - {{ $member->first_name }}">
                </a>
                
                @if($member->is_licensee === "Licencié")
                    <p class="members__name members__licensee">{{ $member->last_name . ' ' . $member->first_name }}</p>
                    <div class="members__tooltip-wrapper members__tooltip-licensee">
                @else
                    <p class="members__name members__adherent">{{ $member->last_name . ' ' . $member->first_name }}</p>
                    <div class="members__tooltip-wrapper members__tooltip-adherent">
                @endif
                    <img class="members__tooltip-img lazy" 
                    src="https://via.placeholder.com/180x210?text=Chargement"
                    data-src="{{ ($member->picture->first()) ? (isset($member->picture->first()->medium_size) ? asset('storage' . $member->picture->first()->medium_size) : asset('storage' . $member->picture->first()->path)) : null }}" 
                    alt="Photo de {{ $member->last_name }} - {{ $member->first_name }}">
                    <div class="members__tooltip-content">
                        @if((isset($member->birth_date) && !empty($member->birth_date)) && $member->birth_date->diffInYears(Carbon\Carbon::now()) < 100)
                            <p class="members__tooltiptext">{{ $member->last_name }} {{ $member->first_name }} - {{ $member->birth_date->diffInYears(Carbon\Carbon::now()) }} ans</p>
                        @else
                            <p class="members__tooltiptext">{{ $member->last_name }} {{ $member->first_name }}</p>
                        @endif
                        <p class="members__tooltiptext">{{ $member->club->name }}</p>
                        @if($member->is_licensee === "Licencié")
                            <p class="members__tooltiptext">Licence : {{ ($member->id_licensee) ? $member->id_licensee : '' }}</p>
                            <p class="members__tooltiptext">{{ $member->category->title }}</p>
                            <p class="members__tooltiptext">Moyenne : {{ $member->score ? intval($member->score->average) : "Pas d'enregistrement"  }}</p>
                            <p class="members__tooltiptext">Handicap : {{ $member->handicap }}</p>
                            <p class="members__tooltiptext">Bonus vétéran : {{ $member->bonus }}</p>
                        @else
                            <p class="members__tooltiptext">{{ $member->is_licensee }}</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection