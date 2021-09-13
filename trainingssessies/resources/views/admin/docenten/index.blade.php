@extends('layouts.template')

@section('main')

    <div id="page" class="container p-3">
        <div class="card ">
            <div class="card-header bg-dark text-white">
                <h3 class="heading has-text-weight-bold is-size-4">Link voor docenten</h3>
            </div>
            <div class="card-body">
                <div class="input-group mb-3 w-50">
                    <input class="form-control" aria-label="Link voor docenten" readonly="readonly" type="text" id="copy" value="{{Request::getHost()}}/docent/{{$token->token}}">
                    <div class="input-group-append">
                        <button value="copy" class="btn btn-primary" data-toggle="tooltip" title="Klik hier om de link te kopiëren" onclick="copyToClipboard()"><i class="fas fa-copy"></i></button>
                    </div>
                </div>
            <a class="btn btn-primary mt-4" href="/admin/docents/reset">Nieuwe link aanmaken</a>

        </div>
    </div>
    </div>
    <script>
        function copyToClipboard() {
            document.getElementById('copy').select();
            document.execCommand('copy');
        }
    </script>
@endsection

