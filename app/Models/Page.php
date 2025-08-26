<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'status',
        'sort_order',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    // Auto-generate slug from title
    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });
        
        static::updating(function ($page) {
            if ($page->isDirty('title') && empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });
    }

    // Scope for published pages
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Scope for ordered pages
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('title');
    }

    // Get route for frontend
    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Check if page is published
    public function isPublished()
    {
        return $this->status === 'published';
    }
}
