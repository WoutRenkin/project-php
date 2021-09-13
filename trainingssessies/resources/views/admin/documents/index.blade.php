@extends('layouts.template')

@section('main')
    <div id="wrapper" class="mt-4">
        <div id="page" class="container">
            @if(Session::has('message'))
                <div id="sessionMessage" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
            @endif
            @include('../shared.hompagenav')
            <div class="card card-default bg-dark">
                <div class="table-responsive">
                    <!-- table documenten -->
                    <table class="table table-striped table-dark">
                        <thead>
                        <tr>
                            <th class="text-center">Bestand</th>
                            <th class="text-center">Beschikbaar van</th>
                            <th class="text-center">Beschikbaar tot</th>
                            <th class="text-center">Aanpassen</th>
                            <th class="text-center">Beschikbaarheid</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($files as $file)
                        <tr>
                            <!-- file name -->
                            <td class="align-middle text-center"><a href="/admin/documents/{{ $file->id }}/download" data-toggle="tooltip" title="Klik om {{$file->name}} te downloaden."><strong>{{$file->name}}</strong></a></td>
                            <!-- file available from -->
                            <td class="align-middle text-center">{{date('d/m/Y', strtotime($file->available_from))}} om {{date('H:i', strtotime($file->available_from))}}</td>
                            <!-- file available until -->
                            <td class="align-middle text-center">{{date('d/m/Y', strtotime($file->available_until))}} om {{date('H:i', strtotime($file->available_until))}}</td>

                            <!-- edit availability -->
                            <td class="align-middle text-center">
                                <form method="POST" action="/admin/documents/{{ $file->id }}/updateActive">
                                    @csrf
                                    @method('PUT')
                                    @if(date('Y-m-d H:i:s', strtotime($file->available_from)) <= Carbon\Carbon::now() && date('Y-m-d H:i:s', strtotime($file->available_until)) >= Carbon\Carbon::now())
                                        <button type="submit" class="btn btn-danger" name="updateActive" value="deactivate" data-toggle="tooltip" title="Deactiveer dit bestand.">Deactiveren</button>
                                    @elseif(date('Y-m-d H:i:s', strtotime($file->available_from)) >= Carbon\Carbon::now() OR date('Y-m-d H:i:s', strtotime($file->available_until)) <= Carbon\Carbon::now())
                                        <button type="submit" class="btn btn-success" name="updateActive" value="activate" data-toggle="tooltip" title="Activeer dit bestand.">Activeren</button>
                                    @endif
                                </form>
                            </td>
                            <!-- edit files -->
                            <td class="text-center">
                                <a href="documents/{{$file->id}}/edit" class="btn btn-primary m-1" data-toggle="tooltip" title="Wijzig dit bestand.">Wijzigen</a>
                            </td>


                        </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
                <a href="/admin/documents/create" class="btn btn-primary mt-2 float-right" data-toggle="tooltip" title="Voeg een nieuw bestand toe">Toevoegen</a>


        </div>
    </div>

@endsection
