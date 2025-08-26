<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'content',
        'cover_image',
        'status',
        'published_at',
        'views_count'
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    protected $dates = [
        'published_at'
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
            
            // Ensure unique slug
            $originalSlug = $news->slug;
            $counter = 1;
            while (static::where('slug', $news->slug)->exists()) {
                $news->slug = $originalSlug . '-' . $counter;
                $counter++;
            }
        });

        static::updating(function ($news) {
            if ($news->isDirty('title') && !$news->isDirty('slug')) {
                $news->slug = Str::slug($news->title);
                
                // Ensure unique slug
                $originalSlug = $news->slug;
                $counter = 1;
                while (static::where('slug', $news->slug)->where('id', '!=', $news->id)->exists()) {
                    $news->slug = $originalSlug . '-' . $counter;
                    $counter++;
                }
            }
        });
    }

    /**
     * Scope a query to only include published news.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', now());
    }

    /**
     * Scope a query to only include draft news.
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    /**
     * Scope a query to order by latest.
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc')->orderBy('created_at', 'desc');
    }

    /**
     * Get the cover image URL.
     */
    public function getCoverImageUrlAttribute()
    {
        if ($this->cover_image) {
            return Storage::url($this->cover_image);
        }
        
        // Use local SVG placeholder
        return asset('assets/images/default-news.svg');
    }

    /**
     * Get formatted published date.
     */
    public function getFormattedPublishedDateAttribute()
    {
        if (!$this->published_at) {
            return null;
        }
        
        return $this->published_at->format('Y-m-d H:i');
    }

    /**
     * Get formatted published date in Arabic.
     */
    public function getArabicPublishedDateAttribute()
    {
        if (!$this->published_at) {
            return null;
        }
        
        return $this->published_at->locale('ar')->isoFormat('LLLL');
    }

    /**
     * Get short content excerpt.
     */
    public function getExcerptAttribute($length = 150)
    {
        return Str::limit(strip_tags($this->content), $length);
    }

    /**
     * Check if news is published.
     */
    public function isPublished()
    {
        return $this->status === 'published' 
               && $this->published_at 
               && $this->published_at <= now();
    }

    /**
     * Check if news is draft.
     */
    public function isDraft()
    {
        return $this->status === 'draft';
    }

    /**
     * Publish the news.
     */
    public function publish()
    {
        $this->update([
            'status' => 'published',
            'published_at' => $this->published_at ?: now()
        ]);
    }

    /**
     * Unpublish the news (make it draft).
     */
    public function unpublish()
    {
        $this->update([
            'status' => 'draft',
            'published_at' => null
        ]);
    }

    /**
     * Get reading time estimate in minutes.
     */
    public function getReadingTimeAttribute()
    {
        $wordCount = str_word_count(strip_tags($this->content));
        $wordsPerMinute = 200; // Average reading speed
        return max(1, ceil($wordCount / $wordsPerMinute));
    }

    /**
     * Increment views count.
     */
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    /**
     * Get formatted views count.
     */
    public function getFormattedViewsAttribute()
    {
        if ($this->views_count >= 1000000) {
            return number_format($this->views_count / 1000000, 1) . 'M';
        } elseif ($this->views_count >= 1000) {
            return number_format($this->views_count / 1000, 1) . 'K';
        }
        return number_format($this->views_count);
    }
}
