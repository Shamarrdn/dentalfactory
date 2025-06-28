<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // عرض جميع المنتجات المتاحة كـ featuredProducts
        $featuredProducts = Product::with(['category', 'images', 'colors'])
            ->where('is_available', true)
            ->get();

        foreach ($featuredProducts as $product) {
            if ($product->colors->isNotEmpty()) {
                $product->colors->transform(function ($color) {
                    if (!isset($color->color_code) || empty($color->color_code)) {
                        $color->color_code = $color->color ?? '#000000';
                    }
                    return $color;
                });
            }
        }

        $discountedProducts = Product::where('is_available', true)
            ->whereHas('discounts', function($q) {
                $q->where('is_active', 1)
                  ->where('expires_at', '>', now());
            })
            ->with(['images', 'discounts'])
            ->get();

        $currentPage = $request->get('page', 1);
        $perPage = 2;
        $totalPages = 1;
        $coupons = collect(); // لم نعد بحاجة للكوبونات هنا

        $topCategories = Category::withCount('products')
            ->orderBy('products_count', 'desc')
            ->take(5)
            ->get();

        return view('index', compact(
            'featuredProducts',
            'discountedProducts',
            'coupons',
            'currentPage',
            'totalPages',
            'topCategories'
        ));
    }
}
