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
        .sidebar { width: 250px; background: #fff; position: fixed; height: 100vh; border-right: 1px solid #e9ecef; }
        .logo { display: flex; align-items: center; padding: 20px; border-bottom: 1px solid #e9ecef; }
        .logo img { width: 40px; height: 40px; margin-right: 10px; border-radius: 8px; object-fit: cover; }
        .logo span { font-size: 18px; font-weight: 700; color: #2c3e50; }
        .menu { padding: 16px 0; }
        .menu-item { display: flex; align-items: center; padding: 15px 20px; color: #6c757d; text-decoration: none; border-left: 3px solid transparent; }
        .menu-item:hover { background: #f8f9fa; color: #2c3e50; }
        .menu-item.active { background: #e74c3c; color: #fff; border-left-color: #e74c3c; }
        .menu-item i { width: 20px; margin-right: 12px; }
        .user-info { margin-top: auto; padding: 16px 20px; display: flex; align-items: center; gap: 12px; border-top: 1px solid #e9ecef; }
        .user-details { min-width: 0; }
        .user-name { font-size: 14px; font-weight: 700; color: #2c3e50; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .main-content { flex: 1; margin-left: 250px; padding: 30px; }
        .page-header { margin-bottom: 20px; }
        .page-header h1 { font-size: 28px; color:#2c3e50; }
        .page-header p { color:#64748b; margin-top: 4px; }
        .wrap { max-width: 760px; background:#fff; border-radius:12px; padding:24px; box-shadow:0 2px 8px rgba(0,0,0,0.08); }
        .group { margin-bottom: 14px; }
        label { display:block; margin-bottom:6px; font-weight:600; color:#334155; }
        input[type="text"], input[type="url"], input[type="number"] { width:100%; padding:10px; border:1px solid #dbe2ea; border-radius:8px; }
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
            <p>Ubah Data Testimoni Influencer Untuk Halaman Home.</p>
        </div>

        <div class="wrap">
            @if ($errors->any())
                <div class="err">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.testimoni.influencer.update', $influencerTestimonial->id) }}">
                @csrf
                @method('PUT')
                <div class="group">
                    <label>Nama Influencer / Media Review (Opsional)</label>
                    <input id="influencer_name" type="text" name="title" value="{{ old('title', $influencerTestimonial->title) }}" placeholder="Contoh: Nex Carlos / Kuliner Bogor">
                </div>
                <div class="group">
                    <label>URL YouTube</label>
                    <input id="youtube_url" type="url" name="youtube_url" value="{{ old('youtube_url', $influencerTestimonial->youtube_url) }}" required placeholder="https://www.youtube.com/...">
                </div>
                <div class="group">
                    <label>Thumbnail HD (Otomatis)</label>
                    <input id="thumbnail_preview_url" type="url" readonly placeholder="Akan Terisi Otomatis Dari URL YouTube">
                    <img id="youtube_thumb_preview" class="thumb" src="{{ $influencerTestimonial->thumbnail_url }}" alt="Thumbnail">
                </div>
                <div class="group">
                    <label>Urutan Tampil</label>
                    <input type="number" name="display_order" value="{{ old('display_order', $influencerTestimonial->display_order) }}" min="0">
                </div>
                <div class="group">
                    <label><input type="checkbox" name="is_active" value="1" {{ old('is_active', $influencerTestimonial->is_active) ? 'checked' : '' }}> Aktif Ditampilkan</label>
                </div>

                <div class="actions">
                    <a class="btn muted" href="{{ route('admin.testimoni.index') }}">Batal</a>
                    <button class="btn primary" type="submit">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </main>
</div>

<script>
    function extractYoutubeId(url) {
        if (!url) return null;
        const match = url.match(/(?:youtube\.com\/(?:watch\?(?:.*&)?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/i);
        return match ? match[1] : null;
    }

    function updateYoutubeThumbnailPreview() {
        const youtubeInput = document.getElementById('youtube_url');
        const previewUrlInput = document.getElementById('thumbnail_preview_url');
        const previewImg = document.getElementById('youtube_thumb_preview');
        const videoId = extractYoutubeId(youtubeInput.value);

        if (videoId) {
            const hdThumb = `https://i.ytimg.com/vi/${videoId}/maxresdefault.jpg`;
            previewUrlInput.value = hdThumb;
            previewImg.src = hdThumb;
            previewImg.style.display = 'block';
            return;
        }

        previewUrlInput.value = '';
        previewImg.removeAttribute('src');
        previewImg.style.display = 'none';
    }

    function toTitleCase(value) {
        const acronyms = {
            tv: 'TV',
            tvri: 'TVRI',
            bbc: 'BBC',
            rcti: 'RCTI',
            sctv: 'SCTV',
            mnc: 'MNC',
            net: 'NET',
            cnn: 'CNN',
            id: 'ID',
        };

        return value
            .trim()
            .split(/\s+/)
            .map(part => part.split('-').map(segment => {
                const lower = segment.toLowerCase();
                if (acronyms[lower]) return acronyms[lower];
                return lower.replace(/\b([a-z])/g, (_, letter) => letter.toUpperCase());
            }).join('-'))
            .join(' ');
    }

    async function autofillInfluencerName() {
        const youtubeInput = document.getElementById('youtube_url');
        const nameInput = document.getElementById('influencer_name');
        const youtubeUrl = youtubeInput.value.trim();

        if (!extractYoutubeId(youtubeUrl)) return;
        if (nameInput.value.trim() !== '') return;

        try {
            const oembedUrl = `https://www.youtube.com/oembed?url=${encodeURIComponent(youtubeUrl)}&format=json`;
            const res = await fetch(oembedUrl);
            if (!res.ok) return;
            const data = await res.json();

            const autoName = toTitleCase((data.author_name || data.title || '').trim());
            if (autoName && nameInput.value.trim() === '') {
                nameInput.value = autoName;
            }
        } catch (e) {
            // Ignore fetch errors and keep manual input flow.
        }
    }

    document.getElementById('youtube_url').addEventListener('input', updateYoutubeThumbnailPreview);
    document.getElementById('youtube_url').addEventListener('blur', autofillInfluencerName);
    updateYoutubeThumbnailPreview();
    autofillInfluencerName();
</script>
</body>
</html>
