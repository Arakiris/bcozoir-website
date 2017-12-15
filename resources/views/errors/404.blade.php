@extends('layouts.master')

@section('styles')
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
@endsection

@section('content')
    <h1 class="error-title">404</h1>
    <div class="error-content">
        <p class="error-description">Oops, page non trouvée</p>
        <p class="error-reason">Vous avez peut-être mal tapé l'URL. S'il vous plaît vérifier votre orthographe</p>
    </div>
@endsection