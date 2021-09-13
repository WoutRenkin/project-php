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
                    <h3 class="heading has-text-weight-bold is-size-4">Gebruiker toevoegen</h3>
                </div>
                <div class="card-body">
                    @if(session('status'))
                        <div>
                            {{session('status')}}
                        </div>
                    @endif
                    <h4 class="card-title">Studenten importeren uit excel</h4>
                    <form method="POST" id="bulkInsert" action="/admin/students/excel">
                        @csrf
                        <div class="row justify-content-center align-items-center">
                            <label for="fileUpload" id="test" class="ml-2 file-upload btn btn-primary shadow mr-auto w-50"><i
                                    class="fa fa-upload mr-2"></i><span>Selecteer een excel bestand</span>
                                <input id="fileUpload" name="file" class="form-control" type="file">
                            </label>
                        </div>
                        <p class="text-danger" id="validation"></p>
                        <div class="row justify-content-center align-items-center">
                                <button type="submit" class="btn btn-primary ml-2 shadow mr-auto w-50" data-toggle="tooltip"
                                        title="Upload bestand">Bestand verzenden <i class="fas fa-paper-plane"></i>
                                </button>
                        </div>
                        <div class="row justify-content-center align-items-center mt-3">
                            <div class="progress flex-fill shadow d-none ml-2" id="progresswrap" style="height: 29px;">
                                <div id="progress"
                                     class=" progress-bar bg-info progress-bar-striped progress-bar-animated"
                                     role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                     style="width: 0%">
                                </div>
                            </div>
                        </div>

                    </form>
                    <hr>
                    <h4 class="card-title">Een gebruiker toevoegen</h4>
                    <form action="/admin/students" method="post">
                        @method('post')
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
                            <label for="r_number">R-nummer:</label>
                            <input type="text" name="r_number" id="r_number"
                                   class="form-control @error('r_number') is-invalid @enderror"
                                   placeholder="R-nummer"
                                   minlength="3"
                                   required
                                   value="{{ old('r_number', $student->r_number) }}">
                            @error('r_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">E-mailadres:</label>
                            <input type="text" name="email" id="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="E-mailadres"
                                   minlength="3"
                                   required
                                   value="{{ old('email', $student->email) }}">
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tel">Telefoonnummer:</label>
                            <input type="tel" name="tel" id="tel"
                                   class="form-control @error('tel') is-invalid @enderror"
                                   placeholder="Telefoonnummer"
                                   value="{{ old('tel', $student->tel) }}">
                            @error('tel')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="user_kind_id">Soort gebruiker</label>
                            <select id="user_kind_id" name="user_kind_id"
                                    required
                                    class="form-control @error('user_kind_id') is-invalid @enderror">

                                <option value="1">Student</option>
                                <option value="2">Administrator</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Opslaan</button>
                    </form>
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Terug</a>
                </div>
                <div class="card-footer bg-dark text-white">
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

        $('#bulkInsert').submit(function (e) {
            e.preventDefault();
            let formData = new FormData(this);

            let filename = $('#fileUpload')[0].value
            if (filename !== "") {
                if (filename.includes(".xlsx") || filename.includes(".xls")) {
                    $('#progresswrap').removeClass('d-none');
                    $('#progresswrap').show();
                    $.ajax({
                        url: '/admin/students/excel',
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
                            window.location.href = "/admin/students"

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
                                $("#validation").text("Er is iets fout gegaan! Wees zeker dat je de juiste template hebt gebruikt!");
                            }
                        }
                    })
                } else {
                    $("#validation").text("Gelieve een excel bestand te selecteren.");
                }
            } else {
                $("#validation").text("Gelieve een bestand te selecteren.");
            }
        });


    </script>
@endsection
