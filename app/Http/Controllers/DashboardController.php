<?php

namespace App\Http\Controllers;

use App\Models\{Order, User, CartItem, Cart};
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        return $this->clientDashboard($user);
    }

    public function getStats(Request $request)
    {
        $user = Auth::user();
        
        $cartItemsCount = CartItem::join('carts', 'cart_items.cart_id', '=', 'carts.id')
            ->where('carts.user_id', $user->id)
            ->sum('cart_items.quantity');

        $stats = [
            'orders_count' => $user->orders()->count(),
            'cart_items_count' => $cartItemsCount,
            'unread_notifications' => $user->unreadNotifications()->count(),
        ];

        return response()->json($stats);
    }

    private function clientDashboard($user)
    {
        // إحصائيات العميل
        $cartItemsCount = CartItem::join('carts', 'cart_items.cart_id', '=', 'carts.id')
            ->where('carts.user_id', $user->id)
            ->sum('cart_items.quantity');

        $stats = [
            'orders_count' => $user->orders()->count(),
            'cart_items_count' => $cartItemsCount,
            'unread_notifications' => $user->unreadNotifications()->count(),
        ];

        // الطلبات الأخيرة
        $recent_orders = $user->orders()
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($order) {
                return [
                    'id' => $order->id,
                    'uuid' => $order->uuid,
                    'order_number' => $order->order_number,
                    'created_at' => $order->created_at,
                    'status_color' => $this->getStatusColor($order->order_status),
                    'status_text' => $this->getStatusText($order->order_status)
                ];
            });

        // آخر الإشعارات
        $recent_notifications = $user->notifications()
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'stats',
            'recent_orders',
            'recent_notifications'
        ));
    }

    private function getStatusColor($status): string
    {
        return match ($status) {
            'pending' => 'warning',
            'processing' => 'info',
            'completed' => 'success',
            'cancelled' => 'danger',
            default => 'secondary'
        };
    }

    private function getStatusText($status): string
    {
        return match ($status) {
            'pending' => 'قيد الانتظار',
            'processing' => 'قيد المعالجة',
            'completed' => 'مكتمل',
            'cancelled' => 'ملغي',
            default => 'غير معروف'
        };
    }

}
