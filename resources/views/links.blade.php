@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="liens utiles" />
@endsection


@section('content')
<div class="content__title">
    <h1 class="heading-1">Liens utiles</h1>
</div>
<div class="partners">
    <div class="partners__wrapper">
        <div class="partners__content">
            @foreach($links as $link)
                <div class="partners__logo">
                    <img class="partners__logo-img" src="{{ ($link->picture->first()) ? asset('storage' . $link->picture->first()->path) : null }}" alt="Image du liens: {{ $link->title }}">
                </div>

                <div class="partners__informations">
                    <p class="partners__paragraph">
                        {!! $link->title !!} <br> <a href="{{ $link->link }}" target="_blank">{{ $link->link }}</a>
                    </p>
                </div>
            @endforeach
        </div>
    </div> 

    <div class="event__bottom bottom-tournament-league">
        <div class="paginations bottom-div">
            {{ $links->links() }}
        </div>
    </div>
</div>
@endsection