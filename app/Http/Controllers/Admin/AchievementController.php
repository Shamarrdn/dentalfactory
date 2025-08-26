<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Http\Requests\AchievementRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Achievement::query();

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Status filter
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $achievements = $query->latest()->paginate(15);

        // Debug: Log the count
        \Log::info('Achievements count: ' . $achievements->count());
        \Log::info('Total achievements: ' . $achievements->total());

        return view('admin.achievements.index', compact('achievements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.achievements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AchievementRequest $request)
    {
        \Log::info('=== ACHIEVEMENT FORM SUBMISSION DEBUG START ===');
        \Log::info('Request Details:', [
            'method' => $request->method(),
            'url' => $request->url(),
            'content_type' => $request->header('content-type'),
            'content_length' => $request->header('content-length'),
            'all_input' => $request->all(),
        ]);
        \Log::info('Laravel Request:', [
            'has_file_cover_image' => $request->hasFile('cover_image'),
            'all_files' => $request->file(),
            'input_keys' => array_keys($request->all()),
        ]);
        \Log::info('=== ACHIEVEMENT FORM SUBMISSION DEBUG END ===');

        $validated = $request->validated();
        
        \Log::info('Validated data:', $validated);

        // Handle empty published_at
        if (!isset($validated['published_at']) || empty($validated['published_at'])) {
            $validated['published_at'] = null;
        }

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            \Log::info('Achievement File upload attempt:', [
                'has_file' => $request->hasFile('cover_image'),
                'file_valid' => $request->file('cover_image')->isValid(),
                'original_name' => $request->file('cover_image')->getClientOriginalName(),
                'mime_type' => $request->file('cover_image')->getMimeType(),
                'size' => $request->file('cover_image')->getSize()
            ]);
            
            $imagePath = $request->file('cover_image')->store('achievements', 'public');
            $validated['cover_image'] = $imagePath;
            
            \Log::info('Achievement File stored at:', ['path' => $imagePath]);
        } else {
            \Log::info('No achievement file uploaded or file upload failed');
        }

        // Generate slug from title
        $validated['slug'] = Str::slug($validated['title']);

        // Set published_at if status is published and no date is set
        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        Achievement::create($validated);

        return redirect()->route('admin.achievements.index')
                        ->with('success', 'تم إنشاء الإنجاز بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Achievement $achievement)
    {
        return view('admin.achievements.show', compact('achievement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Achievement $achievement)
    {
        return view('admin.achievements.edit', compact('achievement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AchievementRequest $request, Achievement $achievement)
    {
        $validated = $request->validated();

        // Handle empty published_at
        if (!isset($validated['published_at']) || empty($validated['published_at'])) {
            $validated['published_at'] = null;
        }

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            \Log::info('Achievement File upload attempt (update):', [
                'has_file' => $request->hasFile('cover_image'),
                'file_valid' => $request->file('cover_image')->isValid(),
                'original_name' => $request->file('cover_image')->getClientOriginalName(),
                'mime_type' => $request->file('cover_image')->getMimeType(),
                'size' => $request->file('cover_image')->getSize()
            ]);
            
            // Delete old image if exists
            if ($achievement->cover_image) {
                Storage::disk('public')->delete($achievement->cover_image);
                \Log::info('Deleted old achievement image:', ['path' => $achievement->cover_image]);
            }
            
            $imagePath = $request->file('cover_image')->store('achievements', 'public');
            $validated['cover_image'] = $imagePath;
            
            \Log::info('Achievement File stored at (update):', ['path' => $imagePath]);
        } else {
            \Log::info('No achievement file uploaded or file upload failed (update)');
        }

        // Update slug if title changed
        if ($validated['title'] !== $achievement->title) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Set published_at if status changed to published and no date is set
        if ($validated['status'] === 'published' && empty($validated['published_at']) && $achievement->status !== 'published') {
            $validated['published_at'] = now();
        }

        $achievement->update($validated);

        return redirect()->route('admin.achievements.index')
                        ->with('success', 'تم تحديث الإنجاز بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Achievement $achievement)
    {
        // Delete cover image if exists
        if ($achievement->cover_image) {
            Storage::disk('public')->delete($achievement->cover_image);
        }

        $achievement->delete();

        return redirect()->route('admin.achievements.index')
                        ->with('success', 'تم حذف الإنجاز بنجاح');
    }

    /**
     * Toggle achievement status by ID (publish/unpublish)
     */
    public function toggleStatusById($id)
    {
        try {
            $achievement = Achievement::findOrFail($id);
            
            if ($achievement->status === 'published') {
                $achievement->unpublish();
                $message = 'تم إلغاء نشر الإنجاز';
            } else {
                $achievement->publish();
                $message = 'تم نشر الإنجاز';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'new_status' => $achievement->status
            ]);
        } catch (\Exception $e) {
            \Log::error('Toggle Achievement Status Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ: ' . $e->getMessage()
            ], 500);
        }
    }
}
