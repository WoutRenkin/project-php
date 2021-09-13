<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        @if(Request::path() === "/")
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-home"></i> Startpagina</li>
        @else
            <li class="breadcrumb-item"><a href="/home"><i class="fas fa-home"></i> Startpagina </a></li>
        @endif
        @if(Request::path() === "student/teams")
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-users"></i> Teams</li>
        @else
            <li class="breadcrumb-item"><a href="/student/teams"><i class="fas fa-users"></i> Teams </a></li>
        @endif
        @if(Request::path() === "student/calendar")
            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-calendar-alt"></i> Kalender</li>
        @else
            <li class="breadcrumb-item"><a href="/student/calendar"><i class="fas fa-calendar-alt"></i> Kalender </a></li>
        @endif
            @if($user->team_id)
                @if(Request::path() === "student/voorstel")
                    <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-file-alt"></i> Voorstel</li>
                @else
                    <li class="breadcrumb-item"><a href="/student/voorstel"><i class="fas fa-file-alt"></i> Voorstel</a></li>
                @endif
                @if($user->session)
                        @if(Request::path() === "student/selfevaluation")
                            <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-file-pdf"></i> Zelfreflectie indienen</li>
                        @else
                            <li class="breadcrumb-item"><a href="/student/selfevaluation"><i class="fas fa-file-pdf"></i> Zelfreflectie indienen</a></li>
                        @endif
                    @else
                        <li class="breadcrumb-item text-danger"  data-toggle="tooltip" title="Je sessie moet eerst afgelopen zijn.">Zelfreflectie indienen <i class="fas fa-lock" ></i></li>
                    @endif
            @else
                <li class="breadcrumb-item text-danger" data-toggle="tooltip" title="Je moet je eerst inschrijven in een team.">Voorstel <i class="fas fa-lock" ></i></li>
                <li class="breadcrumb-item text-danger"  data-toggle="tooltip" title="Je sessie moet eerst afgelopen zijn.">Zelfreflectie indienen <i class="fas fa-lock" ></i></li>
            @endif

    </ol>
</nav>
