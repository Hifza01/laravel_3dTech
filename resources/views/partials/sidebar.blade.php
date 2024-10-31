<aside id="sidebar" class="sidebar-toggle">
    <div class="logo">
        <img src="{{ asset('img/logo.png') }}" alt="Logo" />
    </div>
    <ul class="sidebar-nav p-0">                
        <ul class="menu sidebar-nav p-0">
            <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Beranda</a></li>
            <li><a href="{{ route('laporan') }}" class="{{ request()->routeIs('laporan') ? 'active' : '' }}">Laporan</a></li>
            @if(Auth::check() && Auth::user()->level === 'admin')
                <li><a href="{{ route('pengajuan') }}" class="{{ request()->routeIs('pengajuan') ? 'active' : '' }}">Pengajuan</a></li>
            @endif
        </ul>
    </ul>
</aside>