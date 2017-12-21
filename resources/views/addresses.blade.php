@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="adresses utiles" />
@endsection

@section('content')
    @if(isset($warnings) && !is_null($warnings))
        <div class="main-content-title">
    @else
        <div class="main-content-title margin-top-30">
    @endif
        <h1>Adresses</h1>
    </div>
    <div class="main-content-address">
        <h2><u>Secrétariat administratif FFBSQ</u></h2>
        <p>Mme Claudie RUIZ chez Mme Claudette TRAINEAU</p>
        <p>
            <u>350 rue du Hasard</u> <br>
            <u>85440 Talmont Saint Hilaire</u>
        </p>
    </div>
@endsection