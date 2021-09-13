@extends('layouts.template')

@section('main')
    <div id="wrapper" class="mt-4 helpmenu">
        <div id="page" class="container">
            <h1>Hulp menu voor administrators</h1>
            <h3 id="intro">Wat is het hulp menu?</h3>
            <p>In dit hulp menu wordt er een korte (en hopelijk duidelijke) uitleg gegeven over alle functionaliteiten
                van de applicatie.</p>
            <p>Dit menu bevat de volgende onderdelen:</p>
            <ul>
                <li><a href="#users">Gebruikers beheren</a></li>
                <li><a href="#teams">Teams beheren</a></li>
                <li><a href="#organisations">Organisaties beheren</a></li>
                <li><a href="#sessions">Sessies beheren</a></li>
                <li><a href="#suggestions">Voorstellen beheren</a></li>
                <li><a href="#academy_year">Academiejaar beheren</a></li>
                <li><a href="#docents">Hoe creëer ik een link voor docenten?</a></li>
                <li><a href="#status">Welke status kan een sessie hebben?</a></li>
                <li><a href="#tutorial">Kan ik ergens een tutorial vinden?</a></li>
            </ul>

            <div class="card shadow help">
                <div class="card-body">
                    <h3 id="users" class="card-title"><b>Gebruikers beheren</b></h3>
                    <p>U kan het menu voor gebruikers te beheren vinden op de hoofdpagina. Selecteer er vanboven in de
                        balk "Gebruikers"</p>
                    <h4>De lijst met gebruikers</h4>
                    <p>U kan van elke gebruiker het volgende bekijken: </p>
                    <ul>
                        <li>Voornaam</li>
                        <li>Achternaam</li>
                        <li>R-nummer</li>
                        <li>E-mailadres</li>
                        <li>Rol (administrator of student)</li>
                    </ul>
                    <h4>U heeft ook de keuze filters te gebruiken over de tabel.</h4>
                    <p><b>Naam: </b> Dit gaat filteren op voornaam, achternaam en r-nummer<br>
                        <b>Team: </b>U kan hier kiezen of u studenten met of zonder team wilt. <span
                            class="text-danger">PAS OP! De lijst gaat enkel studenten bevatten!</span><br>
                        <b>Gebruikersrol: </b> Hier kan u kiezen tussen administrator of student.</p>
                    <h4>Gebruikers toevoegen</h4>
                    <p>
                        Als u rechts onderaan de tabel op toevoegen klikt, komt u op de pagina waar u een gebruiker kan
                        toevoegen.<br>
                        U kan dan kiezen om 1 gebruiker toe te voegen of meerdere via een excel bestand.</p>
                    <h5>Een enkele gebruiker toevoegen</h5>
                    <p>U kan hier een formulier invullen om een nieuwe gebruiker toe te voegen.<br>
                        U kan in dit formulier kiezen of de aangemaakte gebruiker een student of een administrator
                        is.<br>
                        Indien deze een student is zal deze ook meteen toegevoegd worden aan het huidige academiejaar.
                    </p>
                    <h5>Meerdere gebruikers toevoegen</h5>
                    <p>U heeft een excel bestand nodig met de volgende tabellen:</p>
                    <ul>
                        <li>Voornaam</li>
                        <li>Achternaam</li>
                        <li>R-nummer</li>
                        <li>E-mailadres</li>
                        <li>telefoonnummer</li>
                    </ul>
                    <p>Het systeem maakt studenten aan en voegt ze eveneens ook toe aan het huidige academiejaar. Via
                        deze optie kan u geen administrators aanmaken.<br>
                        Studenten krijgen "secret" als wachtwoord toegewezen en zullen dit moeten aanpassen via de
                        "wachtwoord vergeten" link bij het aanmelden of via hun profiel.</p>

                    <h5>Gebruikers bewerken</h5>
                    <p>In de lijst van alle gebruikers kan u klikken u op wijzigen<br>
                        U krijgt dan min of meer hetzelfde formulier als bij "gebruiker toevoegen".<br>
                        U kan hier dan ook een student deactiveren. De student wordt op inactief gezet voor dit
                        academiejaar en wordt dan ook uit zijn huidige team verwijdert.</p>
                </div>
            </div>

            <div class="card shadow help">
                <div class="card-body">
                    <h3 id="teams" class="card-title"><b>Teams beheren</b></h3>
                    <p>U kan het menu voor teams te beheren vinden op de hoofdpagina. Selecteer er vanboven in de balk
                        "Overzicht"</p>
                    <h4>De lijst met teams gebruiken</h4>
                    <h5>U kan van elk team het volgende bekijken: </h5>
                    <ul>
                        <li>Team nummer</li>
                        <li>De studenten die in het team zitten</li>
                        <li>Het aantal studenten in het team</li>
                        <li>Het onderwerp van de sessie die het team volgt (of aangevraagd heeft)</li>
                        <li>De <a href="#status">status</a> van hun sessie</li>
                    </ul>
                </div>
            </div>
            <div class="card shadow help">
                <div class="card-body">
                    <h3 id="organisations" class="card-title"><b>Organisaties beheren</b></h3>
                    <p>U kan het menu voor gebruikers te beheren vinden op de hoofdpagina. Selecteer er vanboven in de
                        balk "gebruikers"</p>
                    <h5>U kan van elke organisatie het volgende bekijken: </h5>
                    <ul>
                        <li>Naam van de organisatie</li>
                        <li>De contactpersoon</li>
                        <li>Het e-mailadres</li>
                    </ul>
                    <p>U kan ze filteren op naam en op actief of niet actief.</p>
                    <h5>Een organisatie toevoegen </h5>
                    <p>Als u op toevoegen klikt krijgt u een formulier waar u de gegevens van de organisatie kan
                        invullen.</p>
                    <h5>Een organisatie wijzigen</h5>
                    <p>Als u op wijzigen klikt krijgt u een formulier waar u de gegevens van de organisatie kan
                        wijzigen.</p>
                </div>
            </div>

            <div class="card shadow help">
                <div class="card-body">
                    <h3 id="sessions" class="card-title"><b>Sessies beheren</b></h3>
                    <p>U kan het menu voor sessies te beheren vinden op de hoofdpagina. Selecteer er vanboven in de balk
                        "Sessies".</p>
                    <h5>De lijst met sessies</h5>
                    <p>Hier vindt u een lijst van alle sessies die de administrators toegevoegd hebben die de <a
                            href="#status">status</a> "beschikbaar" hebben.</p>
                    <h5>Een sessie toevoegen</h5>
                    <p>Om een sessie toe te voegen klikt u op de "toevoegen" knop.<br>
                        Hierna krijgt u een formulier waar u een <b>organisatie</b> kan selecteren, een <b>onderwerp</b>
                        ingeven en het <b>bestand</b> dat u van de organisatie gekregen hebt uploaden.</p>
                    <h5>Een sessie wijzigen</h5>
                    <p>Om een sessie toe te voegen klikt u op de "wijzigen" knop naast de sessie die u wilt
                        wijzigen.<br>
                        Hier kan u wijzigen naar wil. U kan ook het vorige bestand downloaden en eventueel wijzigen.</p>
                </div>
            </div>

            <div class="card shadow help">
                <div class="card-body">
                    <h3 id="suggestions" class="card-title"><b>Voorstellen beheren</b></h3>
                    <p>U kan het menu om voorstellen te beheren vinden op de hoofdpagina. Selecteer er vanboven in de
                        balk "Voorstellen".</p>
                    <h5>De lijst met voorstellen</h5>
                    <p>Hier kan u alle voorstellen bekijken.</p>
                    <h5>Feedback op voorstel geven</h5>
                    <p>Hier kan u voorstellen goed- of afkeuren en er feedback op geven. Als u deze afkeurt kan de student deze opnieuw bewerken tot u het voorstel goedkeurd.</p>
                </div>
            </div>

            <div class="card shadow help">
                <div class="card-body">
                    <h3 id="academy_year" class="card-title"><b>Academiejaar beheren</b></h3>
                    <p>U kan het menu voor de academiejaren te beheren vinden op de hoofdpagina. Selecteer er vanboven
                        in de balk "Academiejaar"</p>
                    <h5>Een academiejaar toevoegen</h5>
                    <p>Om een academiejaar toe te voegen klikt u gewoon op de knop "toevoegen". Het systeem zal automatisch het
                        volgende academiejaar aanmaken.</p>
                    <h5>Een academiejaar activeren</h5>
                    <p>Als u op activeren klikt wordt dit het nieuwe actieve academiejaar. Het andere zal dan
                        gedeactiveerd worden.</p>
                </div>
            </div>
            <div class="card shadow help">
                <div class="card-body">
                    <h3 id="docents" class="card-title"><b>Hoe creëer ik een link voor docenten?</b></h3>
                    <p>Om een link te creëren voor docenten klikt u op uw naam rechts vanboven (hamburger icoontje op
                        mobiele browsers).<br>
                    U wordt dan naar een pagina verwezen met de huidige link en de optie om een nieuwe linkaan te maken.<br>
                    <b>LET OP!</b> Door een nieuwe link te maken vervalt de oude automatisch voor veiligheidsredenen. Wees
                        dus zeker dat de docenten hiervan op de hoogte zijn.</p>
                </div>
            </div>

            <div class="card shadow help">
                <div class="card-body">
                    <h3 id="status" class="card-title"><b>Welke statussen kunnen sessie hebben?</b></h3>
                    <div class="card bg-dark">
                        <div class="table-responsive">
                            <table class="table table-dark table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Omschrijving</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-info text-center">Beschikbaar</td>
                                    <td class="text-center">Deze sessie is beschikbaar voor studenten om een voorstel in te dienen</td>
                                </tr>
                                <tr>
                                    <td class="text-warning text-center">Aangevraagd</td>
                                    <td class="text-center">
                                        <p>Dit is een sessie dat een team van studenten heeft aangevraagd.<br>
                                        Andere studenten kunnen deze sessie dan niet meer zien.<br>
                                        Deze sessie wacht op feedback van een administrator.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-success text-center">Goedgekeurd</td>
                                    <td class="text-center">
                                        <p>Een administrator heeft dit voorstel goedgekeurd.<br>
                                        Docenten kunnen deze sessie zien op de <a href="#docents">Kalender</a> en
                                            zich hiervoor inschrijven.</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-danger text-center">Afgekeurd</td>
                                    <td class="text-center">
                                        <p>Een administrator heeft dit voorstel afgekeurd en feedback gegeven</br>
                                        Het team moet het sessie voorstel dan opnieuw aanpassen en indienen.</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow help">
                <div class="card-body">
                    <h3 id="tutorial" class="card-title"><b>Kan ik ergens een tutorial vinden?</b></h3>
                    <p>U kan een tutorial voor administrators vinden op <a href="https://www.youtube.com/playlist?list=PL8MPrfb45OXTz0xYLOjXwiBxZXP55xf3y">deze
                            link</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection
