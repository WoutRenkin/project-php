@extends('layouts.template')

@section('main')
    @include('shared.navstudents')


    <div id="wrapper">
        <div id="page" class="container">
            @if(Session::has('message'))
                <div id="sessionMessage" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
            @endif


        <div class="card bg-dark">
        <div class="table-responsive">
            <table class="table table-dark table-striped">
                <thead>
                <tr>
                    <th class="text-center">Groep nummer</th>
                    <th class="text-center">Studenten</th>
                    <th class="text-center">Aantal</th>
                    <th class="text-center">Inschrijving</th>
                </tr>
                </thead>
                <tbody>
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
                        <td class="align-middle text-center">
                            @if($userInfo->team_id === $team->id)
                                <form method="POST" action="/student/teams/{{ $team->id }}">
                                    @csrf
                                    @method('PUT')
                                    <button name="submitButton" type="submit" class="btn btn-danger" value="uitschrijven">Uitschrijven</button>
                                    @if(count($team->students) < 3)
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#team{{$team->id}}">Wijzigen</button>
                                    @endif

                                </form>
                            @endif
                            @if($userInfo->team_id === null && count($team->students) < 3)
                                <form method="POST" action="/student/teams/{{ $team->id}}">
                                    @csrf <a></a>
                                    @method('PUT')
                                    @if(count($team->students) == 2)
                                        <button name="submitButton" type="submit" class="btn btn-primary" value="inschrijven">Inschrijven</button>
                                    @else
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#team{{$team->id}}">Inschrijven</button>
                                    @endif
                                </form>
                            @endif
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
        </div>
        </div>
        @foreach($teams as $team)
            @if($userInfo->team_id === null && count($team->students) < 2 || $userInfo->team_id != null)
            <div class="modal fade" id="team{{$team->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Inschrijven team</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="/student/teams/{{ $team->id }}">
                            @csrf
                            @method('PUT')
                        <div class="modal-body">
                            <p>De nieuwe studenten die je bij het team toevoegd zullen een mail ontvangen dat ze bij jou team zijn toegevoegd!</p>
                            <div class="form-group">
                                <select class="form-control">
                                    <option value="{{Auth::user()->id}}"> {{Auth::user()->first_name ." ". Auth::user()->last_name}}</option>
                                </select>
                            </div>
                            @foreach($team->students as $student)
                                @if($student->id != $userInfo->id)
                                <div class="form-group">
                                    <select class="form-control">
                                        <option value="{{$student->id}}"> {{$student->first_name ." ". $student->last_name}}</option>
                                    </select>
                                </div>
                                @endif
                            @endforeach
                            @if($userInfo->team_id != null)
                                @for ($i = 0; $i < 3 - count($team->students); $i++)
                                    <div class="form-group">
                                        <select class="form-control" name="student{{$i}}" id="student{{$i}}">
                                            <option value="0" >Kies student</option>
                                            @foreach($students as $user)
                                                @if($user->id != $userInfo->id)
                                                    <option value="{{ $user->id}}">{{$user->first_name." ".$user->last_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                @endfor
                            @else
                                @for ($i = 0; $i < 2 - count($team->students); $i++)
                                    <div class="form-group">
                                        <select class="form-control" name="student{{$i}}" id="student{{$i}}">
                                            <option value="0" >Kies student</option>
                                            @foreach($students as $user)
                                                @if($user->id != $userInfo->id)
                                                    <option value="{{ $user->id}}">{{$user->first_name." ".$user->last_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                @endfor
                            @endif

                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Sluiten</button>
                            <button name="submitButton" type="submit" class="btn btn-primary" value="inschrijven">Inschrijven</button>
                        </div>
                        </form>

                    </div>
                </div>

            </div>
            @endif
        @endforeach
    </div>


@endsection


