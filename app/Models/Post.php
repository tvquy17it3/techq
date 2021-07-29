<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'slug', 'body', 'user_id','thumbnail'
    ];

    public function author()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeUnpublished($query)
    {
        return $query->where('published', false);
    }
    
    public function scopeCheckslug($query, String $slug, int $post_id)
    {
        $Check = $query->where('slug', $slug)->get();
        if(count($Check)>0){
            return ($post_id==$Check[0]->id) ? true : false;
        }
        return true;
    }
}