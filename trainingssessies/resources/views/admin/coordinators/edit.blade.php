@extends('layouts.template')

@section('main')
<h1>Coördinator Aanpassen</h1>
<form action="/admin/coordinators/{{ $coordinator->id }}" method="post">
    @method('put')
    @csrf
    <div class="form-group">
        <label for="first_name">Voornaam</label>
        <input type="text" name="first_name" id="first_name"
               class="form-control @error('last_name') is-invalid @enderror"
               placeholder="Voornaam"
               minlength="3"
               required
               value="{{ old('first_name', $coordinator->first_name) }}">
        @error('first_name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <label for="last_name">Achternaam</label>
        <input type="text" name="last_name" id="last_name"
               class="form-control @error('last_name') is-invalid @enderror"
               placeholder="Achternaam"
               minlength="3"
               required
               value="{{ old('last_name', $coordinator->last_name) }}">
        @error('last_name')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <label for="r_number">r-nummer:</label>
        <input type="text" name="r_number" id="r_number"
               class="form-control @error('r_number') is-invalid @enderror"
               placeholder="r-nummer"
               minlength="3"
               required
               value="{{ old('r_number', $coordinator->r_number) }}">
        @error('r_number')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <label for="email">email:</label>
        <input type="text" name="email" id="email"
               class="form-control @error('email') is-invalid @enderror"
               placeholder="email"
               minlength="3"
               required
               value="{{ old('email', $coordinator->email) }}">
        @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror


    </div>
    <div class="btn-group btn-group-sm">
        <button type="submit" formaction="/admin/coordinators/{{ $coordinator->id }}/deactivate" class="btn btn-danger">Deactiveren</button>
        <button type="submit" class="btn btn-success">Opslaan</button>
    </div>
</form>
@endsection
