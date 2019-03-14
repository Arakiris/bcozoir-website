@extends('layouts.master')

@section('content')
    @if(isset($warnings) && !is_null($warnings))
        <div class="main-content-title">
    @else
        <div class="main-content-title margin-top-30">
    @endif
        <h1>{{ $title }}</h1>
        <div class="photos-information">
            <div class="photos-title"> <b>{{ $tournament->date->format('d-m-Y') }}</b> &nbsp;&nbsp; {{ $tournament->title }} </div>
            <div class="photos-place">{{ $tournament->place }}</div>
        </div>
    </div>
    <div class="main-content-report">
        {!! ($tournament->report) ? $tournament->report : 'Les résultats n\'ont pas encore été enregistrés.' !!}
    </div>
@endsection