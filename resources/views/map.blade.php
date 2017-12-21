@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="adresse" />
@endsection

@section('content')
    @if(isset($warnings) && !is_null($warnings))
        <div class="main-content-title">
    @else
        <div class="main-content-title margin-top-30">
    @endif
        <h1>Plan d'accès</h1>
    </div>
    <div class="main-content-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5260.081036037065!2d2.66492380952647!3d48.76202253881983!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xdc23b1c1c42edd36!2sCity+Bowling!5e0!3m2!1sfr!2sfr!4v1510526059282" width="800" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
@endsection