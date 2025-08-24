<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'url',
        'caption',
        'description'
    ];

    /**
     * Get the product that owns the link
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Check if the URL is valid
     */
    public function isValidUrl(): bool
    {
        return filter_var($this->url, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * Get formatted URL with http/https prefix if missing
     */
    public function getFormattedUrlAttribute(): string
    {
        $url = $this->url;
        
        if (!empty($url) && !preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "https://" . $url;
        }
        
        return $url;
    }
}
