<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Category extends Model
{
    use HasFactory;
    
    protected $table = 'categories';
    protected $fillable = [
        'name', 'slug',
    ];

    public function post()
    {
        return $this->hasMany(Post::class,'category_id');
    }
}