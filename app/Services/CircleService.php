<?php
namespace App\Services;

use App\Models\Circle;
use App\Models\CircleMember;

class CircleService
{
    public function createCircle(int $hostUserId, string $name): array
    {
        $code = strtoupper(substr(md5(uniqid(mt_rand(), true)), 0, 8));
        $circleId = Circle::create([
            'code'         => $code,
            'name'         => trim($name),
            'host_user_id' => $hostUserId,
            'is_playing'   => 0,
            'current_playback_time' => 0.0,
        ]);

        CircleMember::join($circleId, $hostUserId);

        return ['id' => $circleId, 'code' => $code, 'name' => $name];
    }

    public function joinCircle(string $code, int $userId): ?array
    {
        $circle = Circle::findByCode($code);
        if (!$circle) {
            return null;
        }
        CircleMember::join($circle['id'], $userId);
        return $circle;
    }
}
