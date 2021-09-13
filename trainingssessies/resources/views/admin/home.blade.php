@extends('layouts.template')

@section('main')

    <div id="wrapper" class="mt-4">
        <div id="page" class="container">
            @if(Session::has('message'))
                <div id="sessionMessage" class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
            @endif
            <ul class="nav nav-tabs mb-2">
                <li class="nav-item">
                    <a class="nav-link active " href="/admin/home">All</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/students">Students</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link "  href="/admin/teams">Teams</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="/admin/voorstel">Voorstellen</a>
                </li>
            </ul >
        </div>
    </div>
@endsection
