<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'product_id',
        'category_id',
        'title',
        'slug',
        'regular_price',
        'sale_price',
        'short_description',
        'description',
        'features',
        'product_link',
        'image_url',
        'local_image_path',
        'whatsapp_order_link',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'features' => 'array',
        'regular_price' => 'decimal:2',
        'sale_price' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}