@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="presentation, bureau" />
@endsection

@section('content')
    <div class="office">
        @if (isset($content->path))
            <img class="office__picture" src="{{ (isset($content) && isset($content->path)) ? asset('storage' . $content->path) : 'images/office.jpg' }}" alt="Organigramme du bureau">
        @else
            <p>Il n'y a pas encore de photo de bureau</p>
        @endif
        
    </div>
@endsection