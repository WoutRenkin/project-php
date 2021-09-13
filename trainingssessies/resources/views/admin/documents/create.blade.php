@extends('layouts.template')

@section('main')


    <div id="wrapper">
        <div id="page" class="container p-3">
            <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h3 class="heading has-text-weight-bold is-size-4">Document toevoegen </h3>
                    </div>

                <div class="card-body">
                    <form method="POST" action="/admin/documents" enctype="multipart/form-data">
                        @method('post')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input @error('name') is-invalid @enderror" required id="name" name="name" oninvalid="this.setCustomValidity('Kies een bestand!')" oninput="setCustomValidity('')">
                                    <label class="custom-file-label" for="name">Kies een bestand</label>
                                    @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="start_time">Document beschikbaar van</label>
                                <input type="datetime-local"
                                       name="start_time"
                                       class="form-control @error('start_time') is-invalid @enderror"
                                       id="start_time"
                                       value="{{Carbon\Carbon::now()->format('Y-m-d\Th:i')}}"
                                       oninvalid="this.setCustomValidity('Vul de datum in!')"
                                       oninput="setCustomValidity('')"/>
                                @error('start_time')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="end_time">Document beschikbaar tot </label>
                                <input type="datetime-local"
                                       name="end_time"
                                       class="form-control @error('end_time') is-invalid @enderror"
                                       id="end_time"
                                       @if(old('end_time', null) != null)
                                       value="{{ old('end_time') }}"
                                       @else
                                       value="{{Carbon\Carbon::now()->addMonth()->format('Y-m-d\Th:i')}}"
                                       @endif

                                       oninvalid="this.setCustomValidity('Vul de datum in!')"
                                       oninput="setCustomValidity('')"/>
                                @error('end_time')
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
                </div>
                <div class="card-footer text-muted bg-dark text-white"></div>
            </div>
            </div>
        </div>
        </div>
    </div>
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection
