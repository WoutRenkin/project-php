@extends('layouts.template')
@section('main')
    <div id="wrapper">

        <div id="page" class="container p-3">
            <div class="alert alert-danger print-error-msg mt-2 pb-0" style="display:none">
                <ul></ul>
            </div>
            <div class="alert alert-success print-succes-msg mt-2" style="display:none">
            </div>
            <div class="card ">
                <div class="card-header bg-dark text-white">
                    <h3 class="heading has-text-weight-bold is-size-4">Gebruiker wijzigen</h3>
                </div>

                <div class="card-body">
                    <form method="POST" action="/profile/{{$user->id}}">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="first_name">Voornaam</label>
                                <input type="text"
                                       name="first_name"
                                       class="form-control"
                                       id="first_name"
                                       placeholder="Voornaam"
                                       required
                                       title="Vul hier u voornaam in"
                                       value="{{ old('first_name', $user->first_name) }}"
                                       oninvalid="this.setCustomValidity('Geef je voornaam in!')"
                                       oninput="setCustomValidity('')"></div>

                            <div class="form-group col-md-6">
                                <label for="last_name">Achternaam</label>
                                <input type="text"
                                       name="last_name"
                                       id="last_name"
                                       class="form-control"
                                       placeholder="Achternaam"
                                       required
                                       title="Vul hier u achternaam in"
                                       value="{{ old('last_name', $user->last_name) }}"
                                       oninvalid="this.setCustomValidity('Geef je achternaam in!')"
                                       oninput="setCustomValidity('')">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tel">Telefoonnummer</label>
                                <input type="tel"
                                       name="tel"
                                       id="tel"
                                       class="form-control"
                                       placeholder="Telefoonnummer"
                                       required
                                       title="Vul hier je telefoonnummer in."
                                       value="{{ old('tel', $user->tel) }}"
                                       oninvalid="this.setCustomValidity('Geef een geldig telefoon nummer op!')"
                                       oninput="setCustomValidity('')"
                                >

                            </div>

                            <div class="form-group col-md-6">
                                <label for="OldPassword">Huidig wachtwoord</label>
                                <input type="password"
                                       name="OldPassword"
                                       id="OldPassword"
                                       class="form-control"
                                       placeholder="Huidig wachtwoord"
                                       required
                                       title="Vul hier je huidige wachtwoord in"
                                       oninvalid="this.setCustomValidity('Geef je huidig wachtwoord in!')"
                                       oninput="setCustomValidity('')">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="NewPassword">Nieuw wachtwoord</label>
                                <input type="password"
                                       name="NewPassword"
                                       class="form-control"
                                       id="NewPassword"
                                       placeholder="Nieuw wachtwoord"
                                       title="Vul hier je nieuw wachtwoord in"
                                       oninvalid="this.setCustomValidity('Geef je nieuw wachtwoord in!')"
                                       oninput="setCustomValidity('')">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="ConfirmPassword">Bevestig wachtwoord</label>
                                <input type="password"
                                       name="ConfirmPassword"
                                       id="ConfirmPassword"
                                       class="form-control"
                                       placeholder="Bevestig wachtwoord"
                                       title="Bevestig je niew wachtwoord"
                                       oninvalid="this.setCustomValidity('Bevestig je niew wachtwoord')"
                                       oninput="setCustomValidity('')">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right" data-toggle="tooltip"
                                title="Sla je bewerkte gegevens op!">Opslaan
                        </button>
                    </form>
                    <a href="{{ url()->previous() }}" class="btn btn-primary" data-toggle="tooltip"
                       title="Ga terug naar de vorige pagina.">Terug</a>
                </div>
            </div>
        </div>
    </div>
    <script>

        //doorsturen data via ajax
        $('form').submit(function (e) {
            $(".print-error-msg").css('display', 'none');
            $(".print-succes-msg").css('display', 'none');
            let formData = new FormData(this);
            e.preventDefault();
            $.ajax({
                url: '/profile/{{$user->id}}',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                contentType: false,
                processData: false,
                data: formData,
                success: function (data) {
                    if ($.isEmptyObject(data.error)) {
                        printSuccesMsg(data.success);
                    } else {
                        printErrorMsg(data.error);
                    }
                }
            })
            //error messages vanboven
            function printErrorMsg(msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display', 'block');
                $.each(msg, function (key, value) {
                    $(".print-error-msg").find("ul").append('<li>' + value + '</li>');
                })
            }
            //succes message vanboven
            function printSuccesMsg(msg) {
                $(".print-succes-msg").css('display', 'block');
                $(".print-succes-msg").html(msg);
                $(".dropdownname").html(document.getElementById('first_name').value + " ");
            }
        });
    </script>
@endsection
