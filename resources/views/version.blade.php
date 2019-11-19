@extends('layouts.master')

@section('content')
<div class="content__title">
    <h1 class="heading-1">Version 2.0.0</h1>
</div>
<div class="addresses">

    @if (isset($content->description))
        {!! $content->description !!}
    @else
        <p> Ce site est destiné à l'ensemble des joueurs du BC Ozoir. Il est également accessible aux autres joueurs pour consultation. </p>
        <p>Ses pages proposent diverses informations tels que les actualités, la liste des membres, les partenaires, la programmation des tournois et ligues, les résultats, les photos et vidéos des tournois et évènements organisés par le club, les liens utiles, l'archivage des tournois, etc... L'arrivée de ce site permet de donner vie au club d'Ozoir en offrant à ses membres toutes les informations pratiques dont ils ont besoin. En même temps, il représente un socle commun ayant pour but de réunir, avec convivialité, la famille des passionnés de cette discipline qu'est le BOWLING.</p>
        <p> Cette première version est amenée à une évolution future en tenant compte des relevés de bugs et des demandes d'améliorations de la part des utilisateurs.</p>
        <p>Bonne utilisation à tous. </p>
    @endif
        
</div>
@endsection