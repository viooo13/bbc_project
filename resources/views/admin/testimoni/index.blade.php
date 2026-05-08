<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Manajemen Testimoni</title>
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
        .thumb { width: 96px; height: 60px; border-radius: 12px; object-fit: cover; background: #f1f5f9; border: 1px solid var(--line); box-shadow: 0 4px 8px rgba(0,0,0,0.08); }
        .badge { display: inline-block; padding: 4px 12px; border-radius: 999px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.3px; }
        .badge.active { background: #d4edda; color: #155724; }
        .badge.inactive { background: #f8d7da; color: #721c24; }
        .muted { color: var(--text-soft); font-size: 14px; }
        .actions { display: flex; gap: 6px; }
        .icon-btn { border: 1px solid var(--line); background: #fff; color: var(--text-main); width: 36px; height: 36px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; text-decoration: none; transition: all 0.3s ease; }
        .icon-btn:hover { background: #f8fafc; transform: translateY(-1px); }
        .alert { padding: 14px 20px; border-radius: 12px; margin-bottom: 20px; background: #d4edda; color: #155724; font-weight: 600; border: 1px solid #c3e6cb; }

        .youtube-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            word-break: break-all;
        }

        .youtube-link:hover {
            text-decoration: underline;
        }

        .rating-stars {
            color: #fbbf24;
            font-size: 16px;
            letter-spacing: 2px;
        }

        .reply-form textarea {
            width: 100%;
            min-height: 60px;
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 8px;
            font-family: inherit;
            font-size: 14px;
            resize: vertical;
            outline: none;
            transition: all 0.3s ease;
        }

        .reply-form textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(139, 0, 0, 0.1);
        }

        .reply-form .btn {
            margin-top: 6px;
        }
        .search-form {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
            margin: 0 0 12px;
        }

        .search-form input,
        .search-form select {
            flex: 1;
            min-width: 200px;
            padding: 10px 12px;
            border: 1px solid var(--line);
            border-radius: 8px;
            font-family: inherit;
            font-size: 14px;
            outline: none;
            transition: all 0.3s ease;
        }

        .search-form input:focus,
        .search-form select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(139, 0, 0, 0.1);
        }

        .btn-reset {
            border: 1px solid var(--line);
            background: #fff;
            color: #334155;
        }

        .btn-reset:hover {
            background: #f8fafc;
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
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }
        .pagination li a:hover {
            background: #f8fafc;
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
            background: var(--primary);
            color: #fff;
            border-color: var(--primary);
        }
        .pagination .page-item.disabled .page-link {
            color: #adb5bd;
            background: #f8f9fa;
            cursor: not-allowed;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .main-content {
                padding: 24px;
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

            .page-header h1 {
                font-size: 24px;
            }

            .page-header p {
                font-size: 14px;
            }

            .search-form {
                flex-direction: column;
                align-items: stretch;
            }

            .search-form input,
            .search-form select {
                min-width: 100%;
            }

            .thumb {
                width: 80px;
                height: 50px;
            }
        }

        @media (max-width: 768px) {
            .main-content {
                padding: 15px;
            }

            .content-section {
                padding: 16px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .header-actions {
                width: 100%;
                flex-wrap: wrap;
            }

            .header-actions .btn {
                flex: 1;
                justify-content: center;
            }

            table th,
            table td {
                padding: 10px;
                font-size: 12px;
            }

            .btn {
                padding: 8px 12px;
                font-size: 13px;
            }

            .thumb {
                width: 72px;
                height: 48px;
            }

            .rating-stars {
                font-size: 14px;
                letter-spacing: 1px;
            }

            .reply-form textarea {
                min-height: 80px;
            }
        }

        @media (max-width: 576px) {
            .main-content {
                padding: 12px;
            }

            .content-section {
                padding: 12px;
                border-radius: 12px;
            }

            .page-header h1 {
                font-size: 20px;
            }

            .page-header p {
                font-size: 13px;
            }

            table {
                font-size: 11px;
            }

            table th,
            table td {
                padding: 8px;
            }

            table th {
                font-size: 10px;
            }

            .actions {
                flex-direction: column;
                gap: 5px;
            }

            .icon-btn {
                width: 100%;
                justify-content: center;
            }

            .badge {
                font-size: 10px;
                padding: 3px 8px;
            }

            .thumb {
                width: 64px;
                height: 40px;
            }

            .rating-stars {
                font-size: 12px;
            }

            .reply-form textarea {
                font-size: 12px;
                min-height: 70px;
                padding: 8px;
            }

            .content-section h2 {
                font-size: 16px;
                margin-bottom: 16px;
            }

            .table-wrap {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            table {
                min-width: 600px;
            }

            .youtube-link {
                font-size: 10px;
                word-break: break-all;
            }
        }
    </style>
</head>
<body>
<div class="dashboard-container">
    @include('admin.partials.sidebar', ['activeMenu' => 'testimoni', 'pendingCount' => $pendingCount ?? 0])

    <main class="main-content">
        <header class="page-header">
            <div>
                <h1>Testimoni Influencer</h1>
                <p>Kelola testimoni dari influencer dan media partner.</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.testimoni.influencer.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>Tambah Influencer</a>
            </div>
        </header>

        <form class="filter-form" method="GET" action="{{ route('admin.testimoni.index') }}">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari influencer...">
            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i>Terapkan</button>
            <a class="btn btn-reset" href="{{ route('admin.testimoni.index') }}"><i class="fas fa-rotate"></i>Reset</a>
        </form>

        @if(session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        <section class="content-section">
            <h2>Testimoni Influencer</h2>
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Thumbnail</th>
                            <th>Nama Influencer / Media</th>
                            <th>URL YouTube</th>
                            <th>Urutan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($influencerTestimonials as $item)
                        <tr>
                            <td>
                                <img class="thumb" src="{{ $item->thumbnail_url }}" alt="thumbnail">
                            </td>
                            <td>
                                <strong>{{ $item->title ?: 'Tanpa Nama' }}</strong>
                            </td>
                            <td>
                                <a href="{{ $item->youtube_url }}" target="blank" rel="noopener" class="youtube-link">{{ $item->youtube_url }}</a>
                            </td>
                            <td>{{ $item->display_order }}</td>
                            <td><span class="badge {{ $item->is_active ? 'active' : 'inactive' }}">{{ $item->is_active ? 'Aktif' : 'Nonaktif' }}</span></td>
                            <td>
                                <div class="actions">
                                    <a class="icon-btn" href="{{ route('admin.testimoni.influencer.edit', $item->id) }}" title="Edit"><i class="fas fa-edit"></i></a>
                                    <form method="POST" action="{{ route('admin.testimoni.influencer.destroy', $item->id) }}" onsubmit="return confirm('Hapus testimoni influencer ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="icon-btn" title="Hapus"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="muted">Belum ada testimoni influencer.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 10px;">
                {{ $influencerTestimonials->links() }}
            </div>
        </section>

    </main>
</div>
</body>
</html>
