@extends('layouts.master')

@section('content')
    @if(isset($warnings) && !is_null($warnings))
        <div class="main-content-title">
    @else
        <div class="main-content-title margin-top-30">
    @endif
        <h1>Laissez vos suggestions</h1>
    </div>
    <div class="main-content-contact">
        <div>
            <form action="/contact" method="post">
                {{ csrf_field() }}
                <div class="message-contact information">
                    <input type="hidden" name="subject" value="Suggestion">
                    <select class="inputcivility" name="civility" required>
                        <option value="">* Civilité</option>
                        <option value="Monsieur">Mr.</option>
                        <option value="Madame">Mme</option>
                        <option value="Mademoiselle">Mlle</option>
                    </select>
                    <input type="text" name="last_name" placeholder="*Votre nom" required>
                    <input type="text" name="first_name" placeholder="*Votre prénom" required>
                    <input type="email" name="email" placeholder="*Votre e-mail" required>
                    <input type="tel" class="inputtel" pattern="^(?:(?:\+|00)33|0)\s*[1-9](?:[\s.-]*\d{2}){4}$" title="Veuillez respecter le format téléphonique Français" name="tel" placeholder="*Votre téléphone" required>
                </div>
                <div class="message-contact">
                    <textarea name="message" class="textarea-contact" rows="14" placeholder="*Votre message..." required></textarea>
                    <button class="envoyer right">ENVOYER</button>
                </div>
            </form>
            <div class="clear"></div>
            <p class="smaller-text"><i>Conformément à la loi informatique et Libertés en date du 6 janvier 1978, vous disposez d'un droit d'accès, de rectification, de modification et de suppression des données qui vous concernent. Vous pouvez exercer ce droit en nous envoyant un courrier électronique ou postal.</i></p>
        </div>
    </div>
@endsection