@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="archives, tournois, choix" />
@endsection

@section('content')
<div class="content__title main-content-title">
    <h1 class="heading-1">Archives tournois</h1>
</div>
<div class="tournament-choices">
    <div class="tournament-choices__content main-content-archives">
        <div class="tournament-choices__wrapper archive-choice-container">
            <a class="tournament-choices__button archive-button" href="{{ route('vieuxtournoisOzoir') }}"><span class="tournament-choices__button-text">Tournois d'Ozoir</span></a>
            <a class="tournament-choices__button archive-button" href="{{ route('vieuxtournoisPrives') }}"><span class="tournament-choices__button-text">Tournois Privés</span></a>
            <a class="tournament-choices__button archive-button" href="{{ route('vieuxchampionnats') }}"><span class="tournament-choices__button-text">Championnats fédéraux</span></a>
        </div>
    </div>
</div>
@endsection
