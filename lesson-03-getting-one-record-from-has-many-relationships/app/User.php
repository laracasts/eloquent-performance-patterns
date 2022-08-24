<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function logins()
    {
        return $this->hasMany(Login::class);
    }

    public function scopeWithLastLoginAt($query)
    {
        $query->addSelect(['last_login_at' => Login::select('created_at')
                ->whereColumn('user_id', 'users.id')
                ->latest()
                ->take(1)
            ])
            ->withCasts(['last_login_at' => 'datetime']);
    }
}
