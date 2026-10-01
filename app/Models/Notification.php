<?php
namespace App\Models;

use App\Core\Model;

class Notification extends Model
{
    protected static string $table = 'notifications';

    public static function getUserNotifications(int $userId): array
    {
        return static::where('user_id', $userId, 'created_at DESC');
    }

    public static function getUnreadCount(int $userId): int
    {
        return static::count('user_id = :uid AND is_read = 0', ['uid' => $userId]);
    }

    public static function markAllRead(int $userId): void
    {
        static::getDb()->update('notifications', ['is_read' => 1], 'user_id = :uid', ['uid' => $userId]);
    }
}
