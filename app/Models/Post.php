<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Database\Eloquent\Builder;

class Post extends Model
{
    use HasFactory, AppLogModel, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'user_id',
        'category_id',
        'indicative_rating_id',
    ];

    /**
     * Scope a query to only include active students.
     *
     * @param  Builder  $query The query builder to be filtered
     * @return Builder The query builder filtered by active students
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('active', true);
    }

    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function indicative_rating()
    {
        return $this->belongsTo(IndicativeRating::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    /**
     * Sets the `name` attribute, formatting the user's name so that each word 
     * starts with an uppercase letter, while the remaining letters are lowercase.
     *
     * @param string $value The name value provided to the model
     */
    public function setNameAttribute($value)
    {
        if (is_int($value)) {
            throw new \InvalidArgumentException('O nome não pode ser um número inteiro.');
        }

        if (strlen($value) > 100) {
            throw new \InvalidArgumentException('O nome não pode ter mais que 100 caracteres.');
        }

        $this->attributes['name'] = $value;
    }
}
