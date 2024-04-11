@extends('layouts.master')

@section('keywords')
    <meta name="keywords" content="contact" />
@endsection

@section('content')
@if (Session::has('success'))
    <div id="overlay">
        <div id="overlay__text">
            {{ Session::get('success') }}
        </div>
    </div>
@endif


<div class="content__title">
    <h1 class="heading-1">Laissez votre message</h1>
</div>

<div class="contact">
    <div class="form__content">
        <form class="form__by-email" action="/contact" method="post">
            {{ csrf_field() }}
            <div class="form__messsage">
                <input type="hidden" name="subject" value="Contact">
                <select class="form__input-civility" name="civility" required>
                    <option value="">* Civilité</option>
                    <option value="Monsieur">Mr.</option>
                    <option value="Madame">Mme</option>
                    <option value="Mademoiselle">Mlle</option>
                </select>
                <input class="form__input" type="text" name="last_name" placeholder="* Nom" required>
                <input class="form__input" type="text" name="first_name" placeholder="* Prénom" required>
                <input class="form__input" type="email" name="email" placeholder="* E-mail" required>
                <input class="form__input form__input-tel" type="tel" class="inputtel" pattern="^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$" title="Veuillez respecter le format téléphonique Français" name="tel" placeholder="* Téléphone" required>
            </div>
            <div class="form__message form__message-right">
                <textarea name="message" class="form__textarea textarea-contact" rows="14" col="1000" placeholder="* Message..." required></textarea>
                <button class="form__button">ENVOYER</button>
            </div>

            <div class="form__email-bottom">
                <p class="smaller-text"><i>Conformément à la loi informatique et Libertés en date du 6 janvier 1978, vous disposez d'un droit d'accès, de rectification, de modification et de 
                    suppression des données qui vous concernent. Vous pouvez exercer ce droit en nous envoyant un courrier électronique ou postal.</i></p>
            </div>
            
        </form>

        <div class="form__by-tel">
            <p>
                <span class="form__special-p">Par téléphone</span> 
                @if (isset($contactTelephone)  && isset($contactTelephone->description) )
                    {!! $contactTelephone->description !!}
                @else
                    au: Didier JANOT (06.74.67.45.07), Patrick STUBBE (06.72.27.02.51), Blaise NGUYEN (06.62.58.18.72)
                @endif
            </p>
        </div>
        <div class="form__by-mail">
            <p class="form__paragraph"><span class="form__special-p">Par courrier</span> en écrivant à: </p>
            <div class="form__address">
                @if ( isset($courrierPostal)  && isset($courrierPostal->description) )
                    {!! $courrierPostal->description !!}
                @else
                    Didier JANOT <br>
                    10 Rue des Pervenches <br>
                    93460 Gournay sur Marne
                @endif
            </div>
        </div> 
    </div>
</div>
@endsection

@section('scripts')
    <script>
        function overlayNone(element) {
            element.style.display = "none";
        }

        var overlay =  document.getElementById('overlay');

        if (typeof(overlay) != 'undefined' && overlay != null)
        {
            setTimeout(overlayNone, 2100, overlay); 
        }
    </script>
@endsection