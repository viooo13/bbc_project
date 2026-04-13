@php
    $activeMenu = $activeMenu ?? '';
    $pendingCount = $pendingCount ?? 0;
@endphp

<aside class="sidebar">
    <div class="logo">
        <img src="{{ asset('logo.jpeg') }}" alt="Logo">
        <span>ADMIN BBC</span>
    </div>

    <nav class="menu">
        <a href="/admin/dashboard" class="menu-item {{ $activeMenu === 'dashboard' ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
        <a href="/admin/menu-management" class="menu-item {{ $activeMenu === 'menu' ? 'active' : '' }}">
            <i class="fas fa-utensils"></i>
            <span>Menu Management</span>
        </a>
        <a href="/admin/kelola-pesanan" class="menu-item {{ $activeMenu === 'pesanan' ? 'active' : '' }}">
            <i class="fas fa-shopping-bag"></i>
            <span>Pesanan</span>
            @if((int) $pendingCount > 0)
                <span style="margin-left:auto;background:#e74c3c;color:#fff;padding:2px 8px;border-radius:999px;font-size:12px;font-weight:700;">{{ $pendingCount }}</span>
            @endif
        </a>
        <a href="/laporan" class="menu-item {{ $activeMenu === 'laporan' ? 'active' : '' }}">
            <i class="fas fa-chart-line"></i>
            <span>Laporan Penjualan</span>
        </a>
        <a href="{{ route('admin.testimoni.index') }}" class="menu-item {{ $activeMenu === 'testimoni' ? 'active' : '' }}">
            <i class="fas fa-comment"></i>
            <span>Testimoni</span>
        </a>
        <a href="/kelola-admin" class="menu-item {{ $activeMenu === 'admin' ? 'active' : '' }}">
            <i class="fas fa-user-cog"></i>
            <span>Kelola Admin</span>
        </a>
    </nav>

    <div class="user-info">
        <img src="https://via.placeholder.com/44x44?text=?" alt="User Avatar">
        <div class="user-details">
            <div class="user-name">Admin User</div>
            <div class="user-email">admin@bbc.com</div>
        </div>
    </div>
</aside>
