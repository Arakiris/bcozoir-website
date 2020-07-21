<footer class="footer">
    <ul class="footer-nav">
        <li class="footer-nav__item"><a class="footer-nav__link" href="{{ route('version') }}">Version</a></li>
        <li class="footer-nav__item"><a class="footer-nav__link" href="{{ route('generalconditions') }}">Mentions légales</a></li>
        <li class="footer-nav__item"><a class="footer-nav__link" href="{{ route('proposal') }}">Suggestions</a></li>
        <li class="footer-nav__item">
            <a class="footer-nav__link" href="{{ route('map') }}">
                {{ isset($map) ? (isset($map->path) ? $map->path : 'Plan Extra-LaserBowl' ) : 'Plan Extra-LaserBowl' }}
            </a>
        </li>
    </ul>

    <p class="copyright">
        &copy; Copyright 2017-2020 BC Ozoir. Tous droits réservés.
    </p>
</footer>