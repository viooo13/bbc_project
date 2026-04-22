<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --primary: #8B0000;
            --primary-soft: #a70f0f;
            --secondary: #DAA520;
            --cream: #ffffff;
            --surface: #fffaf4;
            --surface-2: #ffffff;
            --text-main: #2D3748;
            --text-soft: #6b7280;
            --line: #eadcc8;
            --shadow-soft: 0 10px 24px rgba(139, 0, 0, 0.08);
            --shadow-card: 0 12px 30px rgba(45, 55, 72, 0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--cream);
            color: var(--text-main);
            overflow-x: hidden;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, #fffaf4 0%, #fff5e9 100%);
            color: var(--text-main);
            display: flex;
            flex-direction: column;
            box-shadow: var(--shadow-soft);
            position: fixed;
            height: 100vh;
            z-index: 1000;
            border-right: 1px solid var(--line);
        }

        .logo {
            display: flex;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid var(--line);
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
            color: var(--text-main);
        }

        .menu {
            flex: 1;
            padding: 16px 0;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            color: #7a5a3b;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            margin: 2px 8px;
            border-radius: 10px;
        }

        .menu-item:hover {
            background-color: #fff1de;
            color: var(--primary);
        }

        .menu-item.active {
            background: linear-gradient(90deg, var(--primary) 0%, var(--primary-soft) 100%);
            color: white;
            border-left-color: var(--secondary);
            box-shadow: 0 8px 20px rgba(139, 0, 0, 0.18);
        }

        .menu-item i {
            width: 20px;
            margin-right: 12px;
        }

        .user-info {
            display: flex;
            align-items: center;
            padding: 20px;
            border-top: 1px solid var(--line);
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
            color: var(--text-main);
        }

        .user-email {
            font-size: 12px;
            color: var(--text-soft);
        }

        /* Main Content Styles */
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 30px;
            background: transparent;
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
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0;
        }

        .page-header p {
            color: #8a6a4c;
            font-size: 16px;
            margin-bottom: 0;
        }

        .logout-btn {
            background: linear-gradient(90deg, var(--primary) 0%, var(--primary-soft) 100%);
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 20px rgba(139, 0, 0, 0.18);
        }

        .logout-btn:hover {
            filter: brightness(1.03);
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
            background: var(--surface-2);
            border-radius: 16px;
            padding: 20px;
            box-shadow: var(--shadow-card);
            display: flex;
            align-items: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid var(--line);
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 32px rgba(45, 55, 72, 0.12);
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
            background-color: #12825f;
            border: none;
            color: #fff;
        }

        .stat-card:nth-child(2) .stat-icon {
            background-color: #7b2cbf;
            border: none;
            color: #fff;
        }

        .stat-card:nth-child(3) .stat-icon {
            background-color: var(--primary);
            border: none;
            color: #fff;
        }

        .stat-card:nth-child(4) .stat-icon {
            background-color: #b07a0f;
            border: none;
            color: #fff;
        }

        .stat-content {
            flex: 1;
        }

        .stat-change {
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .stat-change.positive {
            color: #10b981;
        }

        .stat-value {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
            color: var(--text-main);
        }

        .stat-label {
            font-size: 11px;
            color: #8a6a4c;
            text-transform: lowercase;
        }

        /* Orders Section */
        .orders-section {
            background: var(--surface-2);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: var(--shadow-card);
            border: 1px solid var(--line);
        }

        .orders-wrapper {
            display: flex;
            gap: 30px;
            align-items: flex-start;
        }

        .orders-section {
            flex: 1;
        }

        .quick-actions {
            width: 300px;
        }

        .section-header {
            display: flex;
            justify-content: between;
            align-items: center;
            margin-bottom: 24px;
        }

        .orders-section h2 {
            font-size: 20px;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .table-container {
            overflow-x: auto;
        }

        .orders-table {
            width: 100%;
            border-collapse: collapse;
        }

        .orders-table th {
            background-color: #fff3e4;
            padding: 10px;
            text-align: left;
            font-weight: 600;
            color: var(--text-main);
            border-bottom: 1px solid var(--line);
            font-size: 14px;
        }

        .orders-table td {
            padding: 10px;
            border-bottom: 1px solid var(--line);
            font-size: 14px;
        }

        .orders-table tr:hover {
            background-color: #fffaf2;
        }

        .orders-table tr:last-child td {
            border-bottom: none;
        }

        .status-badge {
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-badge.completed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-badge.processing {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-badge.shipped {
            background-color: #cce5ff;
            color: #004085;
        }

        .btn-detail {
            background-color: var(--primary);
            color: white;
            border: none;
            border: none;
            padding: 4px 8px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 11px;
            transition: background-color 0.3s ease;
        }

        .btn-detail:hover {
            background-color: var(--primary-soft);
        }

        /* Quick Actions Section */
        .quick-actions {
            background: var(--surface-2);
            border-radius: 16px;
            padding: 20px;
            box-shadow: var(--shadow-card);
            border: 1px solid var(--line);
        }

        .quick-actions h2 {
            font-size: 20px;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .action-buttons {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(90deg, var(--primary) 0%, var(--primary-soft) 100%);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            filter: brightness(1.03);
            transform: translateY(-2px);
        }

        .btn-warning {
            background-color: var(--secondary);
            color: white;
            border: none;
        }

        .btn-warning:hover {
            background-color: #c99312;
            transform: translateY(-2px);
        }

        .chart-section {
            background: var(--surface-2);
            border-radius: 16px;
            padding: 20px;
            box-shadow: var(--shadow-card);
            border: 1px solid var(--line);
            margin-bottom: 22px;
        }

        .chart-section h2 {
            font-size: 20px;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 14px;
        }

        .chart-box {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 14px;
        }

        .chart-box canvas {
            width: 100% !important;
            height: 320px !important;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('admin.partials.sidebar', ['activeMenu' => 'dashboard', 'pendingCount' => $pendingCount ?? 0])

        <!-- Main Content -->
        <main class="main-content">
            <header class="page-header">
                <div>
                    <h1>Dashboard</h1>
                    <p>Selamat datang di Admin Panel BBC</p>
                </div>
                <form id="logoutForm" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <button class="logout-btn" onclick="document.getElementById('logoutForm').submit();">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
            </header>

            <!-- Stats Cards -->
            <section class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i>
                            +10.5%
                        </div>
                        <div class="stat-value">Rp {{ number_format((float) ($totalRevenue ?? 0), 0, ',', '.') }}</div>
                        <div class="stat-label">Total Pendapatan</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i>
                            +10.5%
                        </div>
                        <div class="stat-value">{{ isset($totalOrders) ? number_format((int) $totalOrders) : '0' }}</div>
                        <div class="stat-label">Total Pesanan</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i>
                            +10.5%
                        </div>
                        <div class="stat-value">{{ isset($totalCustomers) ? number_format((int) $totalCustomers) : '0' }}</div>
                        <div class="stat-label">Total Pelanggan</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i>
                            +10.5%
                        </div>
                        <div class="stat-value">{{ isset($totalMenus) ? number_format((int) $totalMenus) : '0' }}</div>
                        <div class="stat-label">Total Menu</div>
                    </div>
                </div>
            </section>

            <section class="chart-section">
                <h2>Grafik Penjualan 6 Bulan Terakhir</h2>
                <div class="chart-box">
                    <canvas id="salesChart"></canvas>
                </div>
            </section>

            <div class="orders-wrapper">
                <!-- KIRI -->
                <section class="orders-section">
                    <div class="section-header">
                        <h2>Info Pesanan</h2>
                    </div>
                    <div class="table-container">
                        <table class="orders-table">
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
                                @if(isset($latestOrders) && $latestOrders->count() > 0)
                                    @foreach($latestOrders as $order)
                                        <tr>
                                            <td>{{ $order->order_id }}</td>
                                            <td>{{ $order->customer_name }}</td>
                                            <td>Rp {{ number_format((float) $order->total_price, 0, ',', '.') }}</td>
                                            <td>
                                                @php
                                                    $badgeClass = 'processing';
                                                    if ($order->status === 'completed') $badgeClass = 'completed';
                                                    if ($order->status === 'shipped') $badgeClass = 'shipped';
                                                @endphp
                                                <span class="status-badge {{ $badgeClass }}">{{ strtoupper($order->status) }}</span>
                                            </td>
                                            <td><a href="/pesanan/{{ $order->id }}" class="btn-detail" style="text-decoration:none;display:inline-block;">Detail</a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" style="text-align:center;color:#64748b;">Belum ada pesanan.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- KANAN -->
                <section class="quick-actions">
                    <h2>Aksi Cepat</h2>
                    <div class="action-buttons">
                        <button class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Tambah Menu Baru
                        </button>
                        <button class="btn btn-warning">
                            <i class="fas fa-download"></i>
                            Export Laporan
                        </button>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <script>
        const salesLabels = @json($monthlySalesLabels ?? []);
        const salesData = @json($monthlySalesData ?? []);

        const salesCtx = document.getElementById('salesChart');
        if (salesCtx) {
            new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: salesLabels,
                    datasets: [{
                        label: 'Penjualan',
                        data: salesData,
                        borderColor: '#8B0000',
                        backgroundColor: 'rgba(139, 0, 0, 0.12)',
                        fill: true,
                        borderWidth: 3,
                        tension: 0.35,
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        pointBackgroundColor: '#DAA520'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: true }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: (value) => 'Rp ' + Number(value).toLocaleString('id-ID')
                            }
                        }
                    }
                }
            });
        }
    </script>
</body>
</html>