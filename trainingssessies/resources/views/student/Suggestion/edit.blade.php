@extends('layouts.template')

@section('main')


    <div id="page" class="container p-3">
        <div class="card ">
            <div class="card-header bg-dark text-white">
                <h3 class="heading has-text-weight-bold is-size-4">Voorstel bekijken</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="/student/voorstel/{{ $session->id }}">
                    @method('put')
                    @csrf
                    <fieldset disabled="disabled">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="organisation_id">Organisatie(onderwerp)</label>
                                <select id="organisation_id" name="organisation_id"
                                        required
                                        class="form-control">
                                    <option selected="selected" value="">Kies een organisatie(onderwerp)</option>
                                    @foreach($organisations as $organisation)
                                        @if ($session->organisation_id == $organisation->id)
                                            <option value="{{ $organisation->id }}" selected>{{ $organisation->name }}
                                                ({{$session->subject}})
                                            </option>
                                        @else
                                            <option value="{{$organisation->id}}">{{$organisation->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </fieldset>
                    @if($session->status_id == 3 || $session->status_id == 1)
                        <fieldset disabled="disabled">
                            @endif
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="date_time">Datum-tijd sessie</label>
                                    <input type="text"
                                           name="date_time"
                                           disabled
                                           class="form-control"
                                           id="date_time"
                                           value="{{$session->date_time}}">
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
                                    <label for="responsible_docent">Naam van de verantwoordelijke die dit zal
                                        bijwonen</label>
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
                            <div class="form-group">
                                <label for="feedback">Feedback</label>
                                <textarea class="form-control"
                                          disabled
                                          name="feedback"
                                          id="feedback"
                                          rows="3">{{$session->feedback}}</textarea>
                            </div>
                            @if($session->status_id == 3 || $session->status_id == 1)
                        </fieldset>
                    @endif
                    <div class="form-row">
                        <div class="form-group col-md-3 text-center">
                        </div>
                        <div class="form-group  col-md-3 text-center">
                        </div>
                        @if($session->status_id == 3 || $session->status_id == 1)
                            <div class="form-group  col-md-3 text-center">
                            </div>
                        @else
                            <div class="form-group  col-md-3 text-center">
                                <button type="submit" value="2" name="button" data-toggle="tooltip"
                                        title="Via hier kan u het aangepaste voorstel indienen"
                                        class="btn btn-primary w-100">Indienen
                                </button>
                            </div>
                        @endif
                        <div class="form-group  col-md-3 text-center">
                            <a href="{{ url()->previous() }}" class="btn btn-primary w-100" data-toggle="tooltip"
                               title="Via hier kan u terug naar de vorige pagina">Terug</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
