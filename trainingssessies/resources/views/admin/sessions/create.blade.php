@extends('layouts.template')

@section('main')
    <div id="wrapper">
        <div id="page" class="container p-3">
            <div class="card ">
                <div class="card-header bg-dark text-white">
                    <h3 class="heading has-text-weight-bold is-size-4">Sessie toevoegen</h3>
                </div>
                <div class="card-body">
                    <form action="/admin/sessions/{{ $session->id }}" method="post" enctype="multipart/form-data">
                        @method('post')
                        @csrf
                        <div class="form-group">
                            <label for="subject">Onderwerp</label>
                            <input type="text" name="subject" id="subject"
                                   class="form-control @error('subject') is-invalid @enderror"
                                   placeholder="Onderwerp"
                                   required
                                   value="{{ old('subject', $session->subject) }}"
                                   oninvalid="this.setCustomValidity('Geef een onderwerp in!')"
                                   oninput="setCustomValidity('')">
                            @error('subject')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="organisation_id">Organisatie</label>
                            <select id="organisation_id" name="organisation_id"
                                    required
                                    class="form-control @error('organisation_id') is-invalid @enderror" oninvalid="this.setCustomValidity('Selecteer een organisatie!')"
                                    oninput="setCustomValidity('')">
                                <option selected="selected" value="">Kies een Organisatie</option>
                                @foreach($organisations as $organisation)
                                    @if (old('organisation_id', $session->organisation_id) == $organisation->id)
                                        <option value="{{ $organisation->id }}"
                                                selected>{{ $organisation->name }}</option>
                                    @else
                                        <option value="{{$organisation->id}}">{{$organisation->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('organisation_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="row justify-content-center align-items-center">
                            <label for="fileUpload" id="test" class="ml-2 file-upload btn btn-primary shadow mr-auto w-50"><i
                                    class="fa fa-upload mr-2"></i><span>Selecteer een bestand</span>
                                <input id="fileUpload" name="file" class="form-control" type="file">
                            </label>
                        </div>
                        <p class="text-danger" id="validation"></p>
                        <div class="row justify-content-center align-items-center mt-3 mb-3">
                            <div class="progress flex-fill shadow d-none ml-2" id="progresswrap" style="height: 29px;">
                                <div id="progress"
                                     class=" progress-bar bg-info progress-bar-striped progress-bar-animated"
                                     role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                     style="width: 0%">
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary float-right" data-toggle="tooltip"
                                title="Sla sessie op">Opslaan
                        </button>
                    </form>
                    <a href="{{ url()->previous() }}" class="btn btn-primary" data-toggle="tooltip"
                       title="Ga terug naar de vorige pagina.">Terug</a>
                </div>
            </div>
        </div>
    </div>
        <script>
            $('#fileUpload').on('change', function () {
                $('#progresswrap').addClass('d-none');
                if ($('#test span').is(':empty')) {
                    $("#test span").text($('#fileUpload')[0].value.split("\\").pop())

                }
                $("#validation").empty();
                $("#test span").text($('#fileUpload')[0].value.split("\\").pop())
                $(".progress-bar").css("width", "0%");
                $(".progress-bar").html("0%");
                $('#progress').removeClass("bg-success");
                $('#progress').removeClass("bg-danger");

                $('#progress').addClass("bg-info");
            });

            $('form').submit(function (e) {
                e.preventDefault();
                let formData = new FormData(this);

                let filename = $('#fileUpload')[0].value
                if (filename !== "") {
                        $('#progresswrap').removeClass('d-none');
                        $('#progresswrap').show();
                        $.ajax({
                            url: '/admin/sessions/{{ $session->id }}',
                            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                            xhr: function () {
                                let xhr = new window.XMLHttpRequest();
                                xhr.upload.addEventListener("progress", function (evt) {
                                    if (evt.lengthComputable) {
                                        let percentComplete = evt.loaded / evt.total;
                                        $('.percent').html('<b> Uploading -> ' + (Math.round(percentComplete * 100)) + '% </b>');
                                        let test = (Math.round(percentComplete * 100));
                                        let width = test + "%"
                                        $(".progress-bar").css("width", width);
                                        $(".progress-bar").html(width);
                                    }
                                }, false);
                                return xhr;
                            },
                            type: 'POST',
                            contentType: false,
                            processData: false,
                            data: formData,
                            success: function (data) {
                                $(".progress-bar").html("Upload voltooid");

                                $('#progress').removeClass("bg-info");

                                $('#progress').addClass("bg-success");
                                window.location.href = "/admin/sessions"

                            },
                            error: function (e) {
                                $('#progress').removeClass("bg-info");
                                $('#progress').addClass("bg-danger");
                                $(".progress-bar").html("Upload mislukt");
                                if (e.status === 413) {
                                    console.log("Bestand is te groot");

                                    $("#validation").text("Bestand is te groot.");
                                }
                                if (e.status === 500) {
                                    $("#validation").text("Er is iets fout gegaan!");
                                }
                            }
                        })

                } else {
                    $("#validation").text("Gelieve een bestand te selecteren.");
                }
            });


        </script>
@endsection
