<?php
namespace App\Services;

class YouTubeService
{
    public function parseVideoId(string $url): ?string
    {
        preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match);
        return $match[1] ?? null;
    }

    public function getEmbedUrl(string $videoId): string
    {
        return "https://www.youtube.com/embed/{$videoId}?autoplay=1&enablejsapi=1";
    }
}
