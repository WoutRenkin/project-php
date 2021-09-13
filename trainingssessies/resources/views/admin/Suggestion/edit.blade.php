@extends('layouts.template')

@section('main')


    <div id="page" class="container p-3">
        <div class="card ">
            <div class="card-header bg-dark text-white">
                <h3 class="heading has-text-weight-bold is-size-4">Voorstel bekijken</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="/admin/voorstel/{{ $session->id }}">
                    @method('put')
                    @csrf
                    <fieldset disabled="disabled">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="organisation_id">Organisatie</label>
                                <select id="organisation_id" name="organisation_id"
                                        class="form-control">
                                    @foreach($organisations as $organisation)
                                        @if ($session->organisation_id == $organisation->id)
                                            <option value="{{ $organisation->id }}"
                                                    selected>{{ $organisation->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
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
                    <div class="form-group">
                        <label for="feedback">Feedback</label>
                        <textarea class="form-control"
                                  @if($session->status_id != 1)
                                      disabled
                                  @endif
                                  name="feedback"
                                  id="feedback"
                                  rows="3">{{old('feedback',$session->feedback)}}</textarea>
                    </div>
                    <!-- Buttons naarmate status van voorstel -->
                    <div class="form-row">
                        @if($session->status_id == 1)
                            <div class="form-group col-md-3 text-center">
                                <button type="submit" name="button" value="3" class="btn btn-primary w-100"
                                        data-toggle="tooltip" title="Via hier kan u dit voorstel goedkeuren">goedkeuren
                                </button>
                            </div>
                            <div class="form-group  col-md-3 text-center">
                                <button type="submit" name="button" value="2" class="btn btn-danger w-100"
                                        data-toggle="tooltip" title="Via hier kan u dit voorstel afkeuren">afkeuren
                                </button>
                            </div>
                        @else
                            <div class="form-group  col-md-3 text-center">
                            </div>
                            <div class="form-group  col-md-3 text-center">
                            </div>
                        @endif
                        <div class="form-group  col-md-3 text-center">
                        </div>
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
