<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    /**
     * Get all notifications for the current user (API JSON).
     */
    public function index()
    {
        $user = Auth::user();
        $notifications = Notification::forUser($user->id)
            ->orderBy('created_at', 'desc')
            ->limit(30)
            ->get();

        $unreadCount = Notification::forUser($user->id)->unread()->count();

        return response()->json([
            'notifications' => $notifications,
            'unread_count'  => $unreadCount,
        ]);
    }

    /**
     * Mark a single notification as read.
     */
    public function markAsRead($id)
    {
        $notification = Notification::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $notification->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead()
    {
        Notification::forUser(Auth::id())
            ->unread()
            ->update(['read_at' => now()]);

        return response()->json(['success' => true]);
    }

    /**
     * Delete a notification.
     */
    public function destroy($id)
    {
        Notification::where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        return response()->json(['success' => true]);
    }

    /**
     * Static helper: create a notification for one user.
     */
    public static function notify(int $userId, string $type, string $title, string $message, ?string $link = null): void
    {
        Notification::create([
            'user_id' => $userId,
            'type'    => $type,
            'title'   => $title,
            'message' => $message,
            'link'    => $link,
        ]);
    }

    /**
     * Static helper: notify all admin users.
     */
    public static function notifyAdmins(string $type, string $title, string $message, ?string $link = null): void
    {
        $admins = \App\Models\User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            self::notify($admin->id, $type, $title, $message, $link);
        }
    }
}
