<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Manajemen Paket</title>
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
            background-color: #27ae60;
            color: white;
        }

        .add-btn:hover {
            background-color: #229954;
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

        .pakets-table {
            width: 100%;
            border-collapse: collapse;
        }

        .pakets-table th {
            background-color: #f8f9fa;
            padding: 12px 14px;
            text-align: left;
            font-weight: 600;
            color: #2c3e50;
            border-bottom: 1px solid #e9ecef;
            font-size: 14px;
        }

        .pakets-table td {
            padding: 12px 14px;
            border-bottom: 1px solid #e9ecef;
            font-size: 14px;
            vertical-align: middle;
        }

        .pakets-table tr:hover {
            background-color: #f8fafc;
        }

        .pakets-table tr:last-child td {
            border-bottom: none;
        }

        .paket-image {
            width: 64px;
            height: 64px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #e9ecef;
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
        @include('admin.partials.sidebar', ['activeMenu' => 'menu', 'pendingCount' => $pendingCount ?? 0])
        
        <!-- Main Content -->
        <main class="main-content">
            <header class="page-header">
                <div>
                    <h1>Manajemen Paket</h1>
                    <p>Kelola paket bundle produk BBC</p>
                </div>
                <div class="header-actions">
                    <a href="/paket/create" class="add-btn">
                        <i class="fas fa-plus"></i>
                        Tambah Paket
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
                <h2>Daftar Paket</h2>
                <form method="GET" action="{{ route('paket.index') }}" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap; margin: 0 0 16px;">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / deskripsi..." style="flex:1; min-width: 220px; padding:10px 12px; border:1px solid #e9ecef; border-radius:8px;">
                    <select name="status" style="min-width: 180px; padding:10px 12px; border:1px solid #e9ecef; border-radius:8px;">
                        <option value="">Semua Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    <button type="submit" style="padding:10px 14px; border:none; border-radius:8px; background:#2c3e50; color:#fff; font-weight:700; cursor:pointer;">Terapkan</button>
                    <a href="{{ route('paket.index') }}" style="padding:10px 14px; border:1px solid #e9ecef; border-radius:8px; background:#fff; color:#334155; font-weight:700; text-decoration:none;">Reset</a>
                </form>
                <div class="table-container">
                    <table class="pakets-table">
                        <thead>
                            <tr>
                                <th style="width: 84px;">Gambar</th>
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
                                        @if(!empty($paket->original_price))
                                            <div style="font-size: 12px; color: #6c757d; text-decoration: line-through; font-weight: 600;">Rp {{ number_format((float) $paket->original_price, 0, ',', '.') }}</div>
                                        @endif
                                        <span class="price">Rp {{ number_format((float) $paket->price, 0, ',', '.') }}</span>
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

                <div style="margin-top: 16px;">
                    {{ $pakets->links() }}
                </div>
            </section>
        </main>
    </div>
</body>
</html>
