<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Manajemen Menu</title>
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

        .logout-btn, .add-btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
        }

        .logout-btn {
            background-color: #dc3545;
            color: white;
        }

        .logout-btn:hover {
            background-color: #c82333;
            transform: translateY(-1px);
        }

        .add-btn {
            background-color: #e74c3c;
            color: white;
        }

        .add-btn:hover {
            background-color: #c0392b;
            transform: translateY(-1px);
        }

        /* Table Section */
        .content-section {
            background: white;
            border-radius: 8px;
            padding: 20px;
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

        .menus-table {
            width: 100%;
            border-collapse: collapse;
        }

        .menus-table th {
            background-color: #f8f9fa;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #2c3e50;
            border-bottom: 1px solid #e9ecef;
            font-size: 14px;
        }

        .menus-table td {
            padding: 12px;
            border-bottom: 1px solid #e9ecef;
            font-size: 14px;
        }

        .menus-table tr:hover {
            background-color: #f8fafc;
        }

        .menus-table tr:last-child td {
            border-bottom: none;
        }

        .menu-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-badge.active {
            background-color: #d4edda;
            color: #155724;
        }

        .status-badge.inactive {
            background-color: #f8d7da;
            color: #721c24;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn-sm {
            padding: 4px 8px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 4px;
            text-decoration: none;
        }

        .btn-edit {
            background-color: #667eea;
            color: white;
        }

        .btn-edit:hover {
            background-color: #5a6fd8;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .empty-state {
            text-align: center;
            padding: 40px;
            color: #6c757d;
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 20px;
            color: #ccc;
        }

        .alert {
            padding: 12px 20px;
            border-radius: 6px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .price {
            font-weight: 600;
            color: #27ae60;
        }

        .category-badge {
            display: inline-block;
            background-color: #f0f0f0;
            color: #555;
            padding: 3px 10px;
            border-radius: 4px;
            font-size: 12px;
        }

        /* Paket Section */
        .paket-section {
            margin-top: 30px;
        }

        .paket-section h2 {
            font-size: 20px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .paket-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .add-paket-btn {
            background-color: #27ae60;
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

        .add-paket-btn:hover {
            background-color: #229954;
            transform: translateY(-1px);
        }

        .pakets-table {
            width: 100%;
            border-collapse: collapse;
        }

        .pakets-table th {
            background-color: #f8f9fa;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #2c3e50;
            border-bottom: 1px solid #e9ecef;
            font-size: 14px;
        }

        .pakets-table td {
            padding: 12px;
            border-bottom: 1px solid #e9ecef;
            font-size: 14px;
        }

        .pakets-table tr:hover {
            background-color: #f8fafc;
        }

        .pakets-table tr:last-child td {
            border-bottom: none;
        }

        .paket-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 6px;
        }

        .portion-badge {
            display: inline-block;
            background-color: #e3f2fd;
            color: #1976d2;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo">
                <img src="logo.jpeg" alt="Logo">
                <span>ADMIN BBC</span>
            </div>
            
            <nav class="menu">
                <a href="/admin/dashboard" class="menu-item">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="/menu" class="menu-item active">
                    <i class="fas fa-utensils"></i>
                    <span>Menu Management</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-chart-line"></i>
                    <span>Laporan Penjualan</span>
                </a>
                <a href="#" class="menu-item">
                    <i class="fas fa-comment"></i>
                    <span>Testimoni</span>
                </a>
                <a href="/pesanan" class="menu-item">
                    <i class="fas fa-shopping-bag"></i>
                    <span>Pesanan</span>
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
                    <h1>Menu Management</h1>
                    <p>Kelola menu produk BBC</p>
                </div>
                <div class="header-actions">
                    <a href="/menu/create" class="add-btn">
                        <i class="fas fa-plus"></i>
                        Tambah Menu
                    </a>
                    <button class="logout-btn">
                        <i class="fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </div>
            </header>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <section class="content-section">
                <h2>Daftar Menu</h2>
                <div class="table-container">
                    <table class="menus-table">
                        <thead>
                            <tr>
                                <th style="width: 50px;">Gambar</th>
                                <th>Nama Menu</th>
                                <th>Deskripsi</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th style="width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($menus as $menu)
                                <tr>
                                    <td>
                                        <img src="{{ $menu->image }}" alt="{{ $menu->name }}" class="menu-image">
                                    </td>
                                    <td>
                                        <strong>{{ $menu->name }}</strong>
                                    </td>
                                    <td>
                                        {{ Str::limit($menu->description, 30) }}
                                    </td>
                                    <td>
                                        <span class="category-badge">{{ $menu->category }}</span>
                                    </td>
                                    <td>
                                        <span class="price">Rp {{ number_format($menu->price, 0, ',', '.') }}</span>
                                    </td>
                                    <td>
                                        <span class="status-badge {{ $menu->status }}">
                                            {{ $menu->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="/menu/{{ $menu->id }}/edit" class="btn-sm btn-edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn-sm btn-delete" onclick="if(confirm('Hapus menu ini?')) window.location.href='/menu/{{ $menu->id }}/delete'">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="empty-state">
                                            <i class="fas fa-inbox"></i>
                                            <p>Tidak ada menu</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>

            <!-- Paket Section -->
            <section class="content-section paket-section">
                <div class="paket-header">
                    <h2>Daftar Paket</h2>
                    <a href="/paket/create" class="add-paket-btn">
                        <i class="fas fa-plus"></i>
                        Tambah Paket
                    </a>
                </div>
                <div class="table-container">
                    <table class="pakets-table">
                        <thead>
                            <tr>
                                <th style="width: 50px;">Gambar</th>
                                <th>Nama Paket</th>
                                <th>Deskripsi</th>
                                <th>Porsi</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th style="width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pakets as $paket)
                                <tr>
                                    <td>
                                        <img src="{{ $paket->image }}" alt="{{ $paket->name }}" class="paket-image">
                                    </td>
                                    <td>
                                        <strong>{{ $paket->name }}</strong>
                                    </td>
                                    <td>
                                        {{ Str::limit($paket->description, 30) }}
                                    </td>
                                    <td>
                                        <span class="portion-badge">{{ $paket->portion }} Orang</span>
                                    </td>
                                    <td>
                                        <span class="price">Rp {{ number_format($paket->price, 0, ',', '.') }}</span>
                                    </td>
                                    <td>
                                        <span class="status-badge {{ $paket->status }}">
                                            {{ $paket->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="/paket/{{ $paket->id }}/edit" class="btn-sm btn-edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn-sm btn-delete" onclick="if(confirm('Hapus paket ini?')) window.location.href='/paket/{{ $paket->id }}/delete'">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="empty-state">
                                            <i class="fas fa-inbox"></i>
                                            <p>Tidak ada paket</p>
                                        </div>
                                    </td>
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
