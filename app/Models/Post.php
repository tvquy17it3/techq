<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'slug', 'body', 'user_id','thumbnail'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
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
