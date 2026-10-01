<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index(): void
    {
        if (!Auth::check()) {
            $this->json(['notifications' => []]);
            return;
        }

        $notifications = Notification::getUserNotifications(Auth::id());
        $this->json(['success' => true, 'notifications' => $notifications]);
    }

    public function markRead(): void
    {
        if (Auth::check()) {
            Notification::markAllRead(Auth::id());
        }
        $this->json(['success' => true]);
    }
}
