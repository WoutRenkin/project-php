@extends('layouts.template')

@section('title', 'Welcome to The Vinyl Shop')
@section('main')
@include('shared.navstudents', ['userAcademyYears' => $userAcademyYears])

    <div class="container d-flex" id="page-content">
        <div class="row justify-content-center mt-3 pt-2">
            <div class="jumbotron">
                <h1 class="display-4">Welkom, {{Auth()->user()->first_name}}</h1>
                <p class="lead">Dit is de trainingssessie applicatie die jullie zullen gebruiken voor het vak professionele ontwikkeling om een trainingssessie te geven.</p>
                <hr class="my-4">
                <p>
                    Zoals jullie boven aan de pagina kunnen zien zijn slechts enkele links beschikbaar gezet.
                    Dit komt omdat er eerst nog enkele opdrachten zijn die jullie moeten voltooien.
                    Om verder te gaan en de volgende link te zien moet je je eerst <b>inschrijven in een team</b>.
                    Hierna kan je dan een voorstel voor een sessie indienen en zodra dat deze sessie door jullie uitgevoerd is, zal de link om jullie verslag in te dienen voor jullie beschikbaar gesteld worden.
                </p>
                <p>
                    Ga van start met jezelf in te schrijven in een team door op onderstaande knop te drukken.
                </p>
                <p class="lead">
                    <a class="btn btn-primary btn-lg" href="student/teams" role="button">Teams</a>
                </p>
            </div>
        </div>
    </div>


@endsection
