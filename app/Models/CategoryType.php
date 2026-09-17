<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryType extends Model
{
    use HasFactory, AppLogModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * Define a many-to-many relationship with the Category model.
     *
     * This method indicates that a category type can be associated with multiple
     * categories, and a category can be associated with multiple category types.
     * 
     * The pivot table used to store these associations is 'category_types_categories'.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_types_categories');
    }

    /**
     * Sets the `name` attribute and ensures it is not an integer.
     *
     * @param mixed $value The name value to be set
     * @throws \InvalidArgumentException if the name is an integer
     */
    public function setNameAttribute($value)
    {
        if (is_int($value)) {
            throw new \InvalidArgumentException('O nome não pode ser um número inteiro.');
        }

        $this->attributes['name'] = $value;
    }
    
    /**
     * Sets the `name` attribute and ensures it is not an integer.
     *
     * @param mixed $value The name value to be set
     * @throws \InvalidArgumentException if the name is an integer
     */
    public function setDescriptionAttribute($value)
    {
        if (is_int($value)) {
            throw new \InvalidArgumentException('A descrição não pode ser um número inteiro.');
        }

        $this->attributes['description'] = $value;
    }

}
