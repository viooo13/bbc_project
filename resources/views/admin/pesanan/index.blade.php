<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Manajemen Pesanan</title>
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
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--surface-2);
            border-radius: 16px;
            padding: 20px;
            box-shadow: var(--shadow-card);
            text-align: center;
            border: 1px solid var(--line);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 32px rgba(45, 55, 72, 0.12);
        }

        .stat-card.pending {
            border-top: 3px solid #ff9800;
        }

        .stat-card.confirmed {
            border-top: 3px solid #2196f3;
        }

        .stat-card.shipped {
            border-top: 3px solid #9c27b0;
        }

        .stat-card.completed {
            border-top: 3px solid #4caf50;
        }

        .stat-card.rejected {
            border-top: 3px solid #f44336;
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 5px;
            color: var(--text-main);
        }

        .stat-label {
            font-size: 12px;
            color: var(--text-soft);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        /* Content Section */
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

        .pesanan-table {
            width: 100%;
            border-collapse: collapse;
        }

        .pesanan-table th {
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

        .pesanan-table td {
            padding: 14px;
            border-bottom: 1px solid var(--line);
            font-size: 14px;
            color: var(--text-main);
        }

        .pesanan-table tr:hover {
            background-color: #fffaf2;
        }

        .pesanan-table tr:last-child td {
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
            gap: 6px;
            flex-wrap: wrap;
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

        .btn-detail {
            background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
            color: white;
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
            padding: 60px 20px;
            color: var(--text-soft);
        }

        .empty-state i {
            font-size: 64px;
            margin-bottom: 20px;
            color: #cbd5e0;
        }

        .alert {
            padding: 14px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
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
            color: var(--text-main);
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

        /* Responsive Design */
        @media (max-width: 1200px) {
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }
        }

        @media (max-width: 992px) {
            .main-content {
                margin-left: 0;
                padding: 20px;
            }
            
            .dashboard-container {
                flex-direction: column;
            }

            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
                gap: 15px;
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

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .stat-card {
                padding: 15px;
            }

            .stat-value {
                font-size: 20px;
            }

            .content-section {
                padding: 16px;
            }

            .pesanan-table th,
            .pesanan-table td {
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
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .pesanan-table {
                font-size: 11px;
            }

            .pesanan-table th,
            .pesanan-table td {
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

            .status-badge {
                font-size: 10px;
                padding: 3px 8px;
            }
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
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }
        .pagination .page-item.disabled .page-link {
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
        .pagination svg {
            width: 14px !important;
            height: 14px !important;
        }
        .pagination a svg,
        .pagination span svg {
            width: 14px !important;
            height: 14px !important;
        }
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
                                <th>Bukti Pembayaran</th>
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
                                    <td>
                                        @if($pesanan->payment_proof)
                                            <button onclick="viewPaymentProof('{{ asset('uploads/payment_proofs/' . $pesanan->payment_proof) }}')" class="btn-sm btn-view" style="background:#4CAF50;color:white;border:none;padding:6px 12px;border-radius:6px;cursor:pointer;font-size:12px;">
                                                <i class="fas fa-eye"></i> Lihat Bukti
                                            </button>
                                        @else
                                            <span style="color:#94a3b8;font-size:12px;">-</span>
                                        @endif
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
                                    <td colspan="7">
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
                    {{ $pesanans->links('pagination::bootstrap-4') }}
                </div>
            </section>
        </main>
    </div>

    <!-- Payment Proof Modal -->
    <div id="paymentProofModal" class="modal">
        <div class="modal-content" style="max-width: 700px;">
            <div class="modal-header">
                <h2>Bukti Pembayaran</h2>
                <button type="button" onclick="closePaymentProofModal()" style="background:none;border:none;font-size:24px;cursor:pointer;color:#6b7280;">&times;</button>
            </div>
            <div class="modal-body" style="text-align:center;">
                <img id="paymentProofImage" src="" alt="Bukti Pembayaran" style="max-width:100%;max-height:500px;border-radius:8px;border:1px solid #e2e8f0;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-close" onclick="closePaymentProofModal()">Tutup</button>
            </div>
        </div>
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
                this.action = "{{ route('pesanan.reject', ':id') }}".replace(':id', currentRejectOrderId);
                this.submit();
            }
        });

        function confirmOrder(orderId) {
            if (confirm('Konfirmasi pesanan ini?')) {
                window.location.href = "{{ route('pesanan.confirm', ':id') }}".replace(':id', orderId);
            }
        }

        function shipOrder(orderId) {
            if (confirm('Kirim pesanan ini?')) {
                window.location.href = "{{ route('pesanan.ship', ':id') }}".replace(':id', orderId);
            }
        }

        function paidOrder(orderId) {
            if (confirm('Tandai pesanan ini sebagai sudah dibayar?')) {
                window.location.href = "{{ route('pesanan.paid', ':id') }}".replace(':id', orderId);
            }
        }

        function completeOrder(orderId) {
            if (confirm('Tandai pesanan ini sebagai selesai?')) {
                window.location.href = "{{ route('pesanan.complete', ':id') }}".replace(':id', orderId);
            }
        }

        function viewPaymentProof(imageUrl) {
            const modal = document.getElementById('paymentProofModal');
            const image = document.getElementById('paymentProofImage');
            image.src = imageUrl;
            modal.classList.add('active');
        }

        function closePaymentProofModal() {
            const modal = document.getElementById('paymentProofModal');
            modal.classList.remove('active');
        }

        // Close modal when clicking outside
        document.getElementById('paymentProofModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePaymentProofModal();
            }
        });

        // Close modal when clicking outside
        document.getElementById('rejectModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRejectModal();
            }
        });
    </script>
</body>
</html>
