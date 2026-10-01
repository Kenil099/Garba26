<?php
namespace App\Models;

use App\Core\Model;

class CircleMember extends Model
{
    protected static string $table = 'circle_members';

    public static function join(int $circleId, int $userId): void
    {
        $check = "SELECT id FROM circle_members WHERE circle_id = :cid AND user_id = :uid";
        if (!static::getDb()->fetch($check, ['cid' => $circleId, 'uid' => $userId])) {
            static::getDb()->insert('circle_members', [
                'circle_id' => $circleId,
                'user_id'   => $userId,
                'joined_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }

    public static function leave(int $circleId, int $userId): void
    {
        static::getDb()->delete('circle_members', 'circle_id = :cid AND user_id = :uid', [
            'cid' => $circleId,
            'uid' => $userId,
        ]);
    }
}
