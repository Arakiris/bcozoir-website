<header class="header">
    <div class="logo">
        <a href="{{ route('welcome') }}">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo de bienvenue du site de bowling d'Ozoir" class="logo-img" >
        </a>
    </div>
    <div class="header-img">

    </div>
</header>

<nav class="header-nav">
    <div class="updatedAt">
        <span>{{ (isset($stat->last_update)) ? 'Maj. le ' . $stat->last_update->format('d/m/Y') : 'Pas encore de MAJ' }}</span>
    </div>
    <ul class="nagivation">
        <li><a href="{{ route('welcome') }}">Accueil</a></li>
        <li><a href="{{ route('bcozoir') }}">BC Ozoir</a></li>
        <li><a href="{{ route('office') }}">Bureau</a></li>
        <li><a href="{{ route('members') }}">Membres</a></li>
        <li><a href="{{ route('partners') }}">Partenaires</a></li>
        <li><a href="{{ route('links') }}">Liens</a></li>
        <li><a href="{{ route('adresses') }}">Adresses</a></li>
        <li><a href="{{ route('contact') }}">Contact</a></li>
    </ul>
</nav>