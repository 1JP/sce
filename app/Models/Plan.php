<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $guarded = [];

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

        if (strlen($value) > 65) {
            throw new \InvalidArgumentException('O nome não pode ter mais que 65 caracteres.');
        }

        $this->attributes['name'] = $value;
    }

    /**
     * Sets the `description` attribute and ensures it is not an integer.
     *
     * @param mixed $value The description value to be set
     * @throws \InvalidArgumentException if the description is an integer
     */
    public function setDescriptionAttribute($value)
    {
        if (is_int($value)) {
            throw new \InvalidArgumentException('A descrição não pode ser um número inteiro.');
        }

        if (strlen($value) > 250) {
            throw new \InvalidArgumentException('A descrição não pode ter mais que 250 caracteres.');
        }

        $this->attributes['description'] = $value;
    }
    
    /**
     * Sets the `number_film` attribute after validating its type.
     *
     * This mutator method checks if the provided `$value` for `number_film`
     * is a string. If it is, an InvalidArgumentException is thrown, as this
     * attribute must not be a string. Otherwise, it sets the `number_film`
     * attribute with the given `$value`.
     *
     * @param mixed $value The value to set for the `number_film` attribute.
     * @throws \InvalidArgumentException if the value is a string.
     */
    public function setNumberFilmAttribute($value)
    {
        if (is_string($value)) {
            throw new \InvalidArgumentException('O número de filmes não pode ser uma string.');
        }

        $this->attributes['number_film'] = $value;
    }

    /**
     * Sets the `number_book` attribute after validating its type.
     *
     * This mutator method checks if the provided `$value` for `number_book`
     * is a string. If it is, an InvalidArgumentException is thrown, as this
     * attribute must not be a string. Otherwise, it sets the `number_book`
     * attribute with the given `$value`.
     *
     * @param mixed $value The value to set for the `number_book` attribute.
     * @throws \InvalidArgumentException if the value is a string.
     */
    public function setNumberBookAttribute($value)
    {
        if (is_string($value)) {
            throw new \InvalidArgumentException('O número de livros não pode ser uma string.');
        }

        $this->attributes['number_book'] = $value;
    }

    /**
     * Sets the `number_serie` attribute after validating its type.
     *
     * This mutator method checks if the provided `$value` for `number_serie`
     * is a string. If it is, an InvalidArgumentException is thrown, as this
     * attribute must not be a string. Otherwise, it sets the `number_serie`
     * attribute with the given `$value`.
     *
     * @param mixed $value The value to set for the `number_serie` attribute.
     * @throws \InvalidArgumentException if the value is a string.
     */
    public function setNumberSerieAttribute($value)
    {
        if (is_string($value)) {
            throw new \InvalidArgumentException('O número de séries não pode ser uma string.');
        }

        $this->attributes['number_serie'] = $value;
    }

    /**
     * Sets the `value` attribute after validating its type.
     *
     * This mutator method checks if the provided `$value` is either an integer
     * or a string. If it is, an InvalidArgumentException is thrown, as this
     * attribute must not be a string or an integer. Otherwise, it sets the 
     * `value` attribute with the given `$value`.
     *
     * @param mixed $value The value to set for the `value` attribute.
     * @throws \InvalidArgumentException if the value is an integer or a string.
     */
    public function setValueAttribute($value)
    {
        if (is_int($value) || is_string($value)) {
            throw new \InvalidArgumentException('O número de séries não pode ser uma string/inteiro.');
        }

        $this->attributes['value'] = $value;
    }

    /**
     * Sets the `customer_id` attribute and ensures it is not an integer.
     *
     * @param mixed $value The customer_id value to be set
     * @throws \InvalidArgumentException if the customer_id is an integer
     */
    public function setCustomerIdAttribute($value)
    {
        if (is_int($value)) {
            throw new \InvalidArgumentException('O nome não pode ser um número inteiro.');
        }

        if (strlen($value) > 100) {
            throw new \InvalidArgumentException('O nome não pode ter mais que 100 caracteres.');
        }

        $this->attributes['customer_id'] = $value;
    }

    /**
     * Sets the `active` attribute after validating its type.
     *
     * This mutator method checks if the provided `$value` is a string. If it is,
     * an InvalidArgumentException is thrown, as this attribute must not be a string.
     * Otherwise, it sets the `active` attribute with the given `$value`.
     *
     * @param mixed $value The value to set for the `active` attribute.
     * @throws \InvalidArgumentException if the value is a string.
     */
    public function setActiveAttribute($value)
    {
        if (is_string($value)) {
            throw new \InvalidArgumentException('O nome não pode ser uma string.');
        }

        $this->attributes['active'] = $value;
    }
}
