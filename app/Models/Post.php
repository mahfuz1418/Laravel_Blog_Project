<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];
    public function tagsRelation()
    {
        return $this->belongsToMany(Tag::class, 'post_tags','post_id','tag_id')->withTimestamps();
    }
    public function categoryRelation()
    {
        return $this->belongsTo(Category::class, 'post_category', 'id');
    }
    public function subcategoryRelation()
    {
        return $this->belongsTo(SubCategory::class, 'post_subcategory', 'id');
    }
    public function userRelation()
    {
        return $this->belongsTo(User::class, 'writer', 'id');
    }
}
