<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, AppLogModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * Defines an inverse belongs-to-many relationship with the `CategoryType` model.
     *
     * This method indicates that each instance of the current model belongs to
     * a specific category type. It uses the `category_type_id` foreign key to
     * link to the related `CategoryType` record.
     *
     * @return \Illuminate\Database\Eloquent\Relations\belongsToMany
     */
    public function categoryTypes()
    {
        return $this->belongsToMany(CategoryType::class, 'category_types_categories');
    }

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

    public function posts()
    {
        return $this->hasMany(Post::class);
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

        if (strlen($value) > 45) {
            throw new \InvalidArgumentException('O nome não pode ter mais que 45 caracteres.');
        }

        $this->attributes['name'] = $value;
    }
}
