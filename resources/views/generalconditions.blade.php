@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="mentions légales" />
@endsection


@section('content')
<div class="content__title occasion-content">
    <h1 class="heading-1">Mentions légales</h1>
</div>
<div class="addresses">
    @if (isset($content->description))
        {!! $content->description !!}
    @else
        <div class="generalconditions-sections">
            <h2>&#9755; Confidentialité</h2>
            <p>Le club BC Ozoir n'enregistre pas d'informations personnelles permettant l'identification, 
            à l'exception des formulaires que l'utilisateur est libre de remplir. Ces informations ne seront pas utilisées sans votre accord, 
            nous les utiliserons seulement pour vous adresser des informations ou vous contacter.</p>
        </div>
        <div class="generalconditions-sections">
            <h2>&#9755; Cookies & statistiques</h2>
            <p>Ce site utilise Google Analytics, un service d'analyse de site internet fourni par Google Inc. (« Google »).</p>
            <p>Google Analytics utilise des cookies , qui sont des fichiers texte placés sur votre ordinateur, 
                pour aider le site internet à analyser l'utilisation du site par ses utilisateurs. Les données générées par les cookies concernant 
                votre utilisation du site (y compris votre adresse IP) seront transmises et stockées par Google sur des serveurs situés aux Etats-Unis. 
                Google utilisera cette information dans le but d'évaluer votre utilisation du site, de compiler des rapports sur l'activité du site à destination 
                de son éditeur et de fournir d'autres services relatifs à l'activité du site et à l'utilisation d'Internet. Google est susceptible de communiquer 
                ces données à des tiers en cas d'obligation légale ou lorsque ces tiers traitent ces données pour le compte de Google, y compris notamment l'éditeur 
                de ce site. Google ne recoupera pas votre adresse IP avec toute autre donnée détenue par Google. Vous pouvez désactiver l'utilisation de cookies en 
                sélectionnant les paramètres appropriés de votre navigateur. Cependant, une telle désactivation pourrait empêcher l'utilisation de certaines 
                fonctionnalités de ce site. En utilisant ce site internet, vous consentez expressément au traitement de vos données nominatives par Google dans
                les conditions et pour les finalités décrites ci-dessus.</p>
        </div>
        <div class="generalconditions-sections">
            <h2>&#9755; Confidentialité</h2>
            <p>L'ensemble des éléments que vous voyez, que vous écoutez ou que vous lisez sur le site ainsi que le site sont protégés par la législation relative aux droits d'auteur ou à l'image. 
            Ceux-ci, et notamment les marques, logos ou images… sont la propriété du club BC Ozoir ou font l'objet d'une autorisation d'utilisation au profit du club BC Ozoir.
            Vous ne pouvez en aucun cas utiliser, distribuer, copier, reproduire, modifier, dénaturer ou transmettre le site ou des éléments du site tels que textes, 
            images, sons ou marques et logos sans l'autorisation écrite et préalable du club BC Ozoir ou des titulaires des droits. Le non-respect de cette interdiction 
            peut constituer une contrefaçon des droits de propriété intellectuels ou une atteinte aux droits des personnes et peut à ce titre engager votre responsabilité, 
            y compris dans le cadre d'une action pénale.</p>
        </div>
        <div class="generalconditions-sections">
            <h2>&#9755; Liens hypertexte</h2>
            <p>Les liens hypertextes mis en place dans le cadre du présent site Web en direction d'autres sites présents sur le réseau Internet ne sauraient engager 
            la responsabilité du club BC Ozoir dans le cas où le contenu de ces sites contreviendrait aux dispositions légales et réglementaires en vigueur. 
            Les utilisateurs et visiteurs du site web ne peuvent mettre en place un hyperlien en direction de ce site Web sans l'autorisation express et préalable du 
            club BC Ozoir.</p>
        </div>
        <div class="generalconditions-sections">
            <h2>&#9755; Hébergement</h2>
            <h3>Greengeeks</h3>
            <p>
                5739 Kanan Rd Suite 300 <br>
                Agoura Hills, CA 91301, États-Unis
            </p>
        </div>
        <div class="generalconditions-sections">
            <h2>&#9755; Conception et réalisation</h2>
            <p>Mr. François VONGVILAY</p>
        </div>
    @endif

</div>

@endsection