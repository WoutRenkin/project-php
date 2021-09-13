@extends('layouts.template')

@section('main')
    <div id="wrapper" class="mt-4">
        <div id="page" class="container">
            @if(Session::has('message'))
                <div id="sessionMessage"
                     class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
            @endif
            @include('../shared.hompagenav')

            <form method="get" action="/admin/admins" id="searchForm">
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <input type="text" class="form-control" name="name" id="name"
                               value="{{trim($name, '%')}}" placeholder="Filter op naam">
                    </div>
                    <div class="col-sm-2 mb-2">
                        <button type="submit" class="btn btn-success btn-block">Zoek</button>
                    </div>
                </div>
            </form>
            <div class="card card-default bg-dark" id="usertable">
                <div class="table-responsive">
                    <table class="table table-striped table-dark">
                        <thead>
                        <tr>
                            <th class="text-center">Voornaam</th>
                            <th class="text-center">Achternaam</th>
                            <th class="text-center">R-nummer</th>
                            <th class="text-center">E-mail</th>
                            <th class="text-center">Actief</th>
                            <th class="text-center">Wijzigen</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach ($users as $user)
                            <tr>
                                <td class="text-center">{{ $user->first_name}}</td>
                                <td class="text-center">{{$user->last_name}}</td>
                                <td class="text-center">{{$user->r_number}}</td>
                                <td class="text-center">{{$user->email}}</td>
                                @if($user->active == 0)
                                    <td class="text-danger">Inactief</td>
                                @endif
                                @if($user->active == 1)
                                    <td class="text-success text-center">Actief</td>
                                @endif
                                <td class="text-center"><a href="/admin/students/{{ $user->id }}/edit"
                                                           class="btn btn-primary" data-toggle="tooltip"
                                                           title="Wijzig {{$user->first_name}}">Wijzigen</a></td>
                            </tr>
                        @endforeach
                        <tbody>
                    </table>
                </div>
            </div>
            <div class="d-flex  align-items-end mt-3">
                <div class="">{{ $users->links() }}</div>
                <div class="ml-auto">
                    <a href="/admin/students/create" class="btn btn-primary" data-toggle="tooltip"
                       title="Voeg een gebruiker toe.">Toevoegen</a>
                </div>
            </div>
        </div>
    </div>
@endsection
