<ul class="sidebar-menu">
    <li class="{{ Request::routeIs('santri.dashboard') ? 'active' : '' }}">
        <a href="{{ route('santri.dashboard') }}">
            <i class="fa-solid fa-chart-line"></i> Dashboard
        </a>
    </li>
    <li class="has-submenu {{ Request::routeIs('santri.matriculation.*') ? 'open' : '' }}">
        <div class="submenu-trigger">
            <i class="fa-solid fa-graduation-cap"></i> Matrikulasi
            <i class="fa-solid fa-chevron-down arrow-icon"></i>
        </div>
        <ul class="submenu">
            <li class="{{ Request::routeIs('santri.matriculation.daily-control') ? 'active' : '' }}">
                <a href="{{ route('santri.matriculation.daily-control') }}"><i class="fa-solid fa-calendar-day"></i> Kontrol Harian</a>
            </li>
            <li class="{{ Request::routeIs('santri.matriculation.rapor') ? 'active' : '' }}">
                <a href="{{ route('santri.matriculation.rapor') }}"><i class="fa-solid fa-file-invoice"></i> Rapor Saya</a>
            </li>
        </ul>
    </li>
    <li class="has-submenu {{ Request::routeIs('santri.education.*') ? 'open' : '' }}">
        <div class="submenu-trigger">
            <i class="fa-solid fa-book-open"></i> Pendidikan
            <i class="fa-solid fa-chevron-down arrow-icon"></i>
        </div>
        <ul class="submenu">
            <li class="{{ Request::routeIs('santri.education.daily-control') ? 'active' : '' }}">
                <a href="{{ route('santri.education.daily-control') }}"><i class="fa-solid fa-calendar-day"></i> Kontrol Harian</a>
            </li>
            <li class="{{ Request::routeIs('santri.education.rapor') ? 'active' : '' }}">
                <a href="{{ route('santri.education.rapor') }}"><i class="fa-solid fa-file-invoice"></i> Rapor Saya</a>
            </li>
        </ul>
    </li>
    <li class="{{ Request::routeIs('santri.proyek') ? 'active' : '' }}">
        <a href="{{ route('santri.proyek') }}">
            <i class="fa-solid fa-briefcase"></i> Proyek Berkarya
        </a>
    </li>
</ul>

<script>
    document.querySelectorAll('.submenu-trigger').forEach(trigger => {
        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            const parent = trigger.parentElement;
            parent.classList.toggle('open');
        });
    });
</script>
