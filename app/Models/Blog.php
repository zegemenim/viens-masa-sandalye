<?php

namespace App\Models;

use App\Services\ImageWebpOptimizer;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = ['title', 'slug', 'content', 'image_path'];

    public function seoMeta()
    {
        return $this->morphOne(SeoMeta::class, 'seoable');
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::saving(function ($blog) {
            if ($blog->isDirty('image_path') && ! empty($blog->image_path)) {
                $blog->image_path = ImageWebpOptimizer::convert($blog->image_path, 80);
            }
        });
    }
}
