<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function setNameAttribute($value)
    {
        if (is_int($value)) {
            throw new \InvalidArgumentException('O nome não pode ser um número inteiro.');
        }

        $this->attributes['name'] = $value;
    }

    public function setEmailAttribute($value)
    {
        if (is_int($value)) {
            throw new \InvalidArgumentException('O e-mail não pode ser um número inteiro.');
        }

        $this->attributes['email'] = $value;
    }

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

    public function setBirthDateAttribute($value)
    {
        if (is_int($value)) {
            throw new \InvalidArgumentException('O data de nascimento não pode ser um número inteiro.');
        }

        $this->attributes['birth_date'] = $value;
    }

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
}
