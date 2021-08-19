<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogReview extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function blogpost(){
        return $this->belongsTo(BlogPost::class,'blog_id','id');
    }
}
