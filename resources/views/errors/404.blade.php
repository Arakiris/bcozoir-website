@extends('layouts.master')

@section('styles')
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
@endsection

@section('content')
    <h1 class="error__title">404</h1>
    <div class="error__content">
        <p class="error__description">Oops, page non trouvée</p>
        <p class="error__reason">Vous avez peut-être mal tapé l'URL. S'il vous plaît vérifier votre orthographe</p>
    </div>
@endsection