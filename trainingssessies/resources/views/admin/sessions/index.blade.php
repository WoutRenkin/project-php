@extends('layouts.template')

@section('main')


    <div id="wrapper" class="mt-4">
        <div id="page" class="container">
            @if(Session::has('message'))
                <div id="sessionMessage"
                     class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
            @endif
            @include('../shared.hompagenav')
                <form method="get" action="/admin/sessions" id="searchForm">
                    <div class="row">
                        <div class="col-sm-4 mb-2">
                            <input type="text" class="form-control" name="myinput" id="myInput"
                                   value="{{$myInput}}" placeholder="Filter op onderwerp" >
                        </div>
                        <div class="col-sm-2 mb-2">
                            <button type="submit" class="btn btn-success btn-block" title="Klik hier om de filters te activeren." data-toggle="tooltip">Zoek</button>
                        </div>
                    </div>
                </form>
            <div class="card card-default bg-dark">
                <div class="table-responsive">
                    <table class="table table-striped table-dark">
                        <thead>
                        <tr>
                            <th class="text-center">Onderwerp</th>
                            <th class="text-center">Organisatie</th>
                            <th class="text-center">Wijzigen</th>
                        </tr>
                        </thead>
                        <tbody id="myTable">
                        @foreach($sessions as $session)
                            <tr>
                                <td class="text-center"> {{$session->subject}} </td>
                                <td class="text-center"> {{$session->organisation->name}} </td>
                                <td class="text-center"><a href="sessions/{{$session->id}}/edit" class="btn btn-primary m-1" data-toggle="tooltip" title="Wijzig deze sessie">Wijzigen</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
                <div class="d-flex justify-content-center mt-3">
                    <div class="">{{ $sessions->links() }}</div>
                    <div class="ml-auto">
                        <a href="/admin/sessions/create" class="btn btn-primary">Toevoegen</a>
                    </div>
                </div>
        </div>
    </div>
@endsection
