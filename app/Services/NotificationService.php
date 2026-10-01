<?php
namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    public function getUserNotifications(int $userId): array
    {
        return Notification::getUserNotifications($userId);
    }

    public function markAllAsRead(int $userId): void
    {
        Notification::markAllRead($userId);
    }
}
