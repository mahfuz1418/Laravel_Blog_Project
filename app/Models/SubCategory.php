<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use HasFactory , SoftDeletes;

    public function CategoryRelation() 
    {
        return $this->belongsTo(Category::class,"parent_id", "id");
    }
}
