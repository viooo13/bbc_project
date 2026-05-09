<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Kelola Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
            --line: #e2e8f0;
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

        /* Main Content Styles */
        .main-content {
            flex: 1;
            margin-left: 272px;
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
            font-size: 28px;
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 0;
        }

        .page-header p {
            color: var(--text-soft);
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
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .logout-btn {
            background: linear-gradient(90deg, var(--primary) 0%, var(--primary-soft) 100%);
            color: white;
            box-shadow: 0 8px 20px rgba(139, 0, 0, 0.18);
        }

        .logout-btn:hover {
            filter: brightness(1.03);
            transform: translateY(-1px);
        }

        .add-btn {
            background: linear-gradient(90deg, var(--primary) 0%, var(--primary-soft) 100%);
            color: white;
            box-shadow: 0 8px 20px rgba(139, 0, 0, 0.18);
        }

        .add-btn:hover {
            filter: brightness(1.03);
            transform: translateY(-1px);
        }

        /* Table Section */
        .content-section {
            background: var(--surface-2);
            border-radius: 16px;
            padding: 24px;
            box-shadow: var(--shadow-card);
            border: 1px solid var(--line);
            margin-bottom: 24px;
        }

        .content-section h2 {
            font-size: 20px;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .table-container {
            overflow-x: auto;
        }

        .admin-table {
            width: 100%;
            border-collapse: collapse;
        }

        .admin-table th {
            background-color: #fff3e4;
            padding: 14px;
            text-align: left;
            font-weight: 600;
            color: var(--text-main);
            border-bottom: 2px solid var(--line);
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .admin-table td {
            padding: 14px;
            border-bottom: 1px solid var(--line);
            font-size: 14px;
            color: var(--text-main);
        }

        .admin-table tr:hover {
            background-color: #fffaf2;
        }

        .admin-table tr:last-child td {
            border-bottom: none;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .status-badge.active {
            background-color: #d4edda;
            color: #155724;
        }

        .status-badge.inactive {
            background-color: #f8d7da;
            color: #721c24;
        }

        .role-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .role-badge.owner {
            background-color: #fff3cd;
            color: #856404;
        }

        .role-badge.admin {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        .action-buttons {
            display: flex;
            gap: 6px;
        }

        .btn-sm {
            padding: 5px 10px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 4px;
            text-decoration: none;
        }

        .btn-sm:hover {
            transform: translateY(-1px);
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

        .admin-name {
            font-weight: 600;
            color: #2c3e50;
        }

        /* Pagination Styling - Compact */
        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
            gap: 3px;
            flex-wrap: wrap;
        }
        .pagination li {
            display: inline-flex;
        }
        .pagination li a,
        .pagination li span {
            padding: 5px 10px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            color: #6c757d;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            background: #fff;
            transition: all 0.15s ease;
            min-width: 32px;
            text-align: center;
            justify-content: center;
            align-items: center;
        }
        .pagination li.active span {
            background: #2c3e50;
            color: #fff;
            border-color: #2c3e50;
        }
        .pagination li a:hover {
            background: #e9ecef;
            color: #2c3e50;
            border-color: #adb5bd;
        }
        .pagination li.disabled span {
            color: #adb5bd;
            background: #f8f9fa;
            cursor: not-allowed;
        }
        .pagination li:first-child a,
        .pagination li:first-child span,
        .pagination li:last-child a,
        .pagination li:last-child span {
            padding: 5px 8px;
        }
        /* Bootstrap 4 pagination compatibility */
        .pagination .page-item {
            display: inline-flex;
        }
        .pagination .page-link {
            padding: 5px 10px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            color: #6c757d;
            text-decoration: none;
            font-size: 12px;
            font-weight: 500;
            background: #fff;
            transition: all 0.15s ease;
            min-width: 32px;
            text-align: center;
            justify-content: center;
            align-items: center;
            margin: 0 2px;
        }
        .pagination .page-item.active .page-link {
            background: #2c3e50;
            color: #fff;
            border-color: #2c3e50;
        }
        .pagination .page-item.disabled .page-link {
            color: #adb5bd;
            background: #f8f9fa;
            cursor: not-allowed;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
            
            .dashboard-container {
                flex-direction: column;
            }

            .page-header h1 {
                font-size: 24px;
            }

            .page-header p {
                font-size: 14px;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 15px;
            }

            .content-section {
                padding: 16px;
            }

            .admin-table th,
            .admin-table td {
                padding: 10px;
                font-size: 12px;
            }

            .btn {
                padding: 8px 12px;
                font-size: 13px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .header-actions {
                width: 100%;
                justify-content: flex-start;
            }
        }

        @media (max-width: 576px) {
            .admin-table {
                font-size: 11px;
            }

            .admin-table th,
            .admin-table td {
                padding: 8px;
            }

            .action-buttons {
                flex-direction: column;
                gap: 5px;
            }

            .btn-sm {
                width: 100%;
                justify-content: center;
            }

            .status-badge,
            .role-badge {
                font-size: 10px;
                padding: 3px 8px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('admin.partials.sidebar', ['activeMenu' => 'admin', 'pendingCount' => $pendingCount ?? 0])
        
        <!-- Main Content -->
        <main class="main-content">
            <header class="page-header">
                <div>
                    <h1>Kelola Admin</h1>
                    <p>Manajemen akun admin</p>
                </div>
                <div class="header-actions">
                    <a href="/kelola-admin/create" class="add-btn">
                        <i class="fas fa-plus"></i>
                        Tambah Admin
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
                <h2>Daftar Admin</h2>
                <form method="GET" action="{{ route('admin.management.index') }}" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap; margin: 0 0 16px;">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama / username / email..." style="flex:1; min-width: 240px; padding:10px 12px; border:1px solid #e9ecef; border-radius:8px;">
                    <select name="role" style="min-width: 160px; padding:10px 12px; border:1px solid #e9ecef; border-radius:8px;">
                        <option value="">Semua Role</option>
                        <option value="owner" {{ request('role') === 'owner' ? 'selected' : '' }}>Owner</option>
                        <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    <select name="status" style="min-width: 180px; padding:10px 12px; border:1px solid #e9ecef; border-radius:8px;">
                        <option value="">Semua Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                    <button type="submit" style="padding:10px 14px; border:none; border-radius:8px; background:#2c3e50; color:#fff; font-weight:700; cursor:pointer;">Terapkan</button>
                    <a href="{{ route('admin.management.index') }}" style="padding:10px 14px; border:1px solid #e9ecef; border-radius:8px; background:#fff; color:#334155; font-weight:700; text-decoration:none;">Reset</a>
                </form>
                <div class="table-container">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th style="width: 40px;">#</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Tanggal Dibuat</th>
                                <th style="width: 120px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($admins as $key => $admin)
                                <tr>
                                    <td>{{ ($admins->firstItem() ?? 0) + $key }}</td>
                                    <td><span class="admin-name">{{ $admin->name }}</span></td>
                                    <td>{{ $admin->username }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>
                                        <span class="role-badge {{ $admin->role }}">
                                            {{ ucfirst($admin->role) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="status-badge {{ $admin->status }}">
                                            {{ $admin->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </td>
                                    <td>{{ $admin->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="/kelola-admin/{{ $admin->id }}/edit" class="btn-sm btn-edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn-sm btn-delete" onclick="if(confirm('Hapus admin ini?')) window.location.href='/kelola-admin/{{ $admin->id }}/delete'">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="empty-state">
                                            <i class="fas fa-inbox"></i>
                                            <p>Tidak ada admin</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 16px;">
                    {{ $admins->links('pagination::bootstrap-4') }}
                </div>
            </section>
        </main>
    </div>
</body>
</html>
