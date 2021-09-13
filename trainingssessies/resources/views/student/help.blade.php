@extends('layouts.template')

@section('main')
    <div id="wrapper" class="mt-4 helpmenu">
        <div id="page" class="container">
            <h1>Hulp menu voor studenten</h1>
            <h3 id="intro">Wat is het hulp menu?</h3>
            <p>In dit hulpmenu wordt er een korte (en hopelijk duidelijke) uitleg gegeven over alle functionaliteiten van de applicatie.</p>
            <p>Dit menu bevat de volgende onderdelen:</p>
            <ul>
                <li><a href="#navigation">Hoe gebruik ik de navigatebalk?</a></li>
                <li><a href="#teams">Hoe schrijf ik me in in een team?</a></li>
                <li><a href="#suggestions">Hoe dien ik een trainingssessie voorstel in?</a></li>
                <li><a href="#selfevaluation">Hoe dien ik een zelfevaluatie verslag in?</a></li>
                <li><a href="#files">Waar vind ik de nodige sjablonen?</a></li>
                <li><a href="#calendar">Wat is de kalender?</a></li>
                <li><a href="#tutorial">Kan ik ergens een tutorial vinden?</a></li>

            </ul>

            <div class="card shadow help">
                <div class="card-body">
                    <h3 id="navigation" class="card-title"><b>Hoe gebruik ik de navigatebalk?</b></h3>
                    <h5>Vergrendelde knoppen</h5>
                    <p>Als een knop vergrendeld is met het <i class="fas fa-lock" ></i> icoon wil dat zeggen dat je nog niet aan de nodige voorwaarden voldoet.<br>
                        Je krijgt meer informatie over die voorwaarden als je er met je muis over gaat.
                    </p>
                    <hr>
                    <p>Dit zijn de voorwaarden waaraan je moet voldoen:</p>
                    <div class="card bg-dark">
                        <div class="table-responsive">
                            <table class="table table-dark table-striped">
                                <thead>
                                <tr>
                                    <th class="text-center">Link</th>
                                    <th class="text-center">Voorwaarden</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="text-center">Voorstellen bekijken</td>
                                    <td class="text-center">Je moet in een team zitten</td>
                                </tr>
                                <tr>
                                    <td class="text-center">Voorstel indienen</td>
                                    <td class="text-center">Je moet in een team zitten</td>
                                </tr>
                                <tr>
                                    <td class="text-center">Zelfreflectie indienen</td>
                                    <td class="text-center">Jouw sessie moet eerst afgelopen zijn</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow help">
                <div class="card-body">
                    <h3 id="teams" class="card-title"><b>Je inschrijven in een team</b></h3>
                    In het teams menu kan je een op "inschrijven" klikken.<br>
                    Er komt dan een dialoogvenster waar je eventueel ook enkele andere studenten kan selecteren.<br>
                    Je kan je dan later eventueel ook uitschrijven.
                    </p>
                </div>
            </div>


            <div class="card shadow help">
                <div class="card-body">
                    <h3 id="suggestions" class="card-title"><b>Hoe dien ik een sessie voorstel in?</b></h3>
                    <p>Als je een sessie document bekeken hebt en je wilt een voorstel indienen kan dat in het "voorstel" menu.<br>
                    Je vult dan het formulier in en klikt op "indienen". Hierna zal een administrator dit nakijken en eventueel feedback op geven.<br>
                    Als het afgekeurd is zal je enkele wijzigingen aan moeten brengen.<br>
                    Als het goedgekeurd is zal je dat in je kalender kunnen vinden.</p>
                </div>
            </div>

            <div class="card shadow help">
                <div class="card-body">
                    <h3 id="selfevaluation" class="card-title"><b>Hoe dien ik een zelfevaluatie verslag in?</b></h3>
                    <p>Als je sessie afgelopen is kan je dan een zelfverslag indienen.<br>
                    Je vult dan een bestand in volgens het sjabloon dat je bij <a href="#files">sjablonen</a> kan vinden en dient het in.</p>
                </div>
            </div>

            <div class="card shadow help">
                <div class="card-body">
                    <h3 id="files" class="card-title"><b>Waar vind ik de nodige sjablonen?</b></h3>
                    <p>Je kan de nodige sjablonen vinden als je op jouw naam klikt in de navigatiebalk en naar "documenten" gaat.</p>
                </div>
            </div>

            <div class="card shadow help">
                <div class="card-body">
                    <h3 id="calendar" class="card-title"><b>Wat is de kalender?</b></h3>
                    <p>Op de kalender kan je jouw sessie terugvinden.</p>
                </div>
            </div>

            <div class="card shadow help">
                <div class="card-body">
                    <h3 id="tutorial" class="card-title"><b>Kan ik ergens een tutorial vinden?</b></h3>
                    <p>Je kan een tutorial voor studenten vinden op <a href="https://www.youtube.com/playlist?list=PL8MPrfb45OXSGSDksAIYFWEbnLc-AfS2-">deze link.</a></p>
                </div>
            </div>

        </div>
    </div>
@endsection
