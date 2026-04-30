<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Manajemen Pesanan</title>
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
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            text-align: center;
            border-left: 4px solid transparent;
        }

        .stat-card.pending {
            border-left-color: #ff9800;
        }

        .stat-card.confirmed {
            border-left-color: #2196f3;
        }

        .stat-card.shipped {
            border-left-color: #9c27b0;
        }

        .stat-card.completed {
            border-left-color: #4caf50;
        }

        .stat-card.rejected {
            border-left-color: #f44336;
        }

        .stat-value {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 12px;
            color: #7f8c8d;
            text-transform: uppercase;
        }

        /* Content Section */
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

        .pesanan-table {
            width: 100%;
            border-collapse: collapse;
        }

        .pesanan-table th {
            background-color: #f8f9fa;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: #2c3e50;
            border-bottom: 1px solid #e9ecef;
            font-size: 14px;
        }

        .pesanan-table td {
            padding: 12px;
            border-bottom: 1px solid #e9ecef;
            font-size: 14px;
        }

        .pesanan-table tr:hover {
            background-color: #f8fafc;
        }

        .pesanan-table tr:last-child td {
            border-bottom: none;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .status-badge.pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-badge.confirmed {
            background-color: #cce5ff;
            color: #004085;
        }

        .status-badge.shipped {
            background-color: #e2d5f2;
            color: #5a1384;
        }

        .status-badge.completed {
            background-color: #d4edda;
            color: #155724;
        }

        .status-badge.rejected {
            background-color: #f8d7da;
            color: #721c24;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
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

        .btn-detail {
            background-color: #667eea;
            color: white;
        }

        .btn-detail:hover {
            background-color: #5a6fd8;
        }

        .btn-confirm {
            background-color: #4caf50;
            color: white;
        }

        .btn-confirm:hover {
            background-color: #45a049;
        }

        .btn-reject {
            background-color: #f44336;
            color: white;
        }

        .btn-reject:hover {
            background-color: #da190b;
        }

        .btn-ship {
            background-color: #ff9800;
            color: white;
        }

        .btn-ship:hover {
            background-color: #e68900;
        }

        .btn-paid {
            background-color: #4caf50;
            color: white;
        }

        .btn-paid:hover {
            background-color: #45a049;
        }

        .btn-complete {
            background-color: #2196f3;
            color: white;
        }

        .btn-complete:hover {
            background-color: #1e88e5;
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

        .customer-name {
            font-weight: 600;
            color: #2c3e50;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 2000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .modal-header {
            margin-bottom: 20px;
        }

        .modal-header h2 {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
        }

        .modal-body {
            margin-bottom: 20px;
        }

        .modal-body p {
            margin-bottom: 10px;
            color: #555;
        }

        .modal-footer {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .btn-close {
            background-color: #e9ecef;
            color: #495057;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-close:hover {
            background-color: #dee2e6;
        }

        .btn-action {
            background-color: #f44336;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 600;
        }

        .btn-action:hover {
            background-color: #da190b;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #2c3e50;
            font-size: 14px;
        }

        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #e9ecef;
            border-radius: 4px;
            font-family: inherit;
            font-size: 14px;
        }

        .order-items {
            list-style: none;
            padding: 0;
        }

        .order-items li {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #e9ecef;
            font-size: 13px;
        }

        .order-items li:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('admin.partials.sidebar', ['activeMenu' => 'pesanan', 'pendingCount' => $stats['pending'] ?? 0])
        
        <!-- Main Content -->
        <main class="main-content">
            <header class="page-header">
                <div>
                    <h1>Manajemen Pesanan</h1>
                    <p>Kelola pesanan dari pelanggan</p>
                </div>
                <div class="header-actions">
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

            @if(session('error'))
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-triangle"></i>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Stats Cards -->
            <section class="stats-grid">
                <div class="stat-card pending">
                    <div class="stat-value">{{ $stats['pending'] }}</div>
                    <div class="stat-label">Menunggu</div>
                </div>
                <div class="stat-card confirmed">
                    <div class="stat-value">{{ $stats['confirmed'] }}</div>
                    <div class="stat-label">Dikonfirmasi</div>
                </div>
                <div class="stat-card shipped">
                    <div class="stat-value">{{ $stats['shipped'] }}</div>
                    <div class="stat-label">Dikirim</div>
                </div>
                <div class="stat-card completed">
                    <div class="stat-value">{{ $stats['completed'] }}</div>
                    <div class="stat-label">Selesai</div>
                </div>
                <div class="stat-card rejected">
                    <div class="stat-value">{{ $stats['rejected'] }}</div>
                    <div class="stat-label">Ditolak</div>
                </div>
            </section>

            <!-- Orders Table -->
            <section class="content-section">
                <h2>Daftar Pesanan</h2>
                <form method="GET" action="{{ route('pesanan.index') }}" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap; margin: 0 0 16px;">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari order id / nama / email / telepon..." style="flex:1; min-width: 260px; padding:10px 12px; border:1px solid #e9ecef; border-radius:8px;">
                    <select name="status" style="min-width: 180px; padding:10px 12px; border:1px solid #e9ecef; border-radius:8px;">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                        <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>Dikirim</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                    <button type="submit" style="padding:10px 14px; border:none; border-radius:8px; background:#2c3e50; color:#fff; font-weight:700; cursor:pointer;">Terapkan</button>
                    <a href="{{ route('pesanan.index') }}" style="padding:10px 14px; border:1px solid #e9ecef; border-radius:8px; background:#fff; color:#334155; font-weight:700; text-decoration:none;">Reset</a>
                </form>
                <div class="table-container">
                    <table class="pesanan-table">
                        <thead>
                            <tr>
                                <th>ID Pesanan</th>
                                <th>Pelanggan</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th style="width: 170px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pesanans as $pesanan)
                                <tr>
                                    <td>{{ $pesanan->order_id }}</td>
                                    <td><span class="customer-name">{{ $pesanan->customer_name }}</span></td>
                                    <td><span class="price">Rp {{ number_format($pesanan->total_price, 0, ',', '.') }}</span></td>
                                    <td>
                                        <span class="status-badge {{ $pesanan->status }}">
                                            @switch($pesanan->status)
                                                @case('pending')
                                                    Menunggu
                                                    @break
                                                @case('confirmed')
                                                    Dikonfirmasi
                                                    @break
                                                @case('shipped')
                                                    Dikirim
                                                    @break
                                                @case('completed')
                                                    Selesai
                                                    @break
                                                @case('rejected')
                                                    Ditolak
                                                    @break
                                            @endswitch
                                        </span>
                                    </td>
                                    <td>{{ $pesanan->created_at->format('d M Y') }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            @if($pesanan->status === 'pending')
                                                <button class="btn-sm btn-confirm" onclick="confirmOrder({{ $pesanan->id }})">
                                                    <i class="fas fa-check"></i> Konfirmasi
                                                </button>
                                                <button class="btn-sm btn-reject" onclick="openRejectModal({{ $pesanan->id }})">
                                                    <i class="fas fa-times"></i> Tolak
                                                </button>
                                            @elseif($pesanan->status === 'confirmed')
                                                <button class="btn-sm btn-ship" onclick="shipOrder({{ $pesanan->id }})">
                                                    <i class="fas fa-truck"></i> Kirim
                                                </button>
                                                <button class="btn-sm btn-paid" onclick="paidOrder({{ $pesanan->id }})">
                                                    <i class="fas fa-money-check"></i> Sudah Dibayar
                                                </button>
                                            @elseif($pesanan->status === 'shipped')
                                                <button class="btn-sm btn-complete" onclick="completeOrder({{ $pesanan->id }})">
                                                    <i class="fas fa-check-double"></i> Selesai
                                                </button>
                                            @else
                                                <span style="color:#94a3b8;font-weight:600;">-</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="empty-state">
                                            <i class="fas fa-inbox"></i>
                                            <p>Tidak ada pesanan</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 16px;">
                    {{ $pesanans->links() }}
                </div>
            </section>
        </main>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Tolak Pesanan</h2>
            </div>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="reason">Alasan Penolakan</label>
                        <textarea id="reason" name="reason" placeholder="Masukkan alasan penolakan pesanan..." required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-close" onclick="closeRejectModal()">Batal</button>
                    <button type="submit" class="btn-action">Tolak Pesanan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentRejectOrderId = null;

        function openRejectModal(orderId) {
            currentRejectOrderId = orderId;
            document.getElementById('rejectModal').classList.add('active');
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.remove('active');
            currentRejectOrderId = null;
        }

        document.getElementById('rejectForm').addEventListener('submit', function(e) {
            e.preventDefault();
            if (currentRejectOrderId) {
                this.action = `/pesanan/${currentRejectOrderId}/reject`;
                this.submit();
            }
        });

        function confirmOrder(orderId) {
            if (confirm('Konfirmasi pesanan ini?')) {
                window.location.href = `/pesanan/${orderId}/confirm`;
            }
        }

        function shipOrder(orderId) {
            if (confirm('Kirim pesanan ini?')) {
                window.location.href = `/pesanan/${orderId}/ship`;
            }
        }

        function paidOrder(orderId) {
            if (confirm('Tandai pesanan ini sebagai sudah dibayar?')) {
                window.location.href = `/pesanan/${orderId}/paid`;
            }
        }

        function completeOrder(orderId) {
            if (confirm('Tandai pesanan ini sebagai selesai?')) {
                window.location.href = `/pesanan/${orderId}/complete`;
            }
        }

        // Close modal when clicking outside
        document.getElementById('rejectModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRejectModal();
            }
        });
    </script>
</body>
</html>
