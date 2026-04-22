<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Manajemen Testimoni</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f5f5f5; color: #334155; }
        .dashboard-container { display: flex; min-height: 100vh; }
        .sidebar { width: 272px; background: #fff; position: fixed; height: 100vh; border-right: 1px solid #e9ecef; }
        .logo { display: flex; align-items: center; padding: 20px; border-bottom: 1px solid #e9ecef; }
        .logo img { width: 40px; height: 40px; margin-right: 10px; border-radius: 8px; object-fit: cover; }
        .logo span { font-size: 18px; font-weight: 700; color: #2c3e50; }
        .menu { padding: 16px 0; }
        .menu-item { display: flex; align-items: center; padding: 15px 20px; color: #6c757d; text-decoration: none; border-left: 3px solid transparent; }
        .menu-item:hover { background: #f8f9fa; color: #2c3e50; }
        .menu-item.active { background: #e74c3c; color: #fff; border-left-color: #e74c3c; }
        .menu-item i { width: 20px; margin-right: 12px; }
        .main-content { flex: 1; margin-left: 272px; padding: 30px; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; }
        .page-header h1 { font-size: 28px; color: #2c3e50; }
        .page-header p { color: #64748b; margin-top: 4px; }
        .header-actions { display: flex; gap: 10px; }
        .btn { padding: 9px 14px; border-radius: 8px; font-size: 13px; font-weight: 600; text-decoration: none; border: none; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; }
        .btn-primary { background: #e74c3c; color: #fff; }
        .btn-primary:hover { background: #c0392b; }
        .btn-danger { background: #dc3545; color: #fff; }
        .btn-danger:hover { background: #c82333; }
        .content-section { background: #fff; border-radius: 10px; padding: 20px; box-shadow: 0 2px 6px rgba(0,0,0,0.06); margin-bottom: 20px; }
        .content-section h2 { font-size: 20px; margin-bottom: 14px; color: #2c3e50; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px 10px; border-bottom: 1px solid #eef2f7; text-align: left; vertical-align: top; }
        th { font-size: 12px; text-transform: uppercase; letter-spacing: 0.04em; color: #64748b; background: #f8fafc; }
        .thumb { width: 96px; height: 60px; border-radius: 8px; object-fit: cover; background: #f1f5f9; }
        .badge { display: inline-block; padding: 4px 9px; border-radius: 999px; font-size: 11px; font-weight: 700; }
        .badge.active { background: #e7f8ed; color: #166534; }
        .badge.inactive { background: #fee2e2; color: #991b1b; }
        .muted { color: #64748b; font-size: 12px; }
        .actions { display: flex; gap: 6px; }
        .icon-btn { border: 1px solid #e2e8f0; background: #fff; color: #334155; width: 32px; height: 32px; border-radius: 8px; display: inline-flex; align-items: center; justify-content: center; cursor: pointer; text-decoration: none; }
        .icon-btn:hover { background: #f8fafc; }
        .reply-form textarea { width: 100%; min-height: 64px; border: 1px solid #e2e8f0; border-radius: 8px; padding: 8px; font-family: inherit; font-size: 13px; }
        .reply-form .btn { margin-top: 8px; }
        .alert { padding: 12px 14px; border-radius: 8px; margin-bottom: 16px; background: #e7f8ed; color: #166534; font-weight: 600; }
    </style>
</head>
<body>
<div class="dashboard-container">
    @include('admin.partials.sidebar', ['activeMenu' => 'testimoni', 'pendingCount' => $pendingCount ?? 0])

    <main class="main-content">
        <header class="page-header">
            <div>
                <h1>Manajemen Testimoni</h1>
                <p>Kelola Testimoni Influencer dan Ulasan Pelanggan dari backend.</p>
            </div>
            <div class="header-actions">
                <a href="{{ route('admin.testimoni.influencer.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>Tambah Influencer</a>
            </div>
        </header>

        <form method="GET" action="{{ route('admin.testimoni.index') }}" style="display:flex; gap:10px; align-items:center; flex-wrap:wrap; margin: 0 0 16px;">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari..." style="flex:1; min-width: 240px; padding:10px 12px; border:1px solid #e2e8f0; border-radius:8px;">
            <select name="type" style="min-width: 200px; padding:10px 12px; border:1px solid #e2e8f0; border-radius:8px;">
                <option value="">Semua</option>
                <option value="influencer" {{ request('type') === 'influencer' ? 'selected' : '' }}>Influencer</option>
                <option value="customer" {{ request('type') === 'customer' ? 'selected' : '' }}>Pelanggan</option>
            </select>
            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i>Terapkan</button>
            <a class="btn" href="{{ route('admin.testimoni.index') }}" style="border:1px solid #e2e8f0; background:#fff; color:#334155;"><i class="fas fa-rotate"></i>Reset</a>
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
                                <a href="{{ $item->youtube_url }}" target="_blank" rel="noopener">{{ $item->youtube_url }}</a>
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

            <div style="margin-top: 12px;">
                {{ $influencerTestimonials->links() }}
            </div>
        </section>

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
                            <td><strong>{{ $item->customer_name }}</strong><div class="muted">{{ optional($item->created_at)->format('d M Y H:i') }}</div></td>
                            <td>{{ str_repeat('★', (int)$item->rating) }}{{ str_repeat('☆', max(0, 5 - (int)$item->rating)) }}</td>
                            <td>{{ $item->content }}</td>
                            <td>
                                <form class="reply-form" method="POST" action="{{ route('admin.testimoni.customer.reply', $item->id) }}">
                                    @csrf
                                    <textarea name="admin_reply" placeholder="Tulis balasan admin...">{{ old('admin_reply', $item->admin_reply) }}</textarea>
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-reply"></i>Simpan Balasan</button>
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('admin.testimoni.customer.destroy', $item->id) }}" onsubmit="return confirm('Hapus ulasan pelanggan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i>Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="muted">Belum ada ulasan pelanggan.</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 12px;">
                {{ $customerTestimonials->links() }}
            </div>
        </section>
    </main>
</div>
</body>
</html>
