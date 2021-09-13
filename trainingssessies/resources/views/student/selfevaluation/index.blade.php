@extends('layouts.template')

@section('main')
    @include('shared.navstudents')

    <div id="wrapper">
        <div id="page" class="container">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Zelfreflectieverslag indienen
                </div>
                <div class="card-body">
                    <h5 class="card-title">Proficiat {{Auth()->user()->first_name}} met het voltooien van je
                        trainingssessie!</h5>
                    <p class="card-text">
                        Het laatste wat je nog moet doen is het uploaden van jou reflectieverslag!
                        Hieronder kan je jou reflectieverslag uploaden.
                    </p>
                    <p id="text">Je bestand zal opgeslagen worden als
                        <b>zelfreflectieverslag_{{Auth()->user()->r_number}}.pdf</b>.</p>
                    <form method="POST" action="/student/selfevaluation">
                        @csrf
                        <div class="row justify-content-center align-items-center">
                            <label for="fileUpload" id="test" class="file-upload btn btn-primary shadow flex-fill"><i
                                    class="fa fa-upload mr-2"></i><span>Selecteer een bestand</span>
                                <input id="fileUpload" name="file" class="form-control" type="file">
                            </label>
                        </div>
                        <div class="justify-content-center align-items-center row" id="uploadDownload"></div>
                        <p class="text-danger" id="validation"></p>
                        <div class="row justify-content-center align-items-center">
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary m-1 shadow" data-toggle="tooltip"
                                        title="Upload bestand">Bestand verzenden <i class="fas fa-paper-plane"></i>
                                </button>
                                <div class="progress flex-fill shadow" id="progresswrap" style="height: 29px;">
                                    <div id="progress"
                                         class=" progress-bar bg-info progress-bar-striped progress-bar-animated"
                                         role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                         style="width: 0%">test
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        let userAcademyYearFile = "{{$userAcademyYear->self_evaluation_file}}";
        let userAcademyYearId = "{{$userAcademyYear->id}}"


        function checkFileUploaded() {
            if (userAcademyYearFile != "") {
                $('.card-title').html("Je verslag is succesvol ingediend!");
                $('#text').html(`Je bestand is opgeslagen als <b>${userAcademyYearFile}</b>, als er iets fout is gegaan kan je je reflectieverslag opnieuw indienen.`);
                $('#uploadDownload').html(`<a class="btn btn-info shadow flex-fill" href="/student/selfevaluation/${userAcademyYearId}/download"><i class="fa fa-download" aria-hidden="true"></i> Download ${userAcademyYearFile} </a>`);
                $('.card-text').hide();
            }
        }

        $(function () {
            $('#progresswrap').hide();
            checkFileUploaded();
        })
        $('#fileUpload').on('change', function () {
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
                if (filename.includes(".pdf")) {
                    $('#progresswrap').show();
                    $.ajax({
                        url: '/student/selfevaluation',
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
                            userAcademyYearFile = data.title
                            checkFileUploaded();

                        },
                        error: function (e) {
                            if (e.status === 413) {
                                console.log("Bestand is te groot");
                                $('#progress').removeClass("bg-info");
                                $('#progress').addClass("bg-danger");
                                $(".progress-bar").html("Upload mislukt");
                                $("#validation").text("Bestand is te groot.");
                            }
                        }
                    })
                } else {
                    $("#validation").text("Gelieve een pdf bestand te selecteren.");
                }
            } else {
                $("#validation").text("Gelieve een bestand te selecteren.");
            }
        });


    </script>

@endsection


