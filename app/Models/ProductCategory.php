<?php

namespace App\Models;

use App\Traits\IsTenantModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ProductCategory extends Model
{
    use HasFactory;
    use IsTenantModel;

    protected $table = 'product_categories';

    protected $fillable = [
        'name',
        'description',
        'parent_category_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'image',
    ];

    protected $appends = ['image_url'];
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_category_id');
    }

    public function getSlugAttribute()
    {
        return Str::slug($this->name);
    }
    /**
     * Get the URL of the image.
     * Defaults to a placeholder if no image is set.
     */
    public function getImageUrlAttribute()
    {
        return  $this->image ? url('/') . asset('storage/' . $this->image) : 'https://fastly.picsum.photos/id/160/200/200.jpg?hmac=0fql9ogVWlCf8ddvQCF-vGiiso9i0m0A68TP5De28tI';
    }
}
