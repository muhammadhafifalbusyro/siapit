<ul class="sidebar-menu">
    <li class="{{ Request::routeIs('pengajar.dashboard') ? 'active' : '' }}">
        <a href="{{ route('pengajar.dashboard') }}">
            <i class="fa-solid fa-chart-line"></i> Dashboard
        </a>
    </li>
    <li class="has-submenu {{ Request::routeIs('pengajar.matriculation.*') || Request::routeIs('pengajar.daily-control') ? 'open' : '' }}">
        <div class="submenu-trigger">
            <i class="fa-solid fa-graduation-cap"></i> Matrikulasi
            <i class="fa-solid fa-chevron-down arrow-icon"></i>
        </div>
        <ul class="submenu">
            <li class="{{ Request::routeIs('pengajar.matriculation.daily-control.list') || Request::routeIs('pengajar.daily-control') ? 'active' : '' }}"><a href="{{ route('pengajar.matriculation.daily-control.list') }}"><i class="fa-solid fa-calendar-day"></i> Kontrol Harian</a></li>
            <li class="{{ Request::routeIs('pengajar.matriculation.rapor.list') || Request::routeIs('pengajar.matriculation.rapor.show') ? 'active' : '' }}"><a href="{{ route('pengajar.matriculation.rapor.list') }}"><i class="fa-solid fa-file-invoice"></i> Rapor</a></li>
        </ul>
    </li>
    <li class="has-submenu {{ Request::routeIs('pengajar.education.*') || Request::routeIs('pengajar.education.daily-control') ? 'open' : '' }}">
        <div class="submenu-trigger">
            <i class="fa-solid fa-book-open"></i> Pendidikan
            <i class="fa-solid fa-chevron-down arrow-icon"></i>
        </div>
        <ul class="submenu">
            <li class="{{ Request::routeIs('pengajar.education.daily-control.list') || Request::routeIs('pengajar.education.daily-control') ? 'active' : '' }}"><a href="{{ route('pengajar.education.daily-control.list') }}"><i class="fa-solid fa-calendar-day"></i> Kontrol Harian</a></li>
            <li class="{{ Request::routeIs('pengajar.education.rapor.list') || Request::routeIs('pengajar.education.rapor.show') ? 'active' : '' }}"><a href="{{ route('pengajar.education.rapor.list') }}"><i class="fa-solid fa-file-invoice"></i> Rapor</a></li>
        </ul>
    </li>
    <li class="{{ Request::routeIs('pengajar.career.penilaian') ? 'active' : '' }}">
        <a href="{{ route('pengajar.career.penilaian') }}">
            <i class="fa-solid fa-briefcase"></i> Rapor Karya
        </a>
    </li>
    <li class="{{ Request::routeIs('pengajar.kpi.checklist') ? 'active' : '' }}">
        <a href="{{ route('pengajar.kpi.checklist') }}">
            <i class="fa-solid fa-gauge-high"></i> KPI Saya
        </a>
    </li>
</ul>
