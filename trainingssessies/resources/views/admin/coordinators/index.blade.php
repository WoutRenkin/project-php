@extends('layouts.template')

@section('main')
<h1>Coördinator beheren</h1>
<a href="/admin/coordinators/create">Coördinator toevoegen</a>
<ul>
    @foreach ($users as $user)
        <li>
            <strong>{{ $user->first_name . " ".$user->last_name}}</strong> {{$user->r_number}}
            <a href="/admin/coordinators/{{ $user->id }}/edit" class="btn btn-outline-success">Bewerken</a>
        </li>
    @endforeach
</ul>
@endsection
