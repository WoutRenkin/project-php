@extends('layouts.template')

@section('main')

    <div id="page" class="container p-3">
        <div class="card ">
            <div class="card-header bg-dark text-white">
                <h3 class="heading has-text-weight-bold is-size-4">Sessie: {{$session->subject}}</h3>
            </div>
            <div class="card-body">
                    <fieldset disabled="disabled">
                        <h2 class="heading has-text-weight-bold is-size-4 text-left">Informatie organisatie </h2>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="organisation_id">Organisatie</label>
                                <input type="text"
                                       name="subject"
                                       class="form-control"
                                       id="subject"
                                       value="{{$session->organisation->name}}">
                            </div>
                        </div>
                        <h2 class="heading has-text-weight-bold is-size-4 text-left">Informatie sessie </h2>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="subject">Onderwerp</label>
                                <input type="text"
                                       name="subject"
                                       class="form-control"
                                       id="subject"
                                       value="{{$session->subject}}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="date_time">Datum-tijd sessie</label>
                                <input type="text"
                                       name="date_time"
                                       class="form-control"
                                       id="date_time"
                                       value="{{$session->date_time}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="amount_cursisten">Aantal cursisten</label>
                                <input type="number"
                                       class="form-control"
                                       name="amount_cursisten"
                                       id="amount_cursisten"
                                       value="{{$session->amount_cursisten}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="profile_curstist">Profiel van cursist</label>
                                <input type="text"
                                       name="profile_curstist"
                                       class="form-control"
                                       id="profile_curstist"
                                       value="{{$session->profile_curstist}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="goals">Concrete doelstelling</label>
                                <input type="text"
                                       name="goals"
                                       class="form-control"
                                       id="goals"
                                       value="{{$session->goals}}">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="expected_knowledge">Verwachte voorkennis van cursisten</label>
                                <input type="text"
                                       class="form-control"
                                       name="expected_knowledge"
                                       id="expected_knowledge"
                                       value="{{$session->expected_knowledge}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="activities">Overzicht activiteiten die aan bod zullen komen</label>
                            <textarea class="form-control"
                                      name="activities"
                                      id="activities"
                                      rows="5">{{$session->activities}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="infrastructure_materials">Infrastructuur en materiaal dat nodig is</label>
                            <textarea class="form-control"
                                      name="infrastructure_materials"
                                      id="infrastructure_materials"
                                      rows="2">{{$session->infrastructure_materials}}</textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="responsible_docent">Naam verantwoordelijke die dit zal bijwonen</label>
                                <input type="text"
                                       name="responsible_docent"
                                       class="form-control"
                                       id="responsible_docent"
                                       value="{{$session->responsible_docent}}">
                            </div>
                        </div>
                    </fieldset>
            </div>
        </div>


            <hr>

        <div class="card ">
            <div class="card-header bg-dark text-white">
                <h3 class="heading has-text-weight-bold is-size-4">Wilt u deelnemen aan deze sessie?</h3>
            </div>
            <div class="card-body">
<h3>Docenten die deelnemen:</h3>
<ol>
    @if(!$docentSessions->first())
        <p>Nog geen docenten!</p>
    @else
        @foreach ($docentSessions as $docentSession)
            <li>{{$docentSession->first_name}} {{$docentSession->last_name}}</li>
        @endforeach
    @endif
</ol>

<form action="/docent/store/{{$token}}/{{ $session->id }}" method="post">
    @method('post')
    @csrf

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="first_name">Voornaam</label>
                <input type="text" name="first_name" id="first_name"
                       class="form-control @error('last_name') is-invalid @enderror"
                       placeholder="Voornaam"
                       minlength="3"
                       required>
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
                       required>
                @error('last_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
    </div>
        <a href="/docent/{{$token}}" class="btn btn-primary" data-toggle="tooltip"
           title="Via hier kan u terug naar de kalender">Terug</a>
    <button type="submit" class="btn btn-primary float-right">Neem deel</button>

</form>
            </div>
        </div>
    </div>
    </div>
<script>

    $('form').submit(function(e) {
        console.log("xd")
        let first_name = $('#first_name').val();
        let last_name = $('#last_name').val();
        e.preventDefault();
        $.ajax({
            /* the route pointing to the post function */
            url: '/docent/store/{{$token}}/{{ $session->id }}',
            type: 'POST',
            /* send the csrf-token and the input to the controller */
            data: {
                "_token": "{{ csrf_token() }}",
                "first_name": first_name,
                "last_name": last_name,
                dataType: 'json',

            },
            success:function(data){window.location= '/docent/{{$token}}/{{ $session->id }}';
            }
        })
    })



</script>
@endsection

