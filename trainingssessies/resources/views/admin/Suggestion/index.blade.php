@extends('layouts.template')

@section('main')
    <div id="wrapper" class="mt-4">
        <div id="page" class="container">
            @if(Session::has('message'))
                <div id="sessionMessage"
                     class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
            @endif
            @include('../shared.hompagenav')
            <form method="get" action="/admin/voorstel" id="searchForm">
                <div class="row">
                    <div class="col-sm-3 mb-2">
                        <!-- Sessie filters -->
                        <select class="form-control" name="sessie_filter" id="sessie_filter">
                            <option value="1" @if($sessie_filter == 1) selected="selected" @endif>Alle voorstellen
                            </option>
                            <option value="2" @if($sessie_filter == 2) selected="selected" @endif>Aangevraagde
                                voorstellen
                            </option>
                            <option value="3" @if($sessie_filter == 3) selected="selected" @endif>Goedgekeurde
                                voorstellen
                            </option>
                            <option value="4" @if($sessie_filter == 4) selected="selected" @endif>Afgekeurde
                                voorstellen
                            </option>
                        </select>
                    </div>
                    <div class="col-sm-4 mb-2">
                        <select class="form-control" name="sessie_seen" id="sessie_seen">
                            <option value="1" @if($sessie_seen == 1) selected="selected" @endif>Alle bekeken en
                                onbekeken voorstellen
                            </option>
                            <option value="2" @if($sessie_seen == 2) selected="selected" @endif>Bekeken voorstellen
                            </option>
                            <option value="3" @if($sessie_seen == 3) selected="selected" @endif>Onbekeken voorstellen
                            </option>
                        </select>
                    </div>
                    <div class="col-sm-2 mb-2">
                        <button type="submit" class="btn btn-success btn-block">Zoek</button>
                    </div>
                </div>
            </form>
            <div class="card card-default bg-dark">
                <div class="table-responsive">
                    <table class="table table-striped table-dark">
                        <thead>
                        <tr>
                            <th class="text-center">Team</th>
                            <th class="text-center">Studenten</th>
                            <th class="text-center">Onderwerp</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Acties</th>
                            <th class="text-center">Bekeken</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($Sessies as $use)
                            <tr>
                                <!-- Sessie naam-->
                                <td class="text-center"><strong>{{ $use->team->name}}</strong></td>
                                <td class="text-center">
                                @foreach($teams as $team)
                                    @if($team->id == $use->team_id)
                                        <!-- Naam studenten-->
                                            @foreach($team->students as $user)
                                                @if($loop->last)
                                                    <span>{{$user->first_name . " " . $user->last_name}}</span>
                                                @else
                                                    <span>{{$user->first_name . " " . $user->last_name .", "}}</span>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </td>
                                <!-- Naam onderwerp-->
                                <td class="text-center"><span>{{$use->subject}}</span></td>
                                <td class="text-center">
                                    <!-- Status -->
                                    @foreach($status as $statuss)
                                        @if ($use->status_id == $statuss->id)
                                            <p class=" @if($statuss->id == 1) text-warning @elseif($statuss->id == 2) text-danger @else text-success  @endif mr-4 font-weight-bold">{{$statuss->description}}
                                                <i class="fas fa-info-circle " data-toggle="tooltip"
                                                   title="@if($statuss->id == 1)Sessie heeft nog geen feedback! @elseif($statuss->id == 2) Sessie is afgekeurd! @elseif($statuss->id == 3) Sessie is goedgekeurd! @endif"></i>
                                            </p>
                                        @endif
                                    @endforeach
                                </td>
                                <!-- buttons-->
                                <td class="text-center">
                                    <a href="/admin/voorstel/{{ $use->id }}/edit" class="btn btn-primary"
                                       data-toggle="tooltip" title="Voorstel bekijken.">Bekijken</a>
                                </td>
                                <!-- Bekeken/Niet bekeken -->
                                <td class="text-center">
                                    @if ($use->seen == false)
                                        <i class="far fa-eye-slash" data-toggle="tooltip"
                                           title="Je hebt dit voorstel nog niet bekeken."></i>
                                    @else
                                        <i class="far fa-eye" data-toggle="tooltip"
                                           title="Je hebt dit voorstel al eens bekeken."></i>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
                <div class="d-flex mt-3">
                    <div class="">{{ $Sessies->links() }}</div>
                </div>
        </div>
    </div>

@endsection
