@component('mail::message')
# Hallo
Je hebt deze mail ontvangen omdat er een wachtwoord opnieuw instellen aanvraag is ingediend voor deze account.
@component('mail::button', ['url' =>  url('password/reset', $token)])
Verander wachtwoord
@endcomponent
Als je deze aanvraag niet hebt ingediend moet je niet verder gaan op deze mail.
<br>
<br>
Met vriendelijke groeten <br>
Het Trainingssessies team
@endcomponent

