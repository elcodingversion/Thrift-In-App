<header class="header">
    <div class="header-title">
        <h1>@yield('page-title', 'Dashboard Admin')</h1>
        <p class="header-subtitle">@yield('page-subtitle', 'Selamat datang kembali, kelola sistem dengan efisien')</p>
    </div>
    <div class="header-profile">
        <div class="profile-avatar">
            {{ strtoupper(substr(auth()->user()->name ?? 'Admin', 0, 2)) }}
        </div>
        <div class="profile-info">
            <span class="profile-name">{{ auth()->user()->name ?? 'Admin User' }}</span>
            <span class="profile-role">{{ auth()->user()->role ?? 'Administrator' }}</span>
        </div>
    </div>
</header>