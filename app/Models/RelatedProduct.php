<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RelatedProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'related_product_id',
        'type'
    ];

    /**
     * The product that has the related products
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * The related product
     */
    public function relatedProduct(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'related_product_id');
    }

    /**
     * Scope to filter by type
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope to get frequently bought together products
     */
    public function scopeFrequentlyBoughtTogether($query)
    {
        return $query->where('type', 'frequently_bought_together');
    }

    /**
     * Scope to get recommended products
     */
    public function scopeRecommended($query)
    {
        return $query->where('type', 'recommended');
    }

    /**
     * Scope to get similar products
     */
    public function scopeSimilar($query)
    {
        return $query->where('type', 'similar');
    }
}