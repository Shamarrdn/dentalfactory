<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PageRequest;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Page::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('slug', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pages = $query->ordered()->paginate(15)->appends($request->query());

        return view('admin.pages.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request)
    {
        $data = $request->validated();
        
        // Auto-generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        // Set default sort order
        if (empty($data['sort_order'])) {
            $maxOrder = Page::max('sort_order') ?? 0;
            $data['sort_order'] = $maxOrder + 1;
        }

        Page::create($data);

        return redirect()->route('admin.pages.index')
            ->with('success', 'تم إنشاء الصفحة بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        return view('admin.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageRequest $request, Page $page)
    {
        $data = $request->validated();
        
        // Auto-generate slug if not provided
        if (empty($data['slug'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $page->update($data);

        return redirect()->route('admin.pages.index')
            ->with('success', 'تم تحديث الصفحة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        $page->delete();

        return redirect()->route('admin.pages.index')
            ->with('success', 'تم حذف الصفحة بنجاح');
    }

    /**
     * Update sort order via AJAX
     */
    public function updateOrder(Request $request)
    {
        $request->validate([
            'pages' => 'required|array',
            'pages.*.id' => 'required|exists:pages,id',
            'pages.*.sort_order' => 'required|integer|min:0',
        ]);

        foreach ($request->pages as $pageData) {
            Page::where('id', $pageData['id'])
                ->update(['sort_order' => $pageData['sort_order']]);
        }

        return response()->json(['success' => true, 'message' => 'تم تحديث الترتيب بنجاح']);
    }

    /**
     * Toggle page status
     */
    public function toggleStatus(Page $page)
    {
        $page->update([
            'status' => $page->status === 'published' ? 'draft' : 'published'
        ]);

        $message = $page->status === 'published' 
            ? 'تم نشر الصفحة بنجاح' 
            : 'تم إخفاء الصفحة بنجاح';

        return redirect()->back()->with('success', $message);
    }

    /**
     * Upload image for WYSIWYG editor
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120', // 5MB max
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // Generate unique filename
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Store in public/uploads/pages directory
            $path = $image->storeAs('uploads/pages', $filename, 'public');
            
            // Return the URL
            $url = asset('storage/' . $path);
            
            return response()->json([
                'success' => true,
                'url' => $url,
                'message' => 'تم رفع الصورة بنجاح'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'فشل في رفع الصورة'
        ], 400);
    }
}
