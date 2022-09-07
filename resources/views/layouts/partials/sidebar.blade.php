<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ ($title == 'Dashboard') ? '' : 'collapsed' }}" href="{{ url('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>
        @if (Auth::user()->role == 1 || Auth::user()->role == 2)
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-menu-button-wide"></i><span>Data Master</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li>
                    <a class="nav-link {{ ($title == 'Kategori') ? '' : 'collapsed' }}" href="{{ url('kategori') }}">
                        <i class="bi bi-circle"></i><span>Kategori</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link {{ ($title == 'Satuan') ? '' : 'collapsed' }}" href="{{ url('satuan') }}">
                        <i class="bi bi-circle"></i><span>Satuan</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link {{ ($title == 'Supplier') ? '' : 'collapsed' }}" href="{{ url('supplier') }}">
                        <i class="bi bi-circle"></i><span>Supplier</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link {{ ($title == 'Project') ? '' : 'collapsed' }}" href="{{ url('project') }}">
                        <i class="bi bi-circle"></i><span>Project</span>
                    </a>
                </li>
                <li>
                    <a class="nav-link {{ ($title == 'Barang') ? '' : 'collapsed' }}" href="{{ url('barang') }}">
                        <i class="bi bi-circle"></i><span>Barang</span>
                    </a>
                </li>
            </ul>
        </li><!-- End Components Nav -->
        @endif
        <li class="nav-item">
            <a class="nav-link {{ ($title == 'Transaksi Stok') ? '' : 'collapsed' }}" href="{{ url('tr-stok') }}">
                <i class="bi bi-cart"></i>
                <span>Transaksi Stok</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ ($title == 'Cek Stok') ? '' : 'collapsed' }}" href="{{ url('cek-stok') }}">
                <i class="bi bi-search"></i>
                <span>Cek Stok</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ ($title == 'Stok Masuk') ? '' : 'collapsed' }}" href="{{ url('stok-masuk') }}">
                <i class="bi bi-arrows-angle-contract"></i>
                <span>Stok Masuk</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ ($title == 'Stok Keluar') ? '' : 'collapsed' }}" href="{{ url('cek-stok') }}">
                <i class="bi bi-arrows-angle-expand"></i>
                <span>Stok Keluar</span>
            </a>
        </li>
    </ul>
</aside>