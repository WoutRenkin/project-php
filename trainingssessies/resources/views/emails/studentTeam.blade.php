@component('mail::message')
# Ingeschreven in team {{$teamName}}
Beste {{$receiver}}
<br>
<br>
{{$authUser}} heeft je ingeschreven in team {{$teamName}}!
<br>
Als je niet in dit team wil zitten kan je via de knop hieronder naar de teams pagina gaan en jezelf uitschrijven.
<br>
@component('mail::button', ['url' => 'http://trainingssessies.test/student/teams'])
Teams pagina
@endcomponent
Met vriendelijke groeten <br>
Het Trainingssessies team
@endcomponent

