<header class="header">
    <div class="header__logo">
        <a href="{{ route('welcome') }}">
            <img src="{{ (isset($logo) && isset($logo->path)) ? asset('storage' . $logo->path) : asset('images/logo2.jpg') }}" 
                alt="Logo de bienvenue du site de bowling d'Ozoir" class="header__logo-img" >
        </a>
    </div>
    <div class="header__img" id="header__img--personalized">
        <p class="header__img-date" data-text="<?php setlocale(LC_TIME, 'fr'); echo ucfirst(utf8_encode(strftime("%A %d %B %Y", \Carbon\Carbon::now()->timestamp))); ?>">
            <?php setlocale(LC_TIME, 'fr'); echo ucfirst(utf8_encode(strftime("%A %d %B %Y", \Carbon\Carbon::now()->timestamp))); ?>
        </p>
    </div>

    <div class="header__updatedat">
        <span>{{ (isset($stat->last_update)) ? 'Maj. le ' . $stat->last_update->format('d/m/Y') : 'Pas encore de MAJ' }}</span>
    </div>
    <nav class="header-nav">
        <ul class="header-nav__list">
            <li class="header-nav__item"><a class="header-nav__link" href="{{ route('welcome') }}">Accueil</a></li>
            <li class="header-nav__item"><a class="header-nav__link" href="{{ route('bcozoir') }}">BC Ozoir</a></li>
            <li class="header-nav__item"><a class="header-nav__link" href="{{ route('office') }}">Bureau</a></li>
            <li class="header-nav__item"><a class="header-nav__link" href="{{ route('members') }}">Membres</a></li>
            <li class="header-nav__item"><a class="header-nav__link" href="{{ route('partners') }}">Partenaires</a></li>
            <li class="header-nav__item"><a class="header-nav__link" href="{{ route('links') }}">Liens</a></li>
            <li class="header-nav__item"><a class="header-nav__link" href="{{ route('adresses') }}">Adresses</a></li>
            <li class="header-nav__item"><a class="header-nav__link" href="{{ route('contact') }}">Contact</a></li>
        </ul>
    </nav>
</header> 