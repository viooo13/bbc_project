<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Ulasan Pelanggan</title>
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

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Poppins', sans-serif; background: var(--cream); color: var(--text-main); }
        .dashboard-container { display: flex; min-height: 100vh; }
        .main-content { flex: 1; margin-left: 272px; padding: 30px; background: transparent; min-height: 100vh; max-width: 1400px; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .page-header h1 { font-size: 28px; font-weight: 700; color: var(--primary); }
        .page-header p { color: var(--text-soft); margin-top: 4px; }
        .header-actions { display: flex; gap: 10px; }
        .btn { padding: 8px 16px; border-radius: 10px; font-size: 14px; font-weight: 600; text-decoration: none; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; transition: all 0.3s ease; }
        .btn-primary { background: linear-gradient(90deg, var(--primary) 0%, var(--primary-soft) 100%); color: #fff; box-shadow: 0 8px 20px rgba(139, 0, 0, 0.18); }
        .btn-primary:hover { filter: brightness(1.03); transform: translateY(-1px); }
        .btn-danger { background: linear-gradient(90deg, #dc3545 0%, #c82333 100%); color: #fff; }
        .btn-danger:hover { filter: brightness(1.03); transform: translateY(-1px); }
        .content-section { background: var(--surface-2); border-radius: 16px; padding: 20px; box-shadow: var(--shadow-card); border: 1px solid var(--line); margin-bottom: 20px; max-width: 100%; overflow: hidden; }
        .content-section h2 { font-size: 18px; margin-bottom: 16px; color: var(--primary); font-weight: 600; }
        .table-wrap { overflow-x: auto; max-width: 100%; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; border-bottom: 1px solid var(--line); text-align: left; vertical-align: top; color: var(--text-main); }
        th { font-size: 13px; text-transform: uppercase; letter-spacing: 0.3px; color: var(--text-main); background: #fff3e4; font-weight: 600; border-bottom: 2px solid var(--line); }
        tr:hover { background-color: #fffaf2; }
        tr:last-child td { border-bottom: none; }
        .badge { display: inline-block; padding: 4px 12px; border-radius: 999px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.3px; }
        .badge.active { background: #d4edda; color: #155724; }
        .badge.inactive { background: #f8d7da; color: #721c24; }
        .muted { color: var(--text-soft); font-size: 14px; }
        .actions { display: flex; gap: 6px; }
        .icon-btn {
            background: #f8f7f4;
            border: 1px solid var(--line);
            color: var(--text-main);
            padding: 6px 10px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 13px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .icon-btn:hover { background: var(--primary); color: #fff; border-color: var(--primary); }

        .alert { padding: 12px 16px; border-radius: 12px; margin-bottom: 20px; display: flex; align-items: center; gap: 10px; font-size: 14px; font-weight: 500; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }

        .filter-bar {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        .filter-bar input, .filter-bar select {
            padding: 8px 12px;
            border-radius: 10px;
            border: 1px solid var(--line);
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
        }

        .star-rating { color: #f59e0b; }
        .review-text { max-width: 300px; }
        .admin-reply-form { display: flex; gap: 6px; align-items: center; }
        .admin-reply-form input {
            flex: 1;
            padding: 6px 10px;
            border-radius: 8px;
            border: 1px solid var(--line);
            font-family: 'Poppins', sans-serif;
            font-size: 13px;
        }
        .admin-reply-form button {
            padding: 6px 12px;
            border-radius: 8px;
            background: var(--primary);
            color: #fff;
            border: none;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .main-content { margin-left: 0; padding: 20px; }
            .page-header { flex-direction: column; align-items: flex-start; gap: 10px; }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        @include('admin.partials.sidebar', ['activeMenu' => 'ulasan'])

        <main class="main-content">
            <header class="page-header">
                <div>
                    <h1>Ulasan Pelanggan</h1>
                    <p>Kelola ulasan dan balasan dari pelanggan.</p>
                </div>
                <div class="header-actions">
                    <a href="{{ route('admin.testimoni.index') }}" class="btn btn-primary"><i class="fas fa-arrow-left"></i>Kembali ke Influencer</a>
                </div>
            </header>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    {{ session('success') }}
                </div>
            @endif

            <form class="filter-bar" method="GET" action="{{ route('admin.testimoni.ulasan') }}">
                <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Cari ulasan...">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i>Cari</button>
                @if(($q ?? '') !== '')
                    <a href="{{ route('admin.testimoni.ulasan') }}" class="btn btn-danger">Reset</a>
                @endif
            </form>

            <section class="content-section">
                <h2>Ulasan Pelanggan</h2>
                <div class="table-wrap">
                    <table>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Rating</th>
                                <th>Ulasan</th>
                                <th>Balasan Admin</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($customerTestimonials as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <span class="star-rating">
                                        @for($i = 1; $i <= 5; $i++)
                                            <i class="fas fa-star{{ $i > $item->rating ? '-half-alt' : '' }}"></i>
                                        @endfor
                                    </span>
                                    <span style="margin-left: 4px; font-size: 13px; color: var(--text-soft);">({{ $item->rating }})</span>
                                </td>
                                <td class="review-text">{{ $item->review }}</td>
                                <td>
                                    <form class="admin-reply-form" method="POST" action="{{ route('admin.testimoni.customer.reply', $item->id) }}">
                                        @csrf
                                        <input type="text" name="admin_reply" value="{{ $item->admin_reply ?? '' }}" placeholder="Balas ulasan...">
                                        <button type="submit">Simpan</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('admin.testimoni.customer.destroy', $item->id) }}" onsubmit="return confirm('Hapus ulasan pelanggan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="icon-btn" title="Hapus"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="muted">Belum ada ulasan pelanggan.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 10px;">
                    {{ $customerTestimonials->links() }}
                </div>
            </section>
        </main>
    </div>
</body>
</html>
