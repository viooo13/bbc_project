<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Tambah Testimoni Influencer</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f5f5f5; color: #334155; }
        .dashboard-container { display: flex; min-height: 100vh; }

        .sidebar { width: 250px; background: #fff; position: fixed; height: 100vh; border-right: 1px solid #e9ecef; }
        .logo { display: flex; align-items: center; padding: 20px; border-bottom: 1px solid #e9ecef; }
        .logo img { width: 40px; height: 40px; margin-right: 10px; border-radius: 8px; object-fit: cover; }
        .logo span { font-size: 18px; font-weight: 700; color: #2c3e50; }
        .menu { padding: 16px 0; }
        .menu-item { display: flex; align-items: center; padding: 15px 20px; color: #6c757d; text-decoration: none; border-left: 3px solid transparent; }
        .menu-item:hover { background: #f8f9fa; color: #2c3e50; }
        .menu-item.active { background: #e74c3c; color: #fff; border-left-color: #e74c3c; }
        .menu-item i { width: 20px; margin-right: 12px; }

        .main-content { flex: 1; margin-left: 250px; padding: 30px; }
        .page-header { margin-bottom: 20px; }
        .page-header h1 { font-size: 28px; color: #2c3e50; }
        .page-header p { color: #64748b; margin-top: 4px; }

        .wrap { max-width: 760px; background:#fff; border-radius:12px; padding:24px; box-shadow:0 2px 8px rgba(0,0,0,0.08); }
        .group { margin-bottom: 14px; }
        label { display:block; margin-bottom:6px; font-weight:600; color:#334155; }
        input[type="text"], input[type="url"], input[type="number"], input[type="file"] { width:100%; padding:10px; border:1px solid #dbe2ea; border-radius:8px; }
        .actions { display:flex; gap:10px; margin-top:18px; }
        .btn { border:none; border-radius:8px; padding:10px 14px; font-weight:600; cursor:pointer; text-decoration:none; display:inline-block; }
        .primary { background:#e74c3c; color:#fff; }
        .muted { background:#e2e8f0; color:#334155; }
        .err { background:#fee2e2; color:#991b1b; padding:10px; border-radius:8px; margin-bottom:14px; }

        @media (max-width: 992px) {
            .sidebar { position: static; width: 100%; height: auto; }
            .main-content { margin-left: 0; }
            .dashboard-container { flex-direction: column; }
            .menu { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .menu-item { border-left: none; border-bottom: 2px solid transparent; }
            .menu-item.active { border-bottom-color: #e74c3c; }
        }

        @media (max-width: 640px) {
            .main-content { padding: 18px; }
            .menu { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
<div class="dashboard-container">
    @include('admin.partials.sidebar', ['activeMenu' => 'testimoni', 'pendingCount' => $pendingCount ?? 0])

    <main class="main-content">
        <div class="page-header">
            <h1>Tambah Testimoni Influencer</h1>
            <p>Isi data testimoni influencer untuk ditampilkan di halaman home.</p>
        </div>

        <div class="wrap">
            @if ($errors->any())
                <div class="err">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.testimoni.influencer.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="group">
                    <label>Judul (opsional)</label>
                    <input type="text" name="title" value="{{ old('title') }}" placeholder="Contoh: BUSET!! Apaan nih??">
                </div>
                <div class="group">
                    <label>URL YouTube</label>
                    <input type="url" name="youtube_url" value="{{ old('youtube_url') }}" required placeholder="https://www.youtube.com/...">
                </div>
                <div class="group">
                    <label>Thumbnail (opsional)</label>
                    <input type="file" name="thumbnail" accept="image/*">
                </div>
                <div class="group">
                    <label>Urutan Tampil</label>
                    <input type="number" name="display_order" value="{{ old('display_order', 0) }}" min="0">
                </div>
                <div class="group">
                    <label><input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}> Aktif ditampilkan</label>
                </div>

                <div class="actions">
                    <a class="btn muted" href="{{ route('admin.testimoni.index') }}">Batal</a>
                    <button class="btn primary" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </main>
</div>
</body>
</html>
