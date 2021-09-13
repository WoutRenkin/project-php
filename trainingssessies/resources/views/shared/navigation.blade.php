<nav class="navbar navbar-expand-md shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            <i class="fas fa-home"></i>
            <b>{{ config('app.name', 'Laravel') }}</b>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <i class="fa fa-bars text-primary fa-lg"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                @endguest
                @auth
                    @if(auth()->user()->user_kind_id == 2)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="fa-stack has-badge" id="mainNavNotifications"
                                  data-count="{{auth()->user()->unreadNotifications()->where('academy_year_id',$academyYear->id )->count()}}">
                            <i class="fa fa-circle fa-stack-2x"></i>
                            <i class="fa fa-bell fa-stack-1x fa-inverse"></i>
                            </span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                               <div class="d-flex flex-column">
                                   <a class="dropdown-item " href="/admin/notifications/selfevaluation">
                                       Zelfreflectie meldingen
                                       <span class="lead ">
                                           <span id="navDropSelfEvaluation" class="badge badge-primary">{{auth()->user()->unreadNotifications()->where('type', 'App\Notifications\EvaluationSend')->where('academy_year_id',$academyYear->id )->count()}}</span>
                                       </span>
                                   </a>
                                   <a class="dropdown-item " href="/admin/notifications/session">
                                       Sessie meldingen
                                       <span class="lead ">
                                           <span id="navDropSession" class="badge badge-primary">{{auth()->user()->unreadNotifications()->where('type', 'App\Notifications\SessionSend')->where('academy_year_id',$academyYear->id )->count()}}</span>
                                       </span>
                                   </a>

                               </div>

                            </div>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="dropdownname nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->first_name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/profile"><i class="fas fa-user-circle"></i> Profiel</a>
                            @if(auth()->user()->user_kind_id == 2)
                                <a class="dropdown-item" href="/admin/docents"><i class="fas fa-link"></i> Link docent</a>
                                <a class="dropdown-item" href="/admin/calendar"><i class="fas fa-calendar-alt"></i> Kalender</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/admin/help"><i class="fas fa-question-circle"></i> Hulp menu</a>
                            @endif
                            @if(auth()->user()->user_kind_id == 1)
                                <a class="dropdown-item" href="/student/documents"><i class="fas fa-file-download"></i> Documenten</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/student/help"><i class="fas fa-question-circle"></i> Hulp menu</a>
                            @endif
                            <a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt"></i> Afmelden</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>


