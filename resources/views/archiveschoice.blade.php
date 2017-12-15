@extends('layouts.master')

@section('content')
    @if(isset($warnings) && !is_null($warnings))
        <div class="main-content-title">
    @else
        <div class="main-content-title margin-top-50">
    @endif
        <h1>Archives tournoi</h1>
    </div>
    <div class="main-content-archives">
        <div class="archive-choice-container">
            <a class="archive-button" href="{{ route('vieuxtournoisOzoir') }}"><span>Tournois d'Ozoir</span></a>
            <a class="archive-button" href="{{ route('vieuxtournoisPrives') }}"><span>Tournois Privés</span></a>
            <a class="archive-button" href="{{ route('vieuxchampionnats') }}"><span>Championnats fédéraux</span></a>
        </div>
    </div>
@endsection
