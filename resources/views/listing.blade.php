@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="listing" />
@endsection


@section('content')
<div class="content__title listing__main-heading main-content-title">
    <h1 class="heading-1">{{ $title }}</h1>
    <div class="listing__heading photos-information">
        <div class="listing__heading-title photos-title"> <b><?php setlocale(LC_TIME, 'fr'); echo utf8_encode(strftime("%d-%B-%Y", $tournament->date->timestamp)); ?></b> &nbsp;&nbsp; {{ $tournament->title }} </div>
        <div class="listing__heading-place photos-place"> {{ $tournament->place }}</div>
    </div>
</div>
<div class="listing">
    <div class="listing__wrapper main-content-listing">
        <img class="listing__img listing-img" src="{{ ($tournament->listing) ? asset('storage' . $tournament->listing) : null }}" alt="Image du listing du tournoi">
    </div>
</div>
@endsection