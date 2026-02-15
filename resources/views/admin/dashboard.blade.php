<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - BBC Admin</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 200px;
            background: white;
            border-right: 1px solid #e5e5e5;
            padding: 20px 0;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            overflow-y: auto;
        }

        .sidebar-logo {
            padding: 0 20px 30px;
            text-align: center;
            border-bottom: 1px solid #eee;
            margin-bottom: 20px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: #b91c1c;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 24px;
            margin: 0 auto 10px;
            font-weight: bold;
        }

        .sidebar-logo h2 {
            font-size: 16px;
            color: #1f2937;
            margin-bottom: 2px;
        }

        .sidebar-logo p {
            font-size: 12px;
            color: #9ca3af;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            padding: 0;
            margin: 0;
        }

        .sidebar-menu a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: #6b7280;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 14px;
        }

        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: #fecaca;
            color: #b91c1c;
            border-left: 3px solid #b91c1c;
            padding-left: 17px;
        }

        .sidebar-menu a.active {
            background: #fee2e2;
            font-weight: 600;
        }

        .sidebar-menu svg {
            width: 20px;
            height: 20px;
            stroke: currentColor;
            stroke-width: 2;
        }

        .sidebar-footer {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            padding: 20px;
            border-top: 1px solid #eee;
            text-align: center;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            background: #f9fafb;
            border-radius: 8px;
            font-size: 13px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: #b91c1c;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 18px;
            font-weight: bold;
        }

        .user-text {
            text-align: left;
        }

        .user-text p:first-child {
            font-weight: 600;
            color: #1f2937;
        }

        .user-text p:last-child {
            color: #9ca3af;
            font-size: 12px;
        }

        .logout-btn {
            display: block;
            width: 100%;
            margin-top: 12px;
            padding: 10px;
            background: #b91c1c;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
            text-decoration: none;
        }

        .logout-btn:hover {
            background: #8b1414;
            box-shadow: 0 2px 8px rgba(185, 28, 28, 0.3);
        }

        /* Main Content */
        .main-content {
            margin-left: 200px;
            flex: 1;
            padding: 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: white;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            font-size: 28px;
            color: #1f2937;
            font-weight: 600;
        }

        .header-actions {
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .header-btn {
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
            color: #6b7280;
            transition: color 0.3s ease;
        }

        .header-btn:hover {
            color: #1f2937;
        }

        .badge-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #dc2626;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-left: 4px solid #b91c1c;
            transition: all 0.3s ease;
        }

        .stat-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .stat-card.waiting {
            border-left-color: #f59e0b;
        }

        .stat-card.completed {
            border-left-color: #10b981;
        }

        .stat-card.processing {
            border-left-color: #3b82f6;
        }

        .stat-card.ready {
            border-left-color: #8b5cf6;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 15px;
        }

        .stat-card.waiting .stat-icon {
            background: #fef3c7;
        }

        .stat-card.completed .stat-icon {
            background: #d1fae5;
        }

        .stat-card.processing .stat-icon {
            background: #dbeafe;
        }

        .stat-card.ready .stat-icon {
            background: #ede9fe;
        }

        .stat-label {
            font-size: 12px;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .stat-number {
            font-size: 32px;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 12px;
        }

        .stat-link {
            color: #3b82f6;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: color 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        .stat-link:hover {
            color: #1d4ed8;
        }

        /* Section Title */
        .section-title {
            font-size: 16px;
            font-weight: 600;
            color: #f97316;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .sidebar {
                width: 170px;
            }

            .main-content {
                margin-left: 170px;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                border-right: none;
                border-bottom: 1px solid #e5e5e5;
                padding: 15px 0;
            }

            .main-content {
                margin-left: 0;
            }

            .sidebar-menu {
                display: flex;
                flex-wrap: wrap;
                margin-bottom: 50px;
            }

            .sidebar-menu li {
                flex: 0 0 50%;
            }

            .sidebar-footer {
                position: relative;
                bottom: auto;
                padding: 10px;
                margin-top: 10px;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                text-align: center;
                gap: 15px;
            }

            .header h1 {
                font-size: 24px;
            }
        }

        @media (max-width: 480px) {
            .main-content {
                padding: 15px;
            }

            .stat-number {
                font-size: 24px;
            }

            .sidebar-logo h2 {
                font-size: 14px;
            }

            .sidebar-menu a {
                font-size: 12px;
                padding: 10px 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-icon">🍽️</div>
            <h2>BBC Admin</h2>
            <p>Bakso Bunderan Ciomas</p>
        </div>

        <ul class="sidebar-menu">
            <li>
                <a href="#" class="active">
                    <svg fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-3m0 0l7-4 7 4M5 9v10a1 1 0 001 1h12a1 1 0 001-1V9m-9 11l4-4m0 0l4 4m-4-4v4"></path>
                    </svg>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="#">
                    <svg fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m0 0h6m-6-6h-6m0 0H3"></path>
                    </svg>
                    Menu Management
                </a>
            </li>
            <li>
                <a href="#">
                    <svg fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Lokasi Cabang
                </a>
            </li>
            <li>
                <a href="#">
                    <svg fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Laporan Penjualan
                </a>
            </li>
            <li>
                <a href="#">
                    <svg fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    Testimoni
                </a>
            </li>
            <li>
                <a href="#">
                    <svg fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2v-9a2 2 0 012-2z"></path>
                    </svg>
                    Pesanan
                </a>
            </li>
            <li>
                <a href="#">
                    <svg fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 8.048M12 4.354a4 4 0 100 8.048m0-8.048A4.354 4.354 0 8012 16.354m0 0a4 4 0 110-8.048"></path>
                    </svg>
                    Kelola Admin
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">AD</div>
                <div class="user-text">
                    <p>Admin User</p>
                    <p>admin@bbc.com</p>
                </div>
            </div>
            <form action="{{ route('logout') }}" method="POST" style="width: 100%; margin: 0;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="header">
            <h1>Dashboard</h1>
            <div class="header-actions">
                <button class="header-btn" style="position: relative;">
                    🔔
                    <span class="badge-count">21</span>
                </button>
                <button class="header-btn">⚙️</button>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <!-- Menunggu -->
            <div class="stat-card waiting">
                <div class="stat-icon">⏳</div>
                <div class="stat-label">Menunggu</div>
                <div class="stat-number">0</div>
                <div class="stat-label">Pesanan Menunggu</div>
                <a href="#" class="stat-link">Lihat Detail →</a>
            </div>

            <!-- Diselesaikan -->
            <div class="stat-card completed">
                <div class="stat-icon">✅</div>
                <div class="stat-label">Diselesaikan</div>
                <div class="stat-number">6</div>
                <div class="stat-label">Pesanan Diselesaikan</div>
                <a href="#" class="stat-link">Lihat Detail →</a>
            </div>

            <!-- Diproses -->
            <div class="stat-card processing">
                <div class="stat-icon">🚀</div>
                <div class="stat-label">Diproses</div>
                <div class="stat-number">3</div>
                <div class="stat-label">Pesanan Diproses</div>
                <a href="#" class="stat-link">Lihat Detail →</a>
            </div>

            <!-- Selesai -->
            <div class="stat-card ready">
                <div class="stat-icon">🎉</div>
                <div class="stat-label">Selesai</div>
                <div class="stat-number">0</div>
                <div class="stat-label">Pesanan Selesai</div>
                <a href="#" class="stat-link">Lihat Detail →</a>
            </div>
        </div>

        <div class="section-title">Aktif</div>
    </main>
</body>
</html>
