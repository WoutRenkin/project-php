<ul class="nav nav-tabs mb-2 mt-3">
    <li class="nav-item">
        <a class="nav-link {{Request::path()==="admin/teams"?"active":""}}" href="/admin/teams"><i class="fas fa-home"></i> Overzicht</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{Request::path()==="admin/students"?"active":""}}" href="/admin/students"><i class="fas fa-users"></i> Studenten</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{Request::path()==="admin/admins"?"active":""}}" href="/admin/admins"><i class="fas fa-user-shield"></i> Administratoren</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{Request::path()==="admin/voorstel"?"active":""}}" href="/admin/voorstel"><i class="fas fa-file-alt"></i> Voorstellen</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{Request::path()==="admin/sessions"?"active":""}}" href="/admin/sessions"><i class="fas fa-file-alt"></i> Sessies</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{Request::path()==="admin/organisations"?"active":""}}" href="/admin/organisations"><i class="fas fa-globe-europe"></i> Organisaties</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{Request::path()==="admin/academiejaar"?"active":""}}" href="/admin/academiejaar"><i class="fas fa-calendar-times"></i> Academiejaar</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{Request::path()==="admin/documents"?"active":""}}" href="/admin/documents"><i class="fas fa-folder"></i> Documenten</a>
    </li>
</ul >
