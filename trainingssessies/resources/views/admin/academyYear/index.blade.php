@extends('layouts.template')

@section('main')

    <div id="wrapper" class="mt-4">
        <div id="page" class="container">
            <!-- flash messages -->
            @if(Session::has('message'))
                <div id="sessionMessage"
                     class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
            @endif
            @include('../shared.hompagenav')
            <div class="card card-default bg-dark">
                <div class="table-responsive">
                    <!-- table academiejaren -->
                    <table class="table table-striped table-dark">
                        <thead>
                        <tr>
                            <th class="text-center">Academiejaar</th>
                            <th class="text-center">Actief</th>
                            <th class="text-center">Acties</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($academyYear as $year)
                            <tr>
                                <!-- academiejaar naam -->
                                <td class="text-center"><strong>{{$year->name_year}}</strong></td>
                                <!-- academiejaar actief? -->
                                <td class="text-center">@if($year->active)
                                        Ja
                                    @else
                                        Nee
                                    @endif
                                </td>
                                <!-- academiejaar acties -->
                                <td class="w-25 text-center">
                                    @if($year->active)
                                    @else
                                        <button type="button" data-toggle="modal" data-target="#yourmodal{{$year->id}}"
                                                class="btn btn-primary mt-2" tabindex="0">Activeren
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            <!-- modal -->
                            <div class="modal fade" id="yourmodal{{$year->id}}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Academiejaar activeren</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Als je dit jaar activeerd, deactiveer je het huidige actieve jaar!
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-toggle="tooltip"
                                                    title="Hou het huidige academiejaar actief" data-dismiss="modal">
                                                Sluiten
                                            </button>
                                            <form method="POST" action="academiejaar/{{$year->id}}/activate">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-danger" tabindex="0"
                                                        data-toggle="tooltip"
                                                        title="Via hier kan u een academiejaar activeren">Activeren
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                        <tbody>
                    </table>

                </div>
            </div>
            <!-- button voor nieuw academiejaar -->

            <div class="d-flex justify-content-center mt-3">
                <div class="ml-auto">
                    <a href="academiejaar/create" class="btn btn-primary" data-toggle="tooltip" title="Via hier kan u een nieuw academiejaar aanmaken">Toevoegen</a>
                </div>
            </div>
        </div>
    </div>


@endsection
