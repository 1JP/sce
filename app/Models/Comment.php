<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, AppLogModel, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class, 'comment_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'comment_id');
    }

    public function links()
    {
        return $this->hasMany(Link::class);
    }

    public function deslinks()
    {
        return $this->hasMany(DesLink::class);
    }
}
