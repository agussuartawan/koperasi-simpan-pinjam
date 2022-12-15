<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/dashboard">
        <div class="sidebar-brand-icon">
            <img src="{{ asset('img/logo.png') }}" style="width: 50px">
        </div>
        <div class="sidebar-brand-text mx-3">KSP Sehati</div>
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
        <li
            class="nav-item{{ request()->is('loans*') || request()->is('debts') || request()->is('payments') ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('debts') }}">
                <i class="fas fa-fw fa-credit-card"></i>
                <span>Pinjaman</span></a>
        </li>
    @endcan

    @can('akses tunggakan')
        <li class="nav-item{{ request()->is('arrears*') ? ' active' : '' }}">
            <a class="nav-link" href="{{ route('arrears.index') }}">
                <i class="fas fa-fw fa-credit-card"></i>
                <span>Tunggakan</span></a>
        </li>
    @endcan

    @can('akses laporan')
        <li
            class="nav-item{{ request()->is('report-deposit') || request()->is('report-withdrawal') || request()->is('report-loan') || request()->is('report-payment') ? ' active' : '' }}">
            <a class="nav-link{{ request()->is('report-deposit') || request()->is('report-withdrawal') || request()->is('report-loan') || request()->is('report-payment') ? '' : ' collapsed' }}"
                href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                aria-controls="collapseTwo">
                <i class="fas fa-fw fa-flag"></i>
                <span>Laporan</span>
            </a>
            <div id="collapseTwo"
                class="collapse{{ request()->is('report-deposit') || request()->is('report-withdrawal') || request()->is('report-loan') || request()->is('report-payment') ? ' show' : '' }}"
                aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">

                    <a class="collapse-item{{ request()->is('report-deposit') ? ' active' : '' }}"
                        href="{{ route('deposit.report') }}">Laporan Tabungan</a>

                    <a class="collapse-item{{ request()->is('report-withdrawal') ? ' active' : '' }}"
                        href="{{ route('withdrawal.report') }}">Laporan Penarikan</a>

                    <a class="collapse-item{{ request()->is('report-loan') ? ' active' : '' }}"
                        href="{{ route('loan.report') }}">Laporan Pinjaman</a>

                    <a class="collapse-item{{ request()->is('report-payment') ? ' active' : '' }}"
                        href="{{ route('payment.report') }}">Laporan Angsuran</a>
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
