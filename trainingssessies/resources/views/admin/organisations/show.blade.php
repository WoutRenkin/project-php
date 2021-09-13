@extends('layouts.template')

@section('main')

    <div id="wrapper" class="mt-4">
        <div id="page" class="container">

            @include('../shared.hompagenav')

            <div class="card">
                <div class="card-header bg-dark text-white">
                    Organisatie: {{$organisation->name}}
                </div>
                <div class="card-body">
                    <h5 class="card-title">Gegevens</h5>
                    <p class="card-text"><b>E-mailadres: </b>{{$organisation->email}}</p>
                    <p class="card-text"><b>Telefoonnummer: </b>{{$organisation->tel_number}}</p>
                    <p class="card-text"><b>Contactpersoon: </b>{{$organisation->contact_person}}</p>
                    <p class="card-text"><b>Adres: </b>{{$organisation->place}}, {{$organisation->address}}</p>
                    <p class="card-text"><b>Status: </b> @if($organisation->active)<span class="text-success">Actief</span>@else<span class="text-danger">Inactief</span> @endif</p>
                    <p class="card-text"><b>Beschrijving: </b>{{$organisation->description}}</p>
                    <a href="/admin/organisations" class="btn btn-primary">Terug</a>
                    <a href="/admin/organisations/{{$organisation->id}}/edit" class="btn btn-primary m-1" data-toggle="tooltip" title="Wijzig deze organisatie.">Wijzigen</a>
                </div>
                <div class="card-footer bg-dark text-white">
                    @if($organisation->updated_at)
                        Laatst geupdate op: {{$organisation->updated_at}}
                    @else
                        Nog nooit geupdate
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection

