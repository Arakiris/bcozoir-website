@extends('layouts.master')

@section('content')
    <div class="main-content-title">
        <h1>Membres</h1>
    </div>
    <div class="content-members">
        <?php $iterator =  0; ?>
        @foreach($members as $member)
                <div class="tooltip member-size">
                    <img class="member-thumbnail" src="{{ ($member->picture->first()->path) ? asset('storage' . $member->picture->first()->path) : null }}" alt="Photo de {{ $member->last_name }} - {{ $member->first_name }}">
                    <div class="tooltiptext member-information">
                        <p>
                            <img class="float-left full-size-img" src="{{ ($member->picture->first()->path) ? asset('storage' . $member->picture->first()->path) : null }}" alt="Photo de {{ $member->last_name }} - {{ $member->first_name }}">
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
                        </p>
                    </div>
                </div>
            <?php $iterator = ($iterator  + 1) % 6 ; ?>
        @endforeach
        @if($iterator !== 0 && $iterator < 6)
            @for($iterator ; $iterator  < 6; $iterator++)
                <div class="tooltip hidden"></div>
            @endfor
        @endif
    </div>
    <div class="page">
        {{ $members->links() }}
    </div>
@endsection