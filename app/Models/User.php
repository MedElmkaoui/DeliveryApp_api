<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password', 
        'username', 
        'role',
        'enable_pin',
        'pin',
    ];

    // Manager of the user
    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    // Users managed by this user
    public function subordinates()
    {
        return $this->hasMany(User::class, 'manager_id');
    }
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
