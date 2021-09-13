@extends('layouts.template')

@section('main')
    <div id="wrapper" class="mt-4">
        <div id="page" class="container">
            <div class="card card-default bg-dark">
                <div class="table-responsive">
                    <!-- table documenten -->
                    <table class="table table-striped table-dark">
                        <thead>
                        <tr>
                            <th class="text-center">Bestand</th>
                            <th class="text-center">Beschikbaar tot</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($files as $file)
                            <tr>
                                <!-- file download -->
                                <td class="align-middle text-center"><a href="/student/documents/{{$file->id}}/download"><strong>{{$file->name}}</strong></a></td>
                                <td class="align-middle text-center">{{date('d/m/Y', strtotime($file->available_until))}} om {{date('H:i', strtotime($file->available_until))}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>



        </div>
    </div>

@endsection
