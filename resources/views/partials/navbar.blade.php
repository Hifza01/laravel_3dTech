<nav class="navbar navbar-expand">
    <button class="toggler-btn" type="button">
        <i class="lni lni-menu"></i>
    </button>
    <div class="search-container">
    </div>
    <div class="nav-icons">
        <a href="#" data-bs-toggle="modal" data-bs-target="#notificationModal">
            <img src="{{ asset('img/icon2.png') }}" alt="Bell Icon" class="icon">
        </a>
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('img/icon1.png') }}" alt="Profile Icon" class="icon">
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                <li><h6 class="dropdown-header">Profil</h6></li>
                <li>
                    <a class="dropdown-item" href="/edit/{{ Auth::user()->id }}">
                        <img src="{{ asset('img/edit-icon.png') }}" alt="Edit Icon" class="me-2" style="width: 16px; height: 16px;">
                        Edit Profil
                    </a>
                </li>
                @if(Auth::check() && Auth::user()->level === 'admin')
                <li>
                    <a class="dropdown-item" href="{{ route('tambah') }}">
                        <img src="{{ asset('img/add-account-icon.png') }}" alt="Add Account Icon" class="me-2" style="width: 16px; height: 16px;">
                        Tambah Akun
                    </a>
                </li>
                @endif
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <img src="{{ asset('img/logout-icon.png') }}" alt="Logout Icon" class="me-2" style="width: 16px; height: 16px;">
                        Keluar
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
