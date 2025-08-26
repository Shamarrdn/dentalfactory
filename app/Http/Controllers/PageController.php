<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display the specified page by slug
     */
    public function show($slug)
    {
        $page = Page::where('slug', $slug)
            ->published()
            ->firstOrFail();

        return view('pages.show', compact('page'));
    }

    /**
     * Get published pages for navigation
     */
    public function getNavigationPages()
    {
        return Page::published()
            ->ordered()
            ->get(['id', 'title', 'slug']);
    }
}
