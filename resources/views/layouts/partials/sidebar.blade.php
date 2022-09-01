<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link {{ ($title == 'Dashboard') ? '' : 'collapsed' }}" href="{{ url('home') }}">
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
            </ul>
        </li><!-- End Components Nav -->
        @endif
    </ul>
</aside>