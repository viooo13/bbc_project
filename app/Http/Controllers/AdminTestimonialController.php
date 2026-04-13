<?php

namespace App\Http\Controllers;

use App\Models\InfluencerTestimonial;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminTestimonialController extends Controller
{
    public function index()
    {
        $influencerTestimonials = InfluencerTestimonial::orderBy('display_order')->latest('id')->get();
        $customerTestimonials = Testimonial::latest()->get();

        return view('admin.testimoni.index', compact('influencerTestimonials', 'customerTestimonials'));
    }

    public function createInfluencer()
    {
        return view('admin.testimoni.create');
    }

    public function storeInfluencer(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'youtube_url' => 'required|url|max:255',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['thumbnail'] = InfluencerTestimonial::makeYoutubeThumbnailUrl($validated['youtube_url']);
        $validated['title'] = $this->normalizeInfluencerName($validated['title'] ?? null);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['display_order'] = (int) ($validated['display_order'] ?? 0);

        InfluencerTestimonial::create($validated);

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni influencer berhasil ditambahkan.');
    }

    public function editInfluencer($id)
    {
        $influencerTestimonial = InfluencerTestimonial::findOrFail($id);

        return view('admin.testimoni.edit', compact('influencerTestimonial'));
    }

    public function updateInfluencer(Request $request, $id)
    {
        $influencerTestimonial = InfluencerTestimonial::findOrFail($id);

        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'youtube_url' => 'required|url|max:255',
            'display_order' => 'nullable|integer|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['thumbnail'] = InfluencerTestimonial::makeYoutubeThumbnailUrl($validated['youtube_url']);
        $validated['title'] = $this->normalizeInfluencerName($validated['title'] ?? null);

        $validated['is_active'] = $request->boolean('is_active');
        $validated['display_order'] = (int) ($validated['display_order'] ?? 0);

        $influencerTestimonial->update($validated);

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni influencer berhasil diperbarui.');
    }

    public function destroyInfluencer($id)
    {
        $influencerTestimonial = InfluencerTestimonial::findOrFail($id);

        $influencerTestimonial->delete();

        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni influencer berhasil dihapus.');
    }

    public function replyCustomer(Request $request, $id)
    {
        $validated = $request->validate([
            'admin_reply' => 'nullable|string|max:2000',
        ]);

        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update([
            'admin_reply' => $validated['admin_reply'] ?? null,
        ]);

        return redirect()->route('admin.testimoni.index')->with('success', 'Balasan ulasan berhasil diperbarui.');
    }

    public function destroyCustomer($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->route('admin.testimoni.index')->with('success', 'Ulasan pelanggan berhasil dihapus.');
    }

    private function normalizeInfluencerName(?string $name): ?string
    {
        $name = trim((string) $name);

        if ($name === '') {
            return null;
        }

        $acronyms = [
            'tv' => 'TV',
            'tvri' => 'TVRI',
            'bbc' => 'BBC',
            'rcti' => 'RCTI',
            'sctv' => 'SCTV',
            'mnc' => 'MNC',
            'net' => 'NET',
            'cnn' => 'CNN',
            'id' => 'ID',
        ];

        return collect(preg_split('/\s+/', $name) ?: [])
            ->map(function (string $part) use ($acronyms) {
                return collect(explode('-', $part))
                    ->map(function (string $segment) use ($acronyms) {
                        $cleanSegment = strtolower($segment);

                        if (isset($acronyms[$cleanSegment])) {
                            return $acronyms[$cleanSegment];
                        }

                        return Str::of($cleanSegment)->headline()->toString();
                    })
                    ->implode('-');
            })
            ->implode(' ');
    }
}
