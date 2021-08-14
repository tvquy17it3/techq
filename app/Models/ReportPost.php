<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class ReportPost extends Model
{
    use HasFactory;

    protected $table = 'report_posts';
    protected $fillable = [
        'content', 'post_id','user_id',
    ];

    public function post()
    {
       return $this->belongsTo(Post::class,'post_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class,'user_id')->withTrashed();
    }
}
