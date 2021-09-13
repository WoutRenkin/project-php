@extends('layouts.template')

@section('main')

    <div id="wrapper" class="mt-4">
        <div id="page" class="container">
            @if(Session::has('message'))
                <div id="sessionMessage" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
            @endif
            @include('../shared.hompagenav')
                <form method="get" action="/admin/organisations" id="searchForm">
                    <div class="row">
                        <div class="col-sm-4 mb-2">
                            <input type="text" class="form-control" name="myinput" id="myInput"
                                   value="{{$myinput}}" placeholder="Filter op naam" >
                        </div>
                        <div class="col-sm-3 mb-2">
                            <select class="form-control" name="active_filter" id="active_filter">
                                <option value="1" @if($active_filter == 1) selected="selected" @endif>Actieve organisaties</option>
                                <option value="2" @if($active_filter == 2) selected="selected" @endif>Inactieve organisaties</option>
                            </select>
                        </div>
                        <div class="col-sm-2 mb-2">
                            <button type="submit" class="btn btn-success btn-block" title="Klik hier om de filters te activeren." data-toggle="tooltip">Zoek</button>
                        </div>
                    </div>
                </form>
            <div class="card shadow bg-dark">
                <div class="table-responsive ">
                    <table class="table table-striped table-dark table-hover">
                        <thead>
                        <tr>
                            <th class="text-center"><i class="fas fa-info-circle float-left fa-lg" data-toggle="tooltip" title="Klik op een rij om extra informatie van de organisatie te bekijken."></i> Organisatie</th>
                            <th class="text-center">Contactpersoon</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Wijzigen</th>
                            <th class="text-center">Activeren/Deactiveren</th>
                        </tr>
                        </thead >
                        <tbody id="myTable">
                        @foreach($organisations as $organisation)
                            <tr >
                                <td class="align-middle text-center clickable-row" data-href='organisations/{{$organisation->id}}' data-toggle="tooltip" title="Klik om organisatie te bekijken.">{{$organisation->name}}</td>
                                <td class="align-middle text-center clickable-row" data-href='organisations/{{$organisation->id}}' data-toggle="tooltip" title="Klik om organisatie te bekijken.">{{$organisation->contact_person}}</td>
                                <td class="align-middle text-center clickable-row" data-href='organisations/{{$organisation->id}}' data-toggle="tooltip" title="Klik om organisatie te bekijken.">{{$organisation->email}}</td>
                                <td class="align-middle text-center">
                                    <a href="organisations/{{$organisation->id}}/edit" class="btn btn-primary m-1" data-toggle="tooltip" title="Wijzig deze organisatie.">Wijzigen</a>
                                </td>
                                <td class="align-middle text-center">
                                    <form method="POST" action="/admin/organisations/{{ $organisation->id }}/updateActive">
                                        @csrf
                                        @method('PUT')
                                        @if($organisation->active)
                                            <button type="submit" class="btn btn-danger" name="updateActive" value="deactivate" data-toggle="tooltip" title="Deactiveer deze organisatie!">Deactiveren</button>
                                        @else
                                            <button type="submit" class="btn btn-success" name="updateActive" value="activate" data-toggle="tooltip" title="Activeer deze organisatie!">Activeren</button>
                                        @endif
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
                <div class="d-flex justify-content-center mt-3">
                    <div class="">{{ $organisations->links() }}</div>
                    <div class="ml-auto">
                        <a href="/admin/organisations/create" class="btn btn-primary float-right" data-toggle="tooltip" title="Voeg een nieuwe organisatie toe.">Toevoegen</a>
                    </div>
                </div>
        </div>
    <script>
        $(function () {
            $(".clickable-row").click(function(){
                window.location.href = $(this).data("href");
                console.log($(this).data("href"))

            });
        });

    </script>
@endsection

