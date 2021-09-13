@extends('layouts.template')

@section('main')
    @include('shared.navstudents')
    <div id="wrapper">
        <div id="page" class="container mt-4">
            @if(Session::has('message'))
                <div id="sessionMessage" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
            @endif
            <h1>Mogelijke Sessies</h1>
                <form method="get" action="/student/voorstel" id="searchForm">
                    <div class="row">
                        <div class="col-4 mb-2">
                            <input type="text" class="form-control" name="name" id="name"
                                   value="{{$name}}" placeholder="Filter op naam">
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
                    <th class="text-center">Onderwerp</th>
                    <th class="text-center">Organisatie</th>
                    <th class="text-center"></th>
                </tr>
                </thead>
                <tbody>
                @if(count($sessions) == 0)
                    <tr><td class="text-center" colspan="3">
                            Er zijn nog geen sessies toegevoegd door de docent.
                        </td></tr>
                @else
                @foreach($sessions as $session)
                    <tr>
                        <td class="text-center"> {{$session->subject}} </td>
                        <td class="text-center"> {{$session->organisation->name}} </td>
                        <td class="text-center"><a class="btn btn-primary" href="/student/voorstel/{{ $session->id }}/download">Download</a></td>
                    </tr>
                @endforeach
                </tbody>
                @endif
            </table>

        </div>

                </div>
                <div class="d-flex mt-3">
                    <div class="">{{ $sessions->links() }}</div>
                    <div class="ml-auto"> <a class="btn btn-primary" href="/student/voorstel/create">Dien een voorstel in</a></div>
            </div>

        </div>
@endsection
