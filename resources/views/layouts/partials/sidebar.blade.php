<aside class="sidebar">
    <div class="sidebar-logo">
        <img src="{{ asset('images/logo.png') }}" alt="Thrift-In Logo" style="width: 42px; height: 42px; object-fit: contain;">
        <span class="logo-text">Admin Panel</span>
    </div>
    
    <ul class="nav-menu">
        <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24">
                    <rect x="3" y="3" width="7" height="7" rx="1"/>
                    <rect x="14" y="3" width="7" height="7" rx="1"/>
                    <rect x="3" y="14" width="7" height="7" rx="1"/>
                    <rect x="14" y="14" width="7" height="7" rx="1"/>
                </svg>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.kategoris.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24">
                    <path d="M4 7h16M4 12h16M4 17h16"/>
                </svg>
                <span>Kelola Kategori</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.items.index') }}" class="nav-link {{ request()->routeIs('admin.items.*') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24">
                    <rect x="2" y="5" width="20" height="14" rx="2"/>
                    <path d="M2 10h20"/>
                </svg>
                <span>Kelola Item</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.klaims.index') }}" class="nav-link {{ request()->routeIs('admin.klaims.*') ? 'active' : '' }}">
                <svg class="nav-icon" viewBox="0 0 24 24">
                    <path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2"/>
                    <rect x="9" y="3" width="6" height="4" rx="1"/>
                    <path d="M9 12l2 2 4-4"/>
                </svg>
                <span>Data Klaim Masuk</span>
            </a>
        </li>
    </ul>
</aside>