@php
    $activeMenu = $activeMenu ?? '';
    $pendingCount = $pendingCount ?? 0;

    $adminUser = auth('admin')->user();
    $adminName = $adminUser->name ?? $adminUser->username ?? 'Admin';
    $adminEmail = $adminUser->email ?? '';

    $menuTitles = [
        'dashboard' => 'Dashboard',
        'menu' => 'Menu Management',
        'pesanan' => 'Pesanan',
        'laporan' => 'Laporan Penjualan',
        'testimoni' => 'Testimoni',
        'admin' => 'Kelola Admin',
    ];
    $activeTitle = $menuTitles[$activeMenu] ?? 'Dashboard';
@endphp

<aside class="sidebar">
    <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 16px;gap:10px;">
        <img src="{{ asset('logo.jpeg') }}" alt="Logo" onerror="this.onerror=null;this.style.display='none';" style="display:block;width:56px;height:56px;object-fit:contain;flex:0 0 auto;">
        <div style="font-weight:800;color:#2c3e50;font-size:14px;line-height:1.1;text-align:left;flex:1;padding-left:6px;">
            ADMIN BBC
        </div>
    </div>
    <hr style="border:0;border-top:1px solid #e9ecef;margin:0;">

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
        <div style="width:44px;height:44px;border-radius:999px;background:#e74c3c;color:#fff;display:flex;align-items:center;justify-content:center;font-weight:800;letter-spacing:0.5px;flex:0 0 auto;">
            BC
        </div>
        <div class="user-details">
            <div class="user-name">{{ $adminName }}</div>
        </div>
    </div>
</aside>
