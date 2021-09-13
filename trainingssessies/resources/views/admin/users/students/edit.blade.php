@extends('layouts.template')

@section('main')
    <div id="wrapper">
        <div id="page" class="container p-3">
            @if(Session::has('message'))
                <div id="sessionMessage"
                     class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</div>
            @endif
            <div class="card ">
                <div class="card-header bg-dark text-white">
                    <h3 class="heading has-text-weight-bold is-size-4">Gebruiker wijzigen</h3>
                </div>
                <div class="card-body">
                    <form action="/admin/students/{{ $student->id }}" method="post">
                        @method('put')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="first_name">Voornaam</label>
                                <input type="text" name="first_name" id="first_name"
                                       class="form-control @error('last_name') is-invalid @enderror"
                                       placeholder="Voornaam"
                                       minlength="3"
                                       required
                                       value="{{ old('first_name', $student->first_name) }}">
                                @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="last_name">Achternaam</label>
                                <input type="text" name="last_name" id="last_name"
                                       class="form-control @error('last_name') is-invalid @enderror"
                                       placeholder="Achternaam"
                                       minlength="3"
                                       required
                                       value="{{ old('last_name', $student->last_name) }}">
                                @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="r_number">r-nummer:</label>
                            <input type="text" name="r_number" id="r_number"
                                   class="form-control @error('r_number') is-invalid @enderror"
                                   placeholder="r-nummer"
                                   minlength="3"
                                   required
                                   value="{{ old('r_number', $student->r_number) }}">
                            @error('r_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">email:</label>
                            <input type="text" name="email" id="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="email"
                                   minlength="3"
                                   required
                                   value="{{ old('email', $student->email) }}">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tel">Telefoon:</label>
                            <input type="tel" name="tel" id="tel"
                                   class="form-control @error('tel') is-invalid @enderror"
                                   placeholder="tel"
                                   value="{{ old('tel', $student->tel) }}">
                            @error('tel')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Opslaan</button>
                        @if($student->active == 1)
                            <button type="submit" formaction="/admin/students/{{ $student->id }}/deactivate"
                                    class="btn btn-danger float-right mr-3">Deactiveren
                            </button>
                        @else
                            <button type="submit" formaction="/admin/students/{{ $student->id }}/activate"
                                    class="btn btn-success float-right mr-3">Activeren
                            </button>
                        @endif
                    </form>
                    @if($student->user_kind_id == 2)
                        <a href="/admin/admins" class="btn btn-primary">Terug</a>
                    @else
                        <a href="/admin/students" class="btn btn-primary">Terug</a>
                    @endif
                </div>
                <div class="card-footer bg-dark text-white">
                    @if($student->updated_at)
                        Laatst geupdate op: {{$student->updated_at}}
                    @else
                        Nog nooit geupdate
                    @endif
                </div>
            </div>

        </div>
    </div>
@endsection
