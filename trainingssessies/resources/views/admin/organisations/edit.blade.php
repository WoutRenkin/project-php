@extends('layouts.template')

@section('main')


    <div id="wrapper">

        <div id="page" class="container p-3">
            <div class="card ">
                <div class="card-header bg-dark text-white">
                    <h3 class="heading has-text-weight-bold is-size-4">Organisatie wijzigen</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="/admin/organisations/{{$organisation->id}}">
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">Organisatie naam</label>
                                <input type="text"
                                       name="name"
                                       class="form-control @error('name') is-invalid @enderror"
                                       id="name"
                                       placeholder="Organisatie naam"
                                       required
                                       title="Vul hier de naam van de organisatie in."
                                       value="{{$organisation->name}}"
                                       oninvalid="this.setCustomValidity('Geef een organisatie naam in!')"
                                       oninput="setCustomValidity('')">
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="contact_person">Contactpersoon</label>
                                <input type="text"
                                       name="contact_person"
                                       class="form-control @error('contact_person') is-invalid @enderror"
                                       id="contact_person"
                                       placeholder="Contactpersoon"
                                       required
                                       title="Vul hier de naam van de contactpersoon in."
                                       value="{{$organisation->contact_person}}"
                                       oninvalid="this.setCustomValidity('Geef een contactpersoon in!')"
                                       oninput="setCustomValidity('')">
                                @error('contact_person')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="email">E-mail</label>
                                <input type="email"
                                       name="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       id="email"
                                       placeholder="E-mailadres"
                                       required
                                       title="Vul hier het e-mailadres van de contactpersoon in."
                                       value="{{$organisation->email}}"
                                       oninvalid="this.setCustomValidity('Geef een geldig e-mailadres in, voorbeeld: test@test.be.')"
                                       oninput="setCustomValidity('')">
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="tel_number">Telefoonnummer</label>
                                <input type="tel"
                                       name="tel_number"
                                       class="form-control @error('tel_number') is-invalid @enderror"
                                       id="tel_number"
                                       placeholder="Telefoonnummer"
                                       required
                                       title="Vul hier de telefoonnummer van de organisatie in."
                                       value="{{$organisation->tel_number}}"
                                       oninvalid="this.setCustomValidity('Geef een telefoonnummer in!')"
                                       oninput="setCustomValidity('')">
                                @error('tel_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="place">Stad</label>
                                <input type="text"
                                       name="place"
                                       class="form-control @error('place') is-invalid @enderror"
                                       id="place"
                                       placeholder="Stad"
                                       required
                                       title="Vul hier een dorp of stad in waar de organisatie zich bevindt."
                                       value="{{$organisation->place}}"
                                       oninvalid="this.setCustomValidity('Geef een stad of dorp in!')"
                                       oninput="setCustomValidity('')">
                                @error('place')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6">
                                <label for="address">Adres</label>
                                <input type="text"
                                       name="address"
                                       class="form-control @error('address') is-invalid @enderror"
                                       id="address"
                                       placeholder="Straatnaam + huisnummer"
                                       required
                                       title="Vul hier het adres van de organisatie in."
                                       value="{{$organisation->address}}"
                                       oninvalid="this.setCustomValidity('Geef het adres van de organisatie in!')"
                                       oninput="setCustomValidity('')">
                                @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description">Korte beschrijving</label>
                            <textarea class="form-control"
                                      name="description"
                                      id="description"
                                      title="Vul hier een korte beschrijving van de organisatie in."
                                      rows="3">{{$organisation->description}}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Opslaan</button>
                    </form>
                    <a href="{{ url()->previous() }}" class="btn btn-primary">Terug</a>
                </div>
                <div class="card-footer bg-dark text-white">
                    @if($organisation->updated_at)
                        Laatst geupdate op: {{$organisation->updated_at}}
                    @else
                        Nog nooit geupdate
                    @endif
                </div>
                </div>


        </div>
    </div>
@endsection
