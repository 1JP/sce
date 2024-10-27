<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     * Defines an inverse one-to-many relationship with the `CategoryType` model.
     *
     * This method indicates that each instance of the current model belongs to
     * a specific category type. It uses the `category_type_id` foreign key to
     * link to the related `CategoryType` record.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(CategoryType::class, 'category_type_id');
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
