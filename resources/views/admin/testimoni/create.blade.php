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
        body { font-family: 'Inter', sans-serif; background: #ffffff; color: #334155; }
        .dashboard-container { display: flex; min-height: 100vh; }

        .main-content { flex: 1; margin-left: 272px; padding: 30px; background: #ffffff; }
        .page-header { margin-bottom: 20px; }
        .page-header h1 { font-size: 28px; color: #2c3e50; }
        .page-header p { color: #64748b; margin-top: 4px; }

        .wrap { max-width: 760px; background:#fff; border-radius:12px; padding:24px; box-shadow:0 2px 8px rgba(0,0,0,0.08); }
        .group { margin-bottom: 14px; }
        label { display:block; margin-bottom:6px; font-weight:600; color:#334155; }
        input[type="text"], input[type="url"], input[type="number"] { width:100%; padding:10px; border:1px solid #dbe2ea; border-radius:8px; }
        .thumb { width: 220px; height: 130px; object-fit: cover; border-radius: 8px; margin-top: 8px; border:1px solid #e2e8f0; background: #f8fafc; }
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
            <h1>Tambah Testimoni Influencer</h1>
            <p>Isi Data Testimoni Influencer Untuk Ditampilkan Di Halaman Home.</p>
        </div>

        <div class="wrap">
            @if ($errors->any())
                <div class="err">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.testimoni.influencer.store') }}">
                @csrf
                <div class="group">
                    <label>Nama Influencer / Media Review (Opsional)</label>
                    <input id="influencer_name" type="text" name="title" value="{{ old('title') }}" placeholder="Contoh: Nex Carlos / Kuliner Bogor">
                </div>
                <div class="group">
                    <label>URL YouTube</label>
                    <input id="youtube_url" type="url" name="youtube_url" value="{{ old('youtube_url') }}" required placeholder="https://www.youtube.com/...">
                </div>
                <div class="group">
                    <label>Thumbnail HD (Otomatis)</label>
                    <input id="thumbnail_preview_url" type="url" readonly placeholder="Akan Terisi Otomatis Dari URL YouTube">
                    <img id="youtube_thumb_preview" class="thumb" alt="Preview thumbnail YouTube">
                </div>
                <div class="group">
                    <label>Urutan Tampil</label>
                    <input type="number" name="display_order" value="{{ old('display_order', 0) }}" min="0">
                </div>
                <div class="group">
                    <label><input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}> Aktif Ditampilkan</label>
                </div>

                <div class="actions">
                    <a class="btn muted" href="{{ route('admin.testimoni.index') }}">Batal</a>
                    <button class="btn primary" type="submit">Simpan</button>
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
