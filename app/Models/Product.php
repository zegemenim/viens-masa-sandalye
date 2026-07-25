<?php

namespace App\Models;

use App\Services\ImageWebpOptimizer;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id', 'name', 'slug', 'sku',
        'price', 'description', 'stock_status', 'image_path',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function seoMeta()
    {
        return $this->morphOne(SeoMeta::class, 'seoable');
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::saving(function ($product) {
            if ($product->isDirty('image_path') && ! empty($product->image_path)) {
                $product->image_path = ImageWebpOptimizer::convert($product->image_path, 80);
            }
        });
    }
}
