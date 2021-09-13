@extends('layouts.template')

@section('main')


    <div id="page" class="container p-3">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <h3 class="heading has-text-weight-bold is-size-4">Voorstel indienen</h3>
            </div>
            <div class="card-body">
                <!-- Begin form -->
                <form method="POST" action="/student/voorstel">
                @method('POST')
                @csrf
                <!-- Organisatie -->
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="organisation_id">Organisatie(onderwerp)</label>
                            <select id="organisation_id" name="organisation_id"
                                    required
                                    oninvalid="this.setCustomValidity('Kies een organisatie(onderwerp)!')"
                                    oninput="setCustomValidity('')"
                                    class="form-control @error('organisation_id') is-invalid @enderror">
                                <option selected="selected" value="">Kies een organisatie(onderwerp)</option>
                                @foreach($sessions as $ses)
                                    @foreach($organisations as $organisation)
                                        @if($ses->organisation_id == $organisation->id)
                                            @if (old('organisation_id', $session->organisation_id) == $organisation->id)
                                                <option value="{{ $organisation->id }}"
                                                        selected>{{ $organisation->name }}({{$ses->subject}})
                                                </option>
                                            @else
                                                <option value="{{$organisation->id}}">{{$organisation->name}}
                                                    ({{$ses->subject}})
                                                </option>
                                            @endif
                                        @endif
                                    @endforeach
                                @endforeach
                            </select>
                            @error('organisation_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Sessie -->
                    <!-- oninvalid="this.setCustomValidity('Vul de datum in!')" -> Custom validatie bericht -->

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="date_time">Datum-tijd sessie</label>
                            <input type="datetime-local"
                                   name="date_time"
                                   required
                                   class="form-control @error('date_time') is-invalid @enderror"
                                   id="date_time"
                                   oninvalid="this.setCustomValidity('Vul de datum in!')"
                                   oninput="setCustomValidity('')"
                                   value="{{ old('date_time', $session->date_time) }}">
                            @error('date_time')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="amount_cursisten">Aantal cursisten</label>
                            <input type="number"
                                   required
                                   name="amount_cursisten"
                                   class="form-control @error('amount_cursisten') is-invalid @enderror"
                                   id="amount_cursisten"
                                   placeholder="bv: 10"
                                   oninvalid="this.setCustomValidity('Geef het aantal cursisten in!')"
                                   oninput="setCustomValidity('')"
                                   value="{{ old('amount_cursisten', $session->amount_cursisten) }}">
                            @error('amount_cursisten')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="profile_cursist">Profiel van cursist</label>
                            <input type="text"
                                   required
                                   name="profile_cursist"
                                   oninvalid="this.setCustomValidity('Vul het profiel van de cursisten in!')"
                                   oninput="setCustomValidity('')"
                                   class="form-control @error('profile_cursist') is-invalid @enderror"
                                   id="profile_cursist"
                                   placeholder="bv: Leerlingen middelbaar"
                                   value="{{ old('profile_cursist', $session->profile_curstist) }}">
                            @error('profile_cursist')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="goals">Concrete doelstelling</label>
                            <input type="text"
                                   name="goals"
                                   required
                                   oninvalid="this.setCustomValidity('Vul de concrete doelstelling(en) in!')"
                                   oninput="setCustomValidity('')"
                                   class="form-control @error('doel') is-invalid @enderror"
                                   id="goals"
                                   placeholder="bv: Kinderen informeren over de gevaren van social media."

                                   value="{{ old('goals', $session->goals) }}">
                            @error('doel')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="expected_knowledge">Verwachte voorkennis van cursisten</label>
                            <input type="text"
                                   required
                                   name="expected_knowledge"
                                   oninvalid="this.setCustomValidity('Vul de verwachte voorkennis in!')"
                                   oninput="setCustomValidity('')"
                                   class="form-control @error('expected_knowledge') is-invalid @enderror"
                                   id="expected_knowledge"
                                   placeholder="bv: Geen voorkennis nodig."

                                   value="{{ old('expected_knowledge', $session->expected_knowledge) }}">
                            @error('expected_knowledge')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="activities">Overzicht activiteiten die aan bod zullen komen</label>
                        <textarea class="form-control"
                                  name="activities"
                                  required
                                  placeholder="Een fictief voorbeeld:&#10;-Wij stellen on kort voor aan de leerlingen.&#10;-Wij demonsteren waarom dat social media gevaarlijk kan zijn.&#10;-..."
                                  oninvalid="this.setCustomValidity('Vul de activieteiten in!')"
                                  oninput="setCustomValidity('')"
                                  id="activities"
                                  rows="5">{{ old('activities', $session->activities) }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="infrastructure_materials">Infrastructuur en materiaal dat nodig is</label>
                        <textarea class="form-control"
                                  name="infrastructure_materials"
                                  required
                                  oninvalid="this.setCustomValidity('Vul de nodige materialen in!')"
                                  oninput="setCustomValidity('')"
                                  id="infrastructure_materials"
                                  placeholder="bv: Laptop, HMDI kabel, webcam, ..."
                                  rows="2">{{ old('infrastructure_materials', $session->infrastructure_materials) }}</textarea>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="responsible_docent">Naam van de verantwoordelijke die dit zal bijwonen</label>
                            <input type="text"
                                   required
                                   name="responsible_docent"
                                   oninvalid="this.setCustomValidity('Vul de verantwoordelijke in die dit zal bijwonen.')"
                                   oninput="setCustomValidity('')"
                                   class="form-control @error('responsible_docent') is-invalid @enderror"
                                   id="responsible_docent"
                                   placeholder="bv: Bart Portier"
                                   value="{{ old('responsible_docent', $session->responsible_docent) }}">
                            @error('responsible_docent')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12 text-center">
                            <button type="submit" name="button" class="btn btn-primary col-md-3 mb-5"
                                    data-toggle="tooltip" title="Dien je voorstel in.">Verzenden
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
