@extends('layouts.template')

@section('main')

    <div id="page" class="container">
        @if(Session::has('message'))
            <div id="sessionMessage" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
        @endif
        @include('../shared.hompagenav')

        <form method="get" action="/admin/teams" id="searchForm">
            <div class="row">
                <div class="col-sm-4 mb-2">
                    <input type="text" class="form-control" name="myinput" id="myInput"
                           value="{{$myinput}}" placeholder="Filter op naam">
                </div>
                <div class="col-sm-3 mb-2">
                    <select class="form-control" name="team_filter" id="team_filter">
                        <option value="1" @if($team_filter == 1) selected="selected" @endif>Alle teams</option>
                        <option value="2" @if($team_filter == 2) selected="selected" @endif>Volle teams</option>
                        <option value="3" @if($team_filter == 3) selected="selected" @endif>Lege teams</option>
                    </select>
                </div>
                <div class="col-sm-3 mb-2">
                    <select class="form-control" name="sessie_filter" id="sessie_filter">
                        <option value="0" selected="selected">Kies een status</option>
                        <option value="aangevraagd" @if($sessie_filter == "aangevraagd") selected="selected" @endif>
                            Aangevraagd
                        </option>
                        <option value="afgekeurd" @if($sessie_filter == "afgekeurd") selected="selected" @endif>
                            Afgekeurd
                        </option>
                        <option value="goedgekeurd" @if($sessie_filter == "goedgekeurd") selected="selected" @endif>
                            Goedgekeurd
                        </option>
                        <option value="geenstatus" @if($sessie_filter == "geenstatus") selected="selected" @endif>Geen
                            status
                        </option>
                    </select>
                </div>
                <div class="col-sm-2 mb-2">
                    <button type="submit" class="btn btn-success btn-block"
                            title="Klik hier om de filters te activeren." data-toggle="tooltip">Zoek
                    </button>
                </div>
            </div>
        </form>
        <div class="card bg-dark">
            <div class="table-responsive">
                <table class="table table-dark table-striped">
                    <thead>
                    <tr>
                        <th class="text-center">Groep nummer</th>
                        <th class="text-center">Studenten</th>
                        <th class="text-center">Aantal</th>
                        <th class="text-center">Sessie</th>
                        <th class="text-center">Sessie status</th>
                        <th class="text-center">Wijzigen</th>
                    </tr>
                    </thead>
                    <tbody id="myTable">
                    @foreach($teams as $team)
                        <tr>
                            <td class="align-middle text-center">{{$team->name}}</td>
                            <td class="align-middle text-center">
                                @foreach($team->students as $user)
                                    @if($loop->last)
                                        {{$user->first_name . " " . $user->last_name}}
                                    @else
                                        {{$user->first_name . " " . $user->last_name . ", "}}
                                    @endif
                                @endforeach
                            </td>
                            <td class="align-middle text-center">
                                {{count($team->students)}}/3
                            </td>
                            @if($team->session)
                                <td class="align-middle text-center">
                                    {{$team->session->subject}}
                                </td>
                                <td class="align-middle text-center @if($team->status->id == 1)text-warning @elseif($team->status->id == 2) text-danger @elseif($team->status->id == 3) text-success @endif">
                                    <b>{{$team->status->description}}</b>

                                    <i class="fas fa-info-circle " data-toggle="tooltip"
                                       title="@if($team->status->id == 1)Sessie heeft nog geen feedback! @elseif($team->status->id == 2) Sessie is afgekeurd! @elseif($team->status->id == 3) Sessie is goedgekeurd! @endif"></i>
                                </td>
                            @else
                                <td class="align-middle text-center">
                                    Geen sessie ingediend
                                </td>
                                <td class="align-middle text-center">
                                    Geen status
                                    <i class="fas fa-info-circle" data-toggle="tooltip"
                                       title="Dit team heeft nog geen ingediende sessie!"></i>
                                </td>
                            @endif

                            <td class="align-middle text-center">

                                <a href="teams/{{$team->id}}/edit" class="btn btn-primary m-1" title="Wijzig dit team"
                                   data-toggle="tooltip">Wijzigen</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
            <div class="d-flex justify-content-center mt-3">
                <div class="ml-auto">
                    <form method="POST" action="/admin/teams">
                        @csrf
                        <button type="submit" class="btn btn-primary m-1 float-right" data-toggle="tooltip"
                                title="Voeg een nieuw team toe!">Team toevoegen</button>
                    </form>                </div>
            </div>

    </div>
    <!-- Button trigger modal -->



    <script>
        $(function () {
            let value2 = "{{ $myinput }}"
            $("#myTable tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value2) > -1)
            });
        });
    </script>


@endsection

