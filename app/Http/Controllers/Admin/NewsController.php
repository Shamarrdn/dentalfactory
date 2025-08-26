<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = News::query();

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

        $news = $query->latest()->paginate(15);

        // Debug: Log the count
        \Log::info('News count: ' . $news->count());
        \Log::info('Total news: ' . $news->total());

        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \Log::info('=== FORM SUBMISSION DEBUG START ===');
        \Log::info('Request Details:', [
            'method' => $request->method(),
            'url' => $request->url(),
            'content_type' => $request->header('content-type'),
            'content_length' => $request->header('content-length'),
        ]);
        \Log::info('Laravel Request:', [
            'has_file_cover_image' => $request->hasFile('cover_image'),
            'all_files' => $request->file(),
            'input_keys' => array_keys($request->all()),
        ]);
        \Log::info('PHP Globals:', [
            'POST_keys' => array_keys($_POST ?? []),
            'FILES_exists' => isset($_FILES),
            'FILES_keys' => isset($_FILES) ? array_keys($_FILES) : 'No $_FILES',
            'FILES_cover_image' => $_FILES['cover_image'] ?? 'Not found'
        ]);
        \Log::info('=== FORM SUBMISSION DEBUG END ===');

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'content' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:published,draft',
            'published_at' => 'nullable|date'
        ]);

        // Handle empty published_at
        if (!isset($validated['published_at']) || empty($validated['published_at'])) {
            $validated['published_at'] = null;
        }

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            \Log::info('File upload attempt:', [
                'has_file' => $request->hasFile('cover_image'),
                'file_valid' => $request->file('cover_image')->isValid(),
                'original_name' => $request->file('cover_image')->getClientOriginalName(),
                'mime_type' => $request->file('cover_image')->getMimeType(),
                'size' => $request->file('cover_image')->getSize()
            ]);
            
            $imagePath = $request->file('cover_image')->store('news', 'public');
            $validated['cover_image'] = $imagePath;
            
            \Log::info('File stored at:', ['path' => $imagePath]);
        } else {
            \Log::info('No file uploaded or file upload failed');
        }

        // Generate slug from title
        $validated['slug'] = Str::slug($validated['title']);

        // Set published_at if status is published and no date is set
        if ($validated['status'] === 'published' && empty($validated['published_at'])) {
            $validated['published_at'] = now();
        }

        News::create($validated);

        return redirect()->route('admin.news.index')
                        ->with('success', 'تم إنشاء الخبر بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'content' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:published,draft',
            'published_at' => 'nullable|date'
        ]);

        // Handle empty published_at
        if (!isset($validated['published_at']) || empty($validated['published_at'])) {
            $validated['published_at'] = null;
        }

        // Handle cover image upload
        if ($request->hasFile('cover_image')) {
            \Log::info('File upload attempt (update):', [
                'has_file' => $request->hasFile('cover_image'),
                'file_valid' => $request->file('cover_image')->isValid(),
                'original_name' => $request->file('cover_image')->getClientOriginalName(),
                'mime_type' => $request->file('cover_image')->getMimeType(),
                'size' => $request->file('cover_image')->getSize()
            ]);
            
            // Delete old image if exists
            if ($news->cover_image) {
                Storage::disk('public')->delete($news->cover_image);
                \Log::info('Deleted old image:', ['path' => $news->cover_image]);
            }
            
            $imagePath = $request->file('cover_image')->store('news', 'public');
            $validated['cover_image'] = $imagePath;
            
            \Log::info('File stored at (update):', ['path' => $imagePath]);
        } else {
            \Log::info('No file uploaded or file upload failed (update)');
        }

        // Update slug if title changed
        if ($validated['title'] !== $news->title) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        // Set published_at if status changed to published and no date is set
        if ($validated['status'] === 'published' && empty($validated['published_at']) && $news->status !== 'published') {
            $validated['published_at'] = now();
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')
                        ->with('success', 'تم تحديث الخبر بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        // Delete cover image if exists
        if ($news->cover_image) {
            Storage::disk('public')->delete($news->cover_image);
        }

        $news->delete();

        return redirect()->route('admin.news.index')
                        ->with('success', 'تم حذف الخبر بنجاح');
    }

    /**
     * Toggle news status by ID (publish/unpublish)
     */
    public function toggleStatusById($id)
    {
        try {
            $news = News::findOrFail($id);
            
            if ($news->status === 'published') {
                $news->unpublish();
                $message = 'تم إلغاء نشر الخبر';
            } else {
                $news->publish();
                $message = 'تم نشر الخبر';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
                'new_status' => $news->status
            ]);
        } catch (\Exception $e) {
            \Log::error('Toggle Status Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'حدث خطأ: ' . $e->getMessage()
            ], 500);
        }
    }
}
