<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BlogPost extends Model
{
    const UNKNOWN_USER = 1;

    use SoftDeletes;

    protected $fillable  = [
        'title',
        'slug',
        'category_id',
        'content_raw',
        'content_html',
        'is_published'
    ];

    public function category(){
        return $this->belongsTo(BlogCategory::class);
    }

    public function author(){
        return $this->belongsTo(User::class,'user_id','id');
    }

}
