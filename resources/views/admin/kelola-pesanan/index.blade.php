<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Kelola Pesanan</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

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

        .user-details { flex: 1; }

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
            margin-bottom: 22px;
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

        .layout {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 22px;
            align-items: start;
        }

        .card {
            background: white;
            border-radius: 10px;
            padding: 18px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.08);
        }

        .card h2 {
            font-size: 16px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 12px;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            padding: 10px;
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
            font-size: 12px;
            color: #2c3e50;
            font-weight: 700;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #e9ecef;
            font-size: 12px;
            color: #334155;
        }

        tr:last-child td { border-bottom: none; }

        .status-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
        }

        .status-badge.selesai { background: #d4edda; color: #155724; }
        .status-badge.proses { background: #fff3cd; color: #856404; }
        .status-badge.dikirim { background: #cce5ff; color: #004085; }
        .status-badge.cancel { background: #f8d7da; color: #721c24; }

        .btn-link {
            color: #667eea;
            text-decoration: none;
            font-weight: 700;
            font-size: 12px;
        }

        .btn-link:hover { text-decoration: underline; }

        .quick {
            position: sticky;
            top: 20px;
        }

        .quick .btn {
            width: 100%;
            border: none;
            border-radius: 10px;
            padding: 10px 12px;
            font-weight: 800;
            font-size: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-red { background: #a10c0c; color: #fff; }
        .btn-red:hover { filter: brightness(1.05); transform: translateY(-1px); }

        .btn-green { background: #22c55e; color: #fff; }
        .btn-green:hover { filter: brightness(1.05); transform: translateY(-1px); }

        .stack { display: grid; gap: 12px; }

        @media (max-width: 992px) {
            .layout { grid-template-columns: 1fr; }
            .quick { position: static; }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
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
                <a href="/admin/kelola-pesanan" class="menu-item active">
                    <i class="fas fa-shopping-bag"></i>
                    <span>Pesanan</span>
                </a>
                <a href="/laporan" class="menu-item">
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

        <main class="main-content">
            <header class="page-header">
                <div>
                    <h1>Kelola Pesanan</h1>
                    <p>Ringkasan pesanan terbaru dan history.</p>
                </div>
            </header>

            <div class="layout">
                <div class="stack">
                    <section class="card">
                        <h2>Info Pesanan Terbaru</h2>
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID Pesanan</th>
                                        <th>Pelanggan</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(($recentOrders ?? []) as $o)
                                        @php
                                            $status = (string) ($o->status ?? '');
                                            $label = 'Proses';
                                            $badge = 'proses';

                                            if ($status === 'completed') { $label = 'Selesai'; $badge = 'selesai'; }
                                            elseif ($status === 'shipped') { $label = 'Dikirim'; $badge = 'dikirim'; }
                                            elseif ($status === 'rejected') { $label = 'Cancel'; $badge = 'cancel'; }
                                        @endphp
                                        <tr>
                                            <td>{{ $o->order_id }}</td>
                                            <td>{{ $o->customer_name }}</td>
                                            <td>Rp {{ number_format((float) $o->total_price, 0, ',', '.') }}</td>
                                            <td><span class="status-badge {{ $badge }}">{{ $label }}</span></td>
                                            <td><a class="btn-link" href="{{ route('pesanan.show', $o->id) }}">Detail</a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" style="text-align:center;color:#64748b;">Belum ada pesanan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </section>

                    <section class="card">
                        <h2>History Pesanan</h2>
                        <div class="table-container">
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID Pesanan</th>
                                        <th>Pelanggan</th>
                                        <th>Total</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(($orders ?? []) as $o)
                                        @php
                                            $status = (string) ($o->status ?? '');
                                            $label = 'Proses';
                                            $badge = 'proses';

                                            if ($status === 'completed') { $label = 'Selesai'; $badge = 'selesai'; }
                                            elseif ($status === 'shipped') { $label = 'Dikirim'; $badge = 'dikirim'; }
                                            elseif ($status === 'rejected') { $label = 'Cancel'; $badge = 'cancel'; }
                                        @endphp
                                        <tr>
                                            <td>{{ $o->order_id }}</td>
                                            <td>{{ $o->customer_name }}</td>
                                            <td>Rp {{ number_format((float) $o->total_price, 0, ',', '.') }}</td>
                                            <td><span class="status-badge {{ $badge }}">{{ $label }}</span></td>
                                            <td><a class="btn-link" href="{{ route('pesanan.show', $o->id) }}">Detail</a></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" style="text-align:center;color:#64748b;">Belum ada data.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>

                <aside class="card quick">
                    <h2>Aksi Cepat</h2>
                    <div class="stack">
                        <a class="btn btn-red" href="{{ route('pesanan.index') }}">Lihat Semua Pesanan</a>
                        <a class="btn btn-green" href="{{ route('admin.kelola_pesanan.export') }}">
                            <i class="fas fa-file-excel"></i>
                            Export Laporan
                        </a>
                    </div>
                </aside>
            </div>
        </main>
    </div>
</body>
</html>
