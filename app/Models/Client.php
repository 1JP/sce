<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * Sets the `street` attribute, ensuring it is not an integer and has a maximum length of 100 characters.
     *
     * @param mixed $value The street value to be set
     * @throws \InvalidArgumentException if the street is an integer or exceeds 100 characters
     */
    public function setStreetAttribute($value)
    {
        if (is_int($value)) {
            throw new \InvalidArgumentException('O endereço não pode ser um número inteiro.');
        }

        if (strlen($value) > 100) {
            throw new \InvalidArgumentException('O endereço não pode ter mais que 100 caracteres.');
        }

        $this->attributes['street'] = $value;
    }

    /**
     * Sets the `number` attribute, ensuring it is not an integer and has a maximum length of 45 characters.
     *
     * @param mixed $value The number value to be set
     * @throws \InvalidArgumentException if the number is an integer or exceeds 45 characters
     */
    public function setNumberAttribute($value)
    {
        if (is_int($value)) {
            throw new \InvalidArgumentException('O número não pode ser um número inteiro.');
        }

        if (strlen($value) > 45) {
            throw new \InvalidArgumentException('O número não pode ter mais que 45 caracteres.');
        }

        $this->attributes['number'] = $value;
    }

    /**
     * Sets the `locality` attribute, ensuring it is not an integer and has a maximum length of 45 characters.
     *
     * @param mixed $value The locality value to be set
     * @throws \InvalidArgumentException if the locality is an integer or exceeds 45 characters
     */
    public function setLocalityAttribute($value)
    {
        if (is_int($value)) {
            throw new \InvalidArgumentException('O bairro não pode ser um número inteiro.');
        }

        if (strlen($value) > 45) {
            throw new \InvalidArgumentException('O bairro não pode ter mais que 45 caracteres.');
        }

        $this->attributes['locality'] = $value;
    }

    /**
     * Sets the `city` attribute, ensuring it is not an integer and has a maximum length of 45 characters.
     *
     * @param mixed $value The city value to be set
     * @throws \InvalidArgumentException if the city is an integer or exceeds 45 characters
     */
    public function setCityAttribute($value)
    {
        if (is_int($value)) {
            throw new \InvalidArgumentException('O cidade não pode ser um número inteiro.');
        }

        if (strlen($value) > 45) {
            throw new \InvalidArgumentException('O cidade não pode ter mais que 45 caracteres.');
        }

        $this->attributes['city'] = $value;
    }

    /**
     * Sets the `region_code` attribute, ensuring it is not an integer and has a maximum length of 2 characters.
     *
     * @param mixed $value The region code to be set
     * @throws \InvalidArgumentException if the region code is an integer or exceeds 2 characters
     */
    public function setRegionCodeAttribute($value)
    {
        if (is_int($value)) {
            throw new \InvalidArgumentException('O estado não pode ser um número inteiro.');
        }

        if (strlen($value) > 2) {
            throw new \InvalidArgumentException('O estado não pode ter mais que 2 caracteres.');
        }

        $this->attributes['region_code'] = $value;
    }

    /**
     * Sets the `postal_code` attribute, ensuring it is not an integer and has a maximum length of 8 characters.
     *
     * @param mixed $value The postal code to be set
     * @throws \InvalidArgumentException if the postal code is an integer or exceeds 8 characters
     */
    public function setPostalCodeAttribute($value)
    {
        if (is_int($value)) {
            throw new \InvalidArgumentException('O cep não pode ser um número inteiro.');
        }

        if (strlen($value) > 8) {
            throw new \InvalidArgumentException('O cep não pode ter mais que 8 caracteres.');
        }

        $this->attributes['postal_code'] = $value;
    }

    /**
     * Sets the `complement` attribute, ensuring it is not an integer and has a maximum length of 45 characters.
     *
     * @param mixed $value The complement value to be set
     * @throws \InvalidArgumentException if the complement is an integer or exceeds 45 characters
     */
    public function setComplementAttribute($value)
    {
        if (is_int($value)) {
            throw new \InvalidArgumentException('O complemento não pode ser um número inteiro.');
        }

        if (strlen($value) > 45) {
            throw new \InvalidArgumentException('O complemento não pode ter mais que 45 caracteres.');
        }

        $this->attributes['complement'] = $value;
    }

    /**
     * Sets the `birth_date` attribute, ensuring it is not an integer.
     *
     * @param mixed $value The birth date to be set
     * @throws \InvalidArgumentException if the birth date is an integer
     */
    public function setBirthDateAttribute($value)
    {
        if (is_int($value)) {
            throw new \InvalidArgumentException('O data de nascimento não pode ser um número inteiro.');
        }

        $this->attributes['birth_date'] = $value;
    }

    /**
     * Sets the `cpf` attribute, ensuring it is not an integer and has a maximum length of 11 characters.
     *
     * @param mixed $value The CPF value to be set
     * @throws \InvalidArgumentException if the CPF is an integer or exceeds 11 characters
     */
    public function setCpfAttribute($value)
    {
        if (is_int($value)) {
            throw new \InvalidArgumentException('O cpf não pode ser um número inteiro.');
        }

        if (strlen($value) > 11) {
            throw new \InvalidArgumentException('O cpf não pode ter mais que 11 caracteres.');
        }

        $this->attributes['cpf'] = $value;
    }

    /**
     * Sets the `country` attribute, ensuring it is not an integer and has a maximum length of 2 characters.
     *
     * @param mixed $value The country code to be set
     * @throws \InvalidArgumentException if the country code is an integer or exceeds 2 characters
     */
    public function setCountryAttribute($value)
    {
        if (is_int($value)) {
            throw new \InvalidArgumentException('O código do telefone não pode ser um número inteiro.');
        }

        if (strlen($value) > 11) {
            throw new \InvalidArgumentException('O código do telefone não pode ter mais que 2 caracteres.');
        }

        $this->attributes['country'] = $value;
    }

    /**
     * Sets the `area` attribute, ensuring it is not an integer and has a maximum length of 2 characters.
     *
     * @param mixed $value The area value to be set
     * @throws \InvalidArgumentException if the area is an integer or exceeds 2 characters
     */
    public function setAreaAttribute($value)
    {
        if (is_int($value)) {
            throw new \InvalidArgumentException('O área não pode ser um número inteiro.');
        }

        if (strlen($value) > 2) {
            throw new \InvalidArgumentException('O área não pode ter mais que 2 caracteres.');
        }

        $this->attributes['area'] = $value;
    }

    /**
     * Sets the `phone` attribute, ensuring it is not an integer and has a maximum length of 11 characters.
     *
     * @param mixed $value The phone value to be set
     * @throws \InvalidArgumentException if the phone is an integer or exceeds 11 characters
     */
    public function setPhoneAttribute($value)
    {
        if (is_int($value)) {
            throw new \InvalidArgumentException('O telefone não pode ser um número inteiro.');
        }

        if (strlen($value) > 11) {
            throw new \InvalidArgumentException('O telefone não pode ter mais que 11 caracteres.');
        }

        $this->attributes['phone'] = $value;
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
     * Sets the `cvv` attribute after validating its type.
     *
     * This mutator method checks if the provided `$value` for `cvv`
     * is a string. If it is, an InvalidArgumentException is thrown, as this
     * attribute must not be a string. Otherwise, it sets the `cvv`
     * attribute with the given `$value`.
     *
     * @param mixed $value The value to set for the `cvv` attribute.
     * @throws \InvalidArgumentException if the value is a string.
     */
    public function setCvvAttribute($value)
    {
        if (is_string($value)) {
            throw new \InvalidArgumentException('O cvv não pode ser uma string.');
        }

        $this->attributes['cvv'] = $value;
    }
}
