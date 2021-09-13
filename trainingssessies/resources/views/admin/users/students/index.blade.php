@extends('layouts.template')

@section('main')
    <div id="wrapper" class="mt-4">
        <div id="page" class="container">
            @if(Session::has('message'))
                <div id="sessionMessage"
                     class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
            @endif
            @include('../shared.hompagenav')

            <form method="get" action="/admin/students" id="searchForm">
                <div class="row">
                    <div class="col-4 mb-2">
                        <input type="text" class="form-control" name="name" id="name"
                               value="{{trim($name, '%')}}" placeholder="Filter op naam">
                    </div>
                    <div class="col-3 mb-2">
                        <select class="form-control" name="team" id="team">
                            <option value="0" @if($team == 0) selected @endif>Alles</option>
                            <option value="1" @if($team == 1) selected @endif>Studenten met team</option>
                            <option value="2" @if($team == 2) selected @endif>Studenten zonder team</option>

                        </select>
                    </div>
                    <div class="col-3 mb-2">
                        <select class="form-control" name="academy_year" id="academy_year">
                            @foreach($academy_years as $academy_year)
                                <option value="{{$academy_year->id}}"
                                        @if($academy_year->id == $year_filter) selected @endif>{{$academy_year->name_year}} @if($academy_year->id == $active_year)
                                        (actief) @endif</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-2 mb-2">
                        <button type="submit" class="btn btn-success btn-block">Zoek</button>
                    </div>
                </div>
            </form>
            <div class="card card-default bg-dark">
                <div class="table-responsive">
                    <table class="table table-striped table-dark">
                        <thead>
                        <tr>
                            <th class="text-center">Voornaam</th>
                            <th class="text-center">Achternaam</th>
                            <th class="text-center">R-nummer</th>
                            <th class="text-center">Actief</th>
                            <th class="text-center">Team nr.</th>
                            @if($year_filter != $active_year)
                                <th class="text-center">toevoegen huidig jaar</th>
                            @endif
                            <th class="text-center">Zelfreflectie verslag</th>
                            <th class="text-center">Wijzigen</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($users as $user)
                            <tr>
                                <td class="text-center">{{ $user->first_name}}</td>
                                <td class="text-center">{{$user->last_name}}</td>
                                <td class="text-center">{{$user->r_number}}</td>
                                @if($user->active == 0)
                                    <td class="text-center text-danger">Inactief</td>
                                @endif
                                @if($user->active == 1)
                                    <td class="text-center text-success">Actief</td>
                                @endif
                                @if($user->team_id)
                                    <td class="text-center text-success">{{$user->team_id}}</td>
                                @else
                                    <td class="text-center text-danger">Geen team</td>
                                @endif
                                @if($year_filter != $active_year)
                                    @if($user->in_active_year)
                                        <td class="text-center">In huidige jaar</td>
                                    @else
                                        <td class="text-center"><a
                                                href="/admin/students/{{ $user->student_id }}/addToYear"
                                                data-toggle="tooltip" title="Voeg student aan dit academiejaar toe."
                                                class="btn btn-success">Toevoegen</a></td>
                                    @endif
                                @endif
                                @if($user->self_evaluation_file)
                                    <td class="text-center"><a href="/admin/students/{{ $user->id }}/download"
                                                               data-toggle="tooltip" title="Download reflectieverslag"
                                                               class="btn btn-primary">Download</a></td>
                                @else
                                    <td class="text-center">Geen bestand</td>
                                @endif
                                <td class="text-center"><a href="/admin/students/{{ $user->student_id }}/edit"
                                                           data-toggle="tooltip" title="Wijzig {{$user->first_name}}"
                                                           class="btn btn-primary">Wijzigen</a></td>
                            </tr>
                        @endforeach
                        <tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex justify-content-center mt-3">
                <div class="">{{ $users->links() }}</div>
                <div class="ml-auto">
                    <a href="/admin/students/create" class="btn btn-primary" data-toggle="tooltip"
                       title="Voeg een gebruiker toe.">Toevoegen</a>
                </div>
            </div>
        </div>
        <script>

        </script>
@endsection
