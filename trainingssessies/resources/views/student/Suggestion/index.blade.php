@extends('layouts.template')

@section('main')
    @include('shared.navstudents')
    <div id="wrapper" class="mt-4">
        <div id="page" class="container">
    @if(Session::has('message'))
        <div id="sessionMessage" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
    @endif
    <h1>Ingediend voorstel</h1>

        <div class="card card-default bg-dark">
                <div class="table-responsive">
        <table class="table table-striped table-dark">
            <thead>
            <tr>
                <th class="text-center">Onderwerp</th>
                <th class="text-center">Status</th>
                <th class="text-center">Acties</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($Sessies as $index => $use)
                <tr>
                    @foreach ($organisations as $org)
                        @if($org->id == $use->organisation_id)
                            <td class="text-center">{{$use->subject}}({{ $org->name}})</td>
                        @endif
                    @endforeach
                    <td class="text-center">
                        @foreach($status as $statuss)
                            @if ($use->status_id == $statuss->id)
                                <p class=" @if($statuss->id == 1) text-warning @elseif($statuss->id == 2) text-danger @else text-success  @endif mr-4 font-weight-bold">{{$statuss->description}}
                                <i class="fas fa-info-circle " data-toggle="tooltip" title="@if($statuss->id == 1)Sessie heeft nog geen feedback! @elseif($statuss->id == 2) Sessie is afgekeurd! @elseif($statuss->id == 3) Sessie is goedgekeurd! @endif"></i>
                                </p>
                            @endif
                        @endforeach
                    </td>
                    <td class="text-center">
                        <a href="/student/voorstel/{{ $use->id }}/edit" class="btn btn-primary" tabindex="0" data-placement="bottom" data-toggle="tooltip" title="Via hier kan u een voorstel Bekijken!">Bekijken</a></td>
                    @endforeach
                </tr>
            <tbody>
        </table>
            </div>
    </div>
        </div>
    </div>
@endsection
