<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin BBC - Edit Testimoni Influencer</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background:#f5f5f5; margin:0; color: #334155; }
        .dashboard-container { display: flex; min-height: 100vh; }
        .main-content { flex: 1; margin-left: 250px; padding: 30px; }
        .page-header { margin-bottom: 20px; }
        .page-header h1 { font-size: 28px; color:#2c3e50; }
        .page-header p { color:#64748b; margin-top: 4px; }
        .wrap { max-width: 760px; background:#fff; border-radius:12px; padding:24px; box-shadow:0 2px 8px rgba(0,0,0,0.08); }
        .group { margin-bottom: 14px; }
        label { display:block; margin-bottom:6px; font-weight:600; color:#334155; }
        input[type="text"], input[type="url"], input[type="number"], input[type="file"] { width:100%; padding:10px; border:1px solid #dbe2ea; border-radius:8px; }
        .thumb { width: 220px; height: 130px; object-fit: cover; border-radius: 8px; margin-top: 8px; border:1px solid #e2e8f0; }
        .actions { display:flex; gap:10px; margin-top:18px; }
        .btn { border:none; border-radius:8px; padding:10px 14px; font-weight:600; cursor:pointer; text-decoration:none; display:inline-block; }
        .primary { background:#e74c3c; color:#fff; }
        .muted { background:#e2e8f0; color:#334155; }
        .err { background:#fee2e2; color:#991b1b; padding:10px; border-radius:8px; margin-bottom:14px; }

        @media (max-width: 992px) {
            .main-content { margin-left: 0; }
            .dashboard-container { flex-direction: column; }
        }

        @media (max-width: 640px) {
            .main-content { padding: 18px; }
        }
    </style>
</head>
<body>
<div class="dashboard-container">
    @include('admin.partials.sidebar', ['activeMenu' => 'testimoni', 'pendingCount' => $pendingCount ?? 0])

    <main class="main-content">
        <div class="page-header">
            <h1>Edit Testimoni Influencer</h1>
            <p>Ubah data testimoni influencer untuk halaman home.</p>
        </div>

        <div class="wrap">
            @if ($errors->any())
                <div class="err">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.testimoni.influencer.update', $influencerTestimonial->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="group">
                    <label>Judul (opsional)</label>
                    <input type="text" name="title" value="{{ old('title', $influencerTestimonial->title) }}" placeholder="Contoh: BUSET!! Apaan nih??">
                </div>
                <div class="group">
                    <label>URL YouTube</label>
                    <input type="url" name="youtube_url" value="{{ old('youtube_url', $influencerTestimonial->youtube_url) }}" required placeholder="https://www.youtube.com/...">
                </div>
                <div class="group">
                    <label>Thumbnail (opsional)</label>
                    <input type="file" name="thumbnail" accept="image/*">
                    @if($influencerTestimonial->thumbnail)
                        <img class="thumb" src="{{ asset($influencerTestimonial->thumbnail) }}" alt="thumbnail">
                    @endif
                </div>
                <div class="group">
                    <label>Urutan Tampil</label>
                    <input type="number" name="display_order" value="{{ old('display_order', $influencerTestimonial->display_order) }}" min="0">
                </div>
                <div class="group">
                    <label><input type="checkbox" name="is_active" value="1" {{ old('is_active', $influencerTestimonial->is_active) ? 'checked' : '' }}> Aktif ditampilkan</label>
                </div>

                <div class="actions">
                    <a class="btn muted" href="{{ route('admin.testimoni.index') }}">Batal</a>
                    <button class="btn primary" type="submit">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </main>
</div>
</body>
</html>
