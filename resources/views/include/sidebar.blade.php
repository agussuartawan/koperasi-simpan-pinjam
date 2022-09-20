<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">KP Sehati</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item{{ request()->is('dashboard') ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider mb-0">

    <!-- Nav Item - Pages Collapse Menu -->
    @can('akses user')
        <li class="nav-item{{ request()->is('users*') ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('users.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>User</span></a>
        </li>
    @endcan

    @can('akses klien')
        <li class="nav-item{{ request()->is('clients*') ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('clients.index') }}">
                <i class="fas fa-fw fa-users"></i>
                <span>Klien</span></a>
        </li>
    @endcan

    <!-- Nav Item - Pages Collapse Menu -->
    @can('akses tabungan')
        <li
            class="nav-item{{ request()->is('deposit-balances') || request()->is('deposit*') || request()->is('withdrawal*') ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('deposit.balances') }}">
                <i class="fas fa-fw fa-book"></i>
                <span>Tabungan</span></a>
        </li>
    @endcan

    @can('akses pinjaman')
        <li class="nav-item{{ request()->is('loans*') || request()->is('debts') ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('debts') }}">
                <i class="fas fa-fw fa-credit-card"></i>
                <span>Pinjaman</span></a>
        </li>
    @endcan

    @can('akses tunggakan')
        <li class="nav-item">
            <a class="nav-link" href="charts.html">
                <i class="fas fa-fw fa-credit-card"></i>
                <span>Tunggakan</span></a>
        </li>
    @endcan

    @can('akses laporan')
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-flag"></i>
                <span>Laporan</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="buttons.html">Laporan Tabungan</a>
                    <a class="collapse-item" href="buttons.html">Laporan Penarikan</a>
                    <a class="collapse-item" href="buttons.html">Laporan Pinjaman</a>
                    <a class="collapse-item" href="buttons.html">Laporan Angsuran</a>
                    <a class="collapse-item" href="buttons.html">Laporan Tunggakan</a>
                </div>
            </div>
        </li>
    @endcan

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block mb-0">

    <li class="nav-item">
        <a class="nav-link" href="charts.html"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-fw fa-arrow-left"></i>
            <span>Logout</span>
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
