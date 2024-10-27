<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    public const ACTIVE = 'ACTIVE';
    public const EXPIRED = 'EXPIRED';
    public const CANCELED = 'CANCELED';
    public const SUSPENDED = 'SUSPENDED';
    public const OVERDUE = 'OVERDUE';
    public const TRIAL = 'TRIAL';
    public const PENDING = 'PENDING';
    public const PENDING_ACTION = 'PENDING_ACTION';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * Scope a query to only include active students.
     *
     * @param  Builder  $query The query builder to be filtered
     * @return Builder The query builder filtered by active students
     */
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('status', 'ACTIVE');
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
}
