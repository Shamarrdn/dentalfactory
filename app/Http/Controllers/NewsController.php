<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of published news.
     */
    public function index(Request $request)
    {
        $query = News::published();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $news = $query->latest()->paginate(12);

        return view('news.index', compact('news'));
    }

    /**
     * Display the specified news article.
     */
    public function show(News $news)
    {
        // Make sure the news is published
        if (!$news->isPublished()) {
            abort(404);
        }

        // Increment views count
        $news->incrementViews();

        // Get related news (latest 4 news excluding current one)
        $relatedNews = News::published()
                          ->where('id', '!=', $news->id)
                          ->latest()
                          ->limit(4)
                          ->get();

        return view('news.show', compact('news', 'relatedNews'));
    }
}
