<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class InfluencerTestimonial extends Model
{
    use HasFactory;

    private const DEFAULT_THUMBNAIL = 'https://placehold.co/420x240/ffffff/3a2a1a?text=Influencer';

    protected $fillable = [
        'title',
        'thumbnail',
        'youtube_url',
        'is_active',
        'display_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'display_order' => 'integer',
    ];

    public static function makeYoutubeThumbnailUrl(?string $youtubeUrl): ?string
    {
        $videoId = self::extractYoutubeVideoIdFromUrl($youtubeUrl);

        if (!$videoId) {
            return null;
        }

        return "https://i.ytimg.com/vi/{$videoId}/maxresdefault.jpg";
    }

    public function getThumbnailUrlAttribute(): string
    {
        if (!empty($this->thumbnail)) {
            if (Str::startsWith($this->thumbnail, ['http://', 'https://'])) {
                return $this->thumbnail;
            }

            return asset($this->thumbnail);
        }

        return self::makeYoutubeThumbnailUrl($this->youtube_url) ?? self::DEFAULT_THUMBNAIL;
    }

    private static function extractYoutubeVideoIdFromUrl(?string $url): ?string
    {
        if (!$url) {
            return null;
        }

        if (preg_match('/(?:youtube\.com\/(?:watch\?(?:.*&)?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/i', $url, $matches)) {
            return $matches[1];
        }

        return null;
    }
}
