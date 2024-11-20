<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

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
