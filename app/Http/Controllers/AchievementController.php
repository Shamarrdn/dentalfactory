<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    /**
     * Display a listing of published achievements.
     */
    public function index()
    {
        $achievements = Achievement::published()
                        ->latest()
                        ->paginate(12);

        return view('achievements.index', compact('achievements'));
    }

    /**
     * Display the specified achievement.
     */
    public function show(Achievement $achievement)
    {
        // Check if achievement is published or redirect to 404
        if (!$achievement->isPublished()) {
            abort(404);
        }

        // Increment views count
        $achievement->incrementViews();

        // Get related achievements (exclude current)
        $relatedAchievements = Achievement::published()
                              ->where('id', '!=', $achievement->id)
                              ->latest()
                              ->limit(4)
                              ->get();

        return view('achievements.show', compact('achievement', 'relatedAchievements'));
    }
}
