<?php

namespace App\Models;

use Filament\Support\Concerns\HasMediaFilter;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class posts extends Model implements HasMedia
{
    //
    use InteractsWithMedia;
    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'content',
        'is_published',
    ];

    protected $casts = [
        "is_published" => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(category::class);
    }
    function tags()
    {
        return $this->belongsToMany(tag::class, 'post_tag', 'post_id', 'tag_id');
    }
}
