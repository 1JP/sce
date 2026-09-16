<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostRating extends Model
{
    protected $fillable = ['post_id', 'user_id', 'rating'];

    /**
     * Get the post this record belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the user that owns this record.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
