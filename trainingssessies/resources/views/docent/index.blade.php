@extends('layouts.template')

@section('main')

    <div id="wrapper" class="mt-4">
        <div id="page" class="container">

            <div class="card">
                <div class="card-header bg-dark text-white">
                </div>
                <div class="card-body">
                    <div id="calendar"></div>
                </div>
                <div class="card-footer bg-dark text-white">
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function () {
            var events = [];
            @if($session !== null)
            @foreach($session as $item)
            events.push(
                {
                    title: "{{$item->subject}}",
                    start: "{{$item->date_time}}",
                    url: "{{$token}}/{{$item->id}}"
                }
            )
            @endforeach

            @endif
            Trainingssessies.AddCalender(events);
        })
    </script>
@endsection
