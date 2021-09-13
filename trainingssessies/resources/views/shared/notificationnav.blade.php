<nav class="nav nav-pills justify-content-center mt-3">
        <a class="nav-link h5 shadow {{Request::path()==="admin/notifications/selfevaluation"?"active":""}}" href="/admin/notifications/selfevaluation">
        <span class="fa-stack has-badge" id="selfevaluationNav"
              data-count="{{auth()->user()->unreadNotifications()->where('type', 'App\Notifications\EvaluationSend')->count()}}">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-bell fa-stack-1x fa-inverse {{Request::path()==="admin/notifications/selfevaluation"?"text-primary":""}}"></i>
        </span> Zelfreflectie verslagen
        </a>
    <a class="nav-link h5 shadow {{Request::path()==="admin/notifications/session"?"active":""}}" href="/admin/notifications/session">
        <span class="fa-stack has-badge" id="sessionNav"
              data-count="{{auth()->user()->unreadNotifications()->where('type', 'App\Notifications\SessionSend')->where('academy_year_id',$academyYear->id )->count()}}">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-bell fa-stack-1x fa-inverse {{Request::path()==="admin/notifications/session"?"text-primary":""}}"></i>
        </span> Sessie aanvragen
    </a>
</nav>
<hr>
