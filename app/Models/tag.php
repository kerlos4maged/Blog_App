<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    //
    protected $fillable = [
        'name',
        'slug',
    ];

    public function posts()
    {
        return $this->belongsToMany(posts::class, 'post_tag', 'post_id', 'tag_id');
    }
}
