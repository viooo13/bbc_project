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
            background-color: #ffffff;
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
            background-color: #ffffff;
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

        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-sm {
            padding: 4px 8px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 800;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            line-height: 1;
        }

        .btn-confirm { background-color: #4caf50; color: #fff; }
        .btn-confirm:hover { background-color: #45a049; transform: translateY(-1px); }

        .btn-reject { background-color: #f44336; color: #fff; }
        .btn-reject:hover { background-color: #da190b; transform: translateY(-1px); }

        .btn-ship { background-color: #ff9800; color: #fff; }
        .btn-ship:hover { background-color: #e68900; transform: translateY(-1px); }

        .btn-paid { background-color: #22c55e; color: #fff; }
        .btn-paid:hover { filter: brightness(1.05); transform: translateY(-1px); }

        .btn-complete { background-color: #2196f3; color: #fff; }
        .btn-complete:hover { background-color: #1e88e5; transform: translateY(-1px); }

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
            background: white;
            border-radius: 10px;
            width: 90%;
            max-width: 520px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
            overflow: hidden;
        }

        .modal-header {
            padding: 16px 18px;
            border-bottom: 1px solid #e9ecef;
        }

        .modal-header h2 {
            font-size: 16px;
            margin: 0;
            color: #2c3e50;
        }

        .modal-body { padding: 16px 18px; }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 800;
            margin-bottom: 8px;
            color: #2c3e50;
        }

        .form-group textarea {
            width: 100%;
            min-height: 90px;
            padding: 10px 12px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-family: inherit;
            font-size: 13px;
            outline: none;
        }

        .modal-footer {
            padding: 14px 18px;
            border-top: 1px solid #e9ecef;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-close {
            background: #e2e8f0;
            color: #334155;
            border: none;
            border-radius: 8px;
            padding: 8px 12px;
            font-weight: 800;
            cursor: pointer;
        }

        .btn-action {
            background: #f44336;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 8px 12px;
            font-weight: 800;
            cursor: pointer;
        }

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
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('admin.partials.sidebar', ['activeMenu' => 'pesanan', 'pendingCount' => $pendingCount ?? 0])

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
                                            <td>
                                                <div class="action-buttons">
                                                    @if(($o->status ?? '') === 'pending')
                                                        <button class="btn-sm btn-confirm" onclick="confirmOrder({{ $o->id }})"><i class="fas fa-check"></i> Konfirmasi</button>
                                                        <button class="btn-sm btn-reject" onclick="openRejectModal({{ $o->id }})"><i class="fas fa-times"></i> Tolak</button>
                                                    @elseif(($o->status ?? '') === 'confirmed')
                                                        <button class="btn-sm btn-ship" onclick="shipOrder({{ $o->id }})"><i class="fas fa-truck"></i> Kirim</button>
                                                        <button class="btn-sm btn-paid" onclick="paidOrder({{ $o->id }})"><i class="fas fa-money-check"></i> Sudah Dibayar</button>
                                                    @elseif(($o->status ?? '') === 'shipped')
                                                        <button class="btn-sm btn-complete" onclick="completeOrder({{ $o->id }})"><i class="fas fa-check-double"></i> Selesai</button>
                                                    @else
                                                        <span style="color:#94a3b8;font-weight:700;">-</span>
                                                    @endif
                                                </div>
                                            </td>
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
                        <form method="GET" action="{{ route('admin.kelola_pesanan.index') }}" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap; margin: 0 0 12px;">
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari order id / nama / email / telepon..." style="flex:1; min-width: 240px; padding:10px 12px; border:1px solid #e9ecef; border-radius:8px;">
                            <select name="status" style="min-width: 180px; padding:10px 12px; border:1px solid #e9ecef; border-radius:8px;">
                                <option value="">Semua Status</option>
                                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu</option>
                                <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                                <option value="shipped" {{ request('status') === 'shipped' ? 'selected' : '' }}>Dikirim</option>
                                <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            <button type="submit" style="padding:10px 14px; border:none; border-radius:8px; background:#2c3e50; color:#fff; font-weight:800; cursor:pointer;">Terapkan</button>
                            <a href="{{ route('admin.kelola_pesanan.index') }}" style="padding:10px 14px; border:1px solid #e9ecef; border-radius:8px; background:#fff; color:#334155; font-weight:800; text-decoration:none;">Reset</a>
                        </form>
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
                                            <td>
                                                <div class="action-buttons">
                                                    @if(($o->status ?? '') === 'pending')
                                                        <button class="btn-sm btn-confirm" onclick="confirmOrder({{ $o->id }})"><i class="fas fa-check"></i> Konfirmasi</button>
                                                        <button class="btn-sm btn-reject" onclick="openRejectModal({{ $o->id }})"><i class="fas fa-times"></i> Tolak</button>
                                                    @elseif(($o->status ?? '') === 'confirmed')
                                                        <button class="btn-sm btn-ship" onclick="shipOrder({{ $o->id }})"><i class="fas fa-truck"></i> Kirim</button>
                                                        <button class="btn-sm btn-paid" onclick="paidOrder({{ $o->id }})"><i class="fas fa-money-check"></i> Sudah Dibayar</button>
                                                    @elseif(($o->status ?? '') === 'shipped')
                                                        <button class="btn-sm btn-complete" onclick="completeOrder({{ $o->id }})"><i class="fas fa-check-double"></i> Selesai</button>
                                                    @else
                                                        <span style="color:#94a3b8;font-weight:700;">-</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" style="text-align:center;color:#64748b;">Belum ada data.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div style="margin-top: 12px;">
                            {{ $orders->links('pagination::bootstrap-4') }}
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
            const textarea = document.getElementById('reason');
            if (textarea) textarea.value = '';
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

        document.getElementById('rejectModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeRejectModal();
            }
        });
    </script>
</body>
</html>
