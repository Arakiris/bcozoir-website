@extends('layouts.master')

@section('content')
<div class="content__title listing__main-heading">
    <h1 class="heading-1">{{ $title }}</h1>
    <div class="listing__heading">
        <div class="listing__heading-title"> <b><?php setlocale(LC_TIME, 'fr'); echo utf8_encode(strftime("%d-%B-%Y", $tournament->date->timestamp)); ?></b> &nbsp;&nbsp; {{ $tournament->title }} </div>
        <div class="listing__heading-place"> {{ $tournament->place }}</div>
    </div>
</div>
<div class="report">
    {!! ($tournament->report) ? $tournament->report : 'Les résultats n\'ont pas encore été enregistrés.' !!}
</div>
@endsection