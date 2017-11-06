@extends('layouts.master')

@section('content')
    <div class="main-content-title">
        <h1>{{ $title }}</h1>
        <div class="photos-information">
            <div class="photos-title"> <b>{{ $tournament->date->format('d-m-Y') }}</b> &nbsp;&nbsp; {{ $tournament->title }} </div>
            <div class="photos-place"> {{ $tournament->place }}</div>
        </div>
    </div>
    <div class="main-content-listing">
        <img class="listing-img" src="{{ ($tournament->listing) ? asset('storage' . $tournament->listing) : null }}" alt="Image du listing du tournoi">
    </div>
@endsection