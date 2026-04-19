{{-- resources/views/layouts/navigation-customer.blade.php --}}

<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('katalog.index') }}">
            Sistem Klaim
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('katalog.index') ? 'active' : '' }}" href="{{ route('katalog.index') }}">Katalog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customer.klaim.index') ? 'active' : '' }}" href="{{ route('customer.klaim.index') }}">Riwayat Klaim</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn btn-success text-white ms-2" href="{{ route('customer.klaim.create') }}">Ajukan Klaim Baru</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                {{-- Dropdown Profil User --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user me-1"></i> {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profil Saya</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Keluar</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>