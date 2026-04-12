<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Laporan Penjualan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #334155;
            overflow-x: hidden;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background: white;
            color: #333;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            position: fixed;
            height: 100vh;
            z-index: 1000;
            border-right: 1px solid #e9ecef;
        }

        .logo {
            display: flex;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #e9ecef;
        }

        .logo img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
            border-radius: 8px;
            object-fit: cover;
        }

        .logo span {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
        }

        .menu {
            flex: 1;
            padding: 16px 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: #6c757d;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .menu-item:hover {
            background-color: #f8f9fa;
            color: #2c3e50;
        }

        .menu-item.active {
            background-color: #e74c3c;
            color: white;
            border-left-color: #e74c3c;
        }

        .menu-item i {
            width: 20px;
            margin-right: 12px;
        }

        .user-info {
            display: flex;
            align-items: center;
            padding: 20px;
            border-top: 1px solid #e9ecef;
        }

        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 12px;
        }

        .user-details {
            flex: 1;
        }

        .user-name {
            font-weight: 600;
            margin-bottom: 2px;
            font-size: 14px;
            color: #2c3e50;
        }

        .user-email {
            font-size: 12px;
            color: #6c757d;
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 30px;
            background-color: #f5f5f5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .page-header {
            margin-bottom: 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 0;
        }

        .page-header p {
            color: #64748b;
            font-size: 16px;
            margin-bottom: 0;
        }

        .header-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .export-btn {
            background-color: #22c55e;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .export-btn:hover {
            filter: brightness(1.05);
            transform: translateY(-1px);
        }

        .logout-btn {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #c82333;
            transform: translateY(-1px);
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 20px;
            color: white;
        }

        .stat-card:nth-child(1) .stat-icon {
            background-color: #27ae60;
        }

        .stat-card:nth-child(2) .stat-icon {
            background-color: #8e44ad;
        }

        .stat-card:nth-child(3) .stat-icon {
            background-color: #e67e22;
        }

        .stat-card:nth-child(4) .stat-icon {
            background-color: #3498db;
        }

        .stat-content {
            flex: 1;
        }

        .stat-value {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #2c3e50;
        }

        .stat-label {
            font-size: 14px;
            color: #7f8c8d;
        }

        /* Tables */
        .content-section {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .content-section h2 {
            font-size: 20px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .table-container {
            overflow-x: auto;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th {
            background-color: #f8f9fa;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #2c3e50;
            border-bottom: 1px solid #e9ecef;
            font-size: 14px;
        }

        .data-table td {
            padding: 12px;
            border-bottom: 1px solid #e9ecef;
            font-size: 14px;
        }

        .data-table tr:hover {
            background-color: #f8fafc;
        }

        .data-table tr:last-child td {
            border-bottom: none;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <img src="{{ asset('logo.jpeg') }}" alt="Logo">
                <span>ADMIN BBC</span>
            </div>
            
            <nav class="menu">
                <a href="/admin/dashboard" class="menu-item">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="/admin/menu-management" class="menu-item">
                    <i class="fas fa-utensils"></i>
                    <span>Menu Management</span>
                </a>
                <a href="/admin/kelola-pesanan" class="menu-item">
                    <i class="fas fa-shopping-bag"></i>
                    <span>Pesanan</span>
                </a>
                <a href="/admin/laporan" class="menu-item active">
                    <i class="fas fa-chart-line"></i>
                    <span>Laporan Penjualan</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-comment"></i>
                    <span>Testimoni</span>
                </a>
                <a href="/kelola-admin" class="menu-item">
                    <i class="fas fa-user-cog"></i>
                    <span>Kelola Admin</span>
                </a>
            </nav>
            
            <div class="user-info">
                <img src="https://via.placeholder.com/44x44?text=👤" alt="User Avatar">
                <div class="user-details">
                    <div class="user-name">Admin User</div>
                    <div class="user-email">admin@bbc.com</div>
                </div>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="main-content">
            <header class="page-header">
                <div>
                    <h1>Laporan Penjualan</h1>
                    <p>Laporan penjualan dari tahun ke tahun</p>
                </div>
                <div class="header-actions">
                    <a class="export-btn" href="{{ route('admin.laporan.export', request()->query()) }}">
                        <i class="fas fa-file-excel"></i>
                        Export Excel
                    </a>
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <button class="logout-btn" onclick="document.getElementById('logoutForm').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </div>
            </header>

            <!-- Yearly Sales Report -->
            <section class="content-section">
                <h2>Laporan Penjualan per Tahun</h2>
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Tahun</th>
                                <th class="text-center">Jumlah Pesanan</th>
                                <th class="text-right">Total Penjualan</th>
                                <th class="text-right">Penjualan Paket Bakso</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($yearlySales as $sale)
                                <tr>
                                    <td>{{ $sale->year }}</td>
                                    <td class="text-center">{{ $sale->orders }}</td>
                                    <td class="text-right">Rp {{ number_format($sale->total, 0, ',', '.') }}</td>
                                    <td class="text-right">Rp {{ number_format($yearlyPaketSales[$sale->year] ?? 0, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Belum ada data penjualan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <section class="content-section">
                <h2>History Penjualan</h2>
                <form method="GET" action="{{ route('admin.laporan.index') }}" style="margin-bottom: 14px; display: flex; gap: 10px; flex-wrap: wrap; align-items: end;">
                    <div style="display:flex;flex-direction:column;gap:6px;min-width:220px;">
                        <label for="q" style="font-size:12px;font-weight:700;color:#2c3e50;">Search</label>
                        <input id="q" name="q" value="{{ request('q') }}" placeholder="Cari ID pesanan / nama pelanggan" style="padding:10px 12px;border:1px solid #e2e8f0;border-radius:8px;font-size:13px;" />
                    </div>
                    <div style="display:flex;flex-direction:column;gap:6px;">
                        <label for="from" style="font-size:12px;font-weight:700;color:#2c3e50;">Dari Tanggal</label>
                        <input id="from" type="date" name="from" value="{{ request('from') }}" style="padding:10px 12px;border:1px solid #e2e8f0;border-radius:8px;font-size:13px;" />
                    </div>
                    <div style="display:flex;flex-direction:column;gap:6px;">
                        <label for="to" style="font-size:12px;font-weight:700;color:#2c3e50;">Sampai Tanggal</label>
                        <input id="to" type="date" name="to" value="{{ request('to') }}" style="padding:10px 12px;border:1px solid #e2e8f0;border-radius:8px;font-size:13px;" />
                    </div>
                    <div style="display:flex;gap:8px;align-items:center;">
                        <button type="submit" class="export-btn" style="background-color:#3498db;">
                            <i class="fas fa-filter"></i>
                            Filter
                        </button>
                        <a href="{{ route('admin.laporan.index') }}" class="export-btn" style="background-color:#64748b;">
                            <i class="fas fa-rotate-left"></i>
                            Reset
                        </a>
                    </div>
                </form>
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>ID Pesanan</th>
                                <th>Tanggal</th>
                                <th>Pelanggan</th>
                                <th class="text-center">Qty</th>
                                <th class="text-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(($completedOrders ?? []) as $o)
                                @php
                                    $items = is_array($o->items ?? null) ? $o->items : [];
                                    $qty = 0;
                                    foreach ($items as $it) { $qty += (int) ($it['quantity'] ?? 0); }
                                @endphp
                                <tr>
                                    <td>{{ $o->order_id }}</td>
                                    <td>{{ optional($o->created_at)->format('d M Y') }}</td>
                                    <td>{{ $o->customer_name }}</td>
                                    <td class="text-center">{{ $qty }}</td>
                                    <td class="text-right">Rp {{ number_format((float) $o->total_price, 0, ',', '.') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data penjualan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </main>
    </div>
</body>
</html>