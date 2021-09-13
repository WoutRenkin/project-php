@extends('layouts.template')

@section('main')


    <div id="wrapper">
        <div id="page" class="container p-3">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3 class="heading has-text-weight-bold is-size-4">Document bewerken: <strong>{{$file->name}}</strong> </h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="/admin/documents/{{$file->id}}">
                        @method('put')
                        @csrf
                        <div class="form-row" hidden>
                            <div class="form-group">
                                <label for="name">Bestand</label>
                                <input type="text" id="name" name="name" value="{{$file->name}}" readonly oninvalid="this.setCustomValidity('Kies een bestand!')" oninput="setCustomValidity('')">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-5">
                                <label for="start_time">Document beschikbaar van </label>
                                <input type="datetime-local"
                                       name="start_time"

                                       class="form-control @error('date') is-invalid @enderror"
                                       id="start_time"
                                       oninvalid="this.setCustomValidity('Vul de datum in!')"
                                       oninput="setCustomValidity('')"
                                       value="{{date('Y-m-d\Th:i', strtotime($file->available_from))}}">
                                @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-5">
                                <label for="end_time">Document beschikbaar tot </label>
                                <input type="datetime-local"
                                       name="end_time"
                                       class="form-control @error('date') is-invalid @enderror"
                                       id="end_time"
                                       oninvalid="this.setCustomValidity('Vul de datum in!')"
                                       oninput="setCustomValidity('')"
                                       value="{{date('Y-m-d\Th:i', strtotime($file->available_until))}}">
                                @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-2 text-center">
                                <button type="submit" class="btn btn-primary " data-toggle="tooltip" title="Slaag het bestand op.">Opslaan</button>
                                <a href="{{ url()->previous() }}" class="btn btn-primary">Terug</a>
                            </div>
                        </div>


                    </form>
                    <div class="card-footer text-muted bg-dark text-white">
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
