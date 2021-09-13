@extends('layouts.template')

@section('main')


    <div id="wrapper ">
        <div id="page" class="container bg-light p-3">
            <div class="card ">
                <div class="card-header bg-dark text-white">
                    <h3 class="heading has-text-weight-bold is-size-4">Team wijzigen</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="/admin/teams/{{ $team->id }}">
                        @csrf
                        @method('PUT')
                        @for ($i = 0; $i < 3; $i++)
                            <div class="form-group">
                                <select class="form-control" name="student{{$i}}" id="student{{$i}}">
                                    <option value="0">Kies student</option>
                                    @foreach($users as $user)
                                        <option
                                            value="{{ $user->id}}" {{(isset($team->students[$i]) && $team->students[$i]->id == $user->id) ? 'selected' : '' }}>{{$user->first_name." ".$user->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endfor
                        <button type="submit" class="btn btn-primary float-right">Opslaan</button>
                    </form>
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Terug</a>
                </div>
                <div class="card-footer bg-dark text-white">
                    @if($team->updated_at)
                        Laatst geupdate op: {{$team->updated_at}}
                    @else
                        Nog nooit geupdate
                    @endif
                </div>
            </div>

            <div class="modal" id="studentmodal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Team wijzigen</h5>
                            <button type="button" class="close closeModal" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="modalbodystudents">

                        </div>

                        <div class="modal-footer">
                            <button type="button" id="opslaan" class="btn btn-success">Opslaan</button>
                            <button type="button" class="btn btn-danger closeModal" data-dismiss="modal">Sluiten
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let studentsToGroup;
        var team = {{$team->id}};

        $('form').submit(function (e) {

            e.preventDefault();
            var student0 = $('#student0').find(':selected').val();
            var student1 = $('#student1').find(':selected').val();
            var student2 = $('#student2').find(':selected').val();
            var groupFound = false;

            $.ajax({
                type: 'GET',
                url: "/admin/teams/checkStudents",
                data: {students: [student0, student1, student2], team: team},
                success: function (data) {
                    studentsToGroup = data.students;
                    $("#studentmodal").show();
                    $("#modalbodystudents").empty();

                    if (studentsToGroup.length != 0) {
                        $("#modalbodystudents").append(`<p>Volgende studenten worden aan team {{$team->name}} toegevoegd:</p><ul id="students"></ul>`);
                        studentsToGroup.forEach(function (item) {
                            if (item.team) {
                                groupFound = true;
                            }
                            $("#students").append(`<li>${item.first_name} ${item.last_name}</li>`)
                        });
                        if (groupFound) {
                            $("#modalbodystudents").append(`<p id="danger" class="text-danger"><b>Opgelet</b>, volgende studenten behoren al tot een team en zullen dus verplaatst worden naar dit team:</p>`);
                            $("#modalbodystudents").append(`<ul id="groupFound"></ul>`);
                            studentsToGroup.forEach(function (item) {
                                if (item.team) {
                                    $("#groupFound").append(`<li class="text-danger">${item.first_name} ${item.last_name}</li>`)
                                }
                            })
                        }
                        $("#modalbodystudents").append(`<p>Als je zeker bent van deze veranderingen, klik dan op opslaan.</p>`);
                    } else {

                        $("#modalbodystudents").append(`<p>Geen studenten geselecteerd</p>`);

                    }
                }
            });
        })

        $(".closeModal").click(function () {
            $('#studentmodal').hide();
        })

        $("#opslaan").click(function () {
            UpdateTeam(team);
        });

        function UpdateTeam() {
            student0 = $('#student0').find(':selected').val();
            student1 = $('#student1').find(':selected').val();
            student2 = $('#student2').find(':selected').val();

            $.ajax({
                /* the route pointing to the post function */
                url: '/admin/teams/' + team,
                type: 'PUT',
                /* send the csrf-token and the input to the controller */
                data: {
                    "_token": "{{ csrf_token() }}",
                    "students": [student0, student1, student2],
                    "team": team,
                    dataType: 'json',

                },
                success: function (data) {
                    window.location = data.url;
                }
            })
        }


    </script>
@endsection
