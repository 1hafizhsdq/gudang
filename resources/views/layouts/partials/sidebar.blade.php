<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ ($title == 'Dashboard') ? '' : 'collapsed' }}" href="{{ url('home') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->
        @if (Auth::user()->role == 1 || Auth::user()->role == 2)
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Data Master</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="nav-link {{ ($title == 'Pegawai') ? '' : 'collapsed' }}" href="{{ url('pegawai') }}">
                            <i class="bi bi-circle"></i><span>Pegawai</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ ($title == 'Role') ? '' : 'collapsed' }}" href="{{ url('role') }}">
                            <i class="bi bi-circle"></i><span>Role</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ ($title == 'Tipe Pengeluaran') ? '' : 'collapsed' }}" href="{{ url('tipepengeluaran') }}">
                            <i class="bi bi-circle"></i><span>Tipe Pengeluaran</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ ($title == 'Kategori') ? '' : 'collapsed' }}" href="{{ url('kategori') }}">
                            <i class="bi bi-circle"></i><span>Kategori</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Components Nav -->
           
        @endif
        @if (Auth::user()->role == 1)
         <li class="nav-item">
                <a class="nav-link {{ ($title == 'Saldo Perusahaan') ? '' : 'collapsed' }}" href="{{ url('saldo') }}">
                    <i class="ri ri-money-dollar-circle-line"></i>
                    <span>Saldo Perusahaan</span>
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link {{ ($title == 'Project') ? '' : 'collapsed' }}" href="{{ url('project') }}">
                <i class="bi bi-basket"></i>
                <span>Project</span>
            </a>
        </li>
        @if (Auth::user()->role != 2)
        <li class="nav-item">
            <a class="nav-link {{ ($title == 'Transaksi') ? '' : 'collapsed' }}" href="{{ url('transaksi') }}">
                <i class="bi bi-file-earmark-bar-graph-fill"></i>
                <span>Transaksi</span>
            </a>
        </li>
        @endif
        @if (Auth::user()->role == 1 || Auth::user()->role == 2)
        <li class="nav-item">
            <a class="nav-link {{ ($title == 'Antrian Verifikasi') ? '' : 'collapsed' }}" href="{{ url('antrian-verif') }}">
                <i class="bi bi-check2-square"></i>
                <span>Antrian Verifikasi</span>
            </a>
        </li>
        @endif
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#laporan-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-clipboard-data"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="laporan-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                @if (Auth::user()->role == 1 || Auth::user()->role == 2)
                <li>
                    <a class="nav-link {{ ($title == 'Laporan Saldo Perusahaan') ? '' : 'collapsed' }}" href="{{ url('report-saldo') }}">
                        <i class="bi bi-circle"></i><span>Saldo Perusahaan</span>
                    </a>
                </li>
                @endif
                <li>
                    <a class="nav-link {{ ($title == 'Laporan Transaksi Project') ? '' : 'collapsed' }}" href="{{ url('report-project') }}">
                        <i class="bi bi-circle"></i><span>Transaksi Project</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link {{ ($title == 'Laporan Saldo Pegawai') ? '' : 'collapsed' }}" href="{{ (Auth::user()->role == 1 || Auth::user()->role == 2) ? url('saldo-pegawai') : url('/detail-saldo-pegawai').'/'.Auth::user()->id}}">
                        <i class="bi bi-circle"></i><span>Saldo Pegawai</span>
                    </a>
                </li>
            </ul>
        </li>
        @if (Auth::user()->role == 1)
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#invoice-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-card-heading"></i><span>Invoice</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="invoice-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a class="nav-link {{ ($title == 'Buat Invoice') ? '' : 'collapsed' }}"
                            href="{{ url('buat-invoice') }}">
                            <i class="bi bi-circle"></i><span>Buat Invoice</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ ($title == 'Antrian Pembayaran') ? '' : 'collapsed' }}"
                            href="{{ url('antrian-pembayaran') }}">
                            <i class="bi bi-circle"></i><span>Antrian Pembayaran</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ ($title == 'Invoice Masuk') ? '' : 'collapsed' }}"
                            href="{{ url('invoice-masuk') }}">
                            <i class="bi bi-circle"></i><span>Invoice Masuk</span>
                        </a>
                    </li>
                    <li>
                        <a class="nav-link {{ ($title == 'Invoice Keluar') ? '' : 'collapsed' }}"
                            href="{{ url('invoice-keluar') }}">
                            <i class="bi bi-circle"></i><span>Invoice Keluar</span>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
    </ul>
</aside>