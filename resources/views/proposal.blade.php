@extends('layouts.master')

@section('content')
<div class="content__title">
    <h1 class="heading-1">Laissez vos suggestions</h1>
</div>

<div class="contact">
    <div class="form__content">
        <form class="form__by-email" action="/contact" method="post">
            {{ csrf_field() }}
            <p class="form__email-top contact__paragraph">
                <span class="form__special-p contact-special">Par e-mail</span> en remplissant le formulaire ci-dessous, nous vous répondrons le plus tôt possible :
            </p>

            <div class="form__messsage">
                <input type="hidden" name="subject" value="Contact">
                <select class="form__input-civility inputcivility" name="civility" required>
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
            <div class="form__message form__message-right message-contact">
                <textarea name="message" class="form__textarea textarea-contact" rows="14" col="1000" placeholder="* Message..." required></textarea>
                <button class="form__button envoyer right">ENVOYER</button>
            </div>

            <div class="form__email-bottom">
                <p class="smaller-text"><i>Conformément à la loi informatique et Libertés en date du 6 janvier 1978, vous disposez d'un droit d'accès, de rectification, de modification et de 
                    suppression des données qui vous concernent. Vous pouvez exercer ce droit en nous envoyant un courrier électronique ou postal.</i></p>
            </div>
        </form>
    </div>
</div>
@endsection