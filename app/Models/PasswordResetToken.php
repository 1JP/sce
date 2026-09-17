<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    protected $table = 'password_reset_tokens';

    public $timestamps = false;

    protected $fillable = [
        'email',
        'token',
        'created_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
    ];

    // Opcional: verificar se o token expirou (padrão: 60 minutos)
    public function isExpired()
    {
        return $this->created_at->addMinutes(config('auth.passwords.users.expire', 60))->isPast();
    }
}
