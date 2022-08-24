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

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function scopeSearch($query, string $terms = null)
    {
        if (config('database.default') === 'mysql' || config('database.default') === 'sqlite') {
            collect(explode(' ', $terms))->filter()->each(function ($term) use ($query) {
                $term = '%'.$term.'%';
                $query->where(function ($query) use ($term) {
                    $query->where('first_name', 'like', $term)
                        ->orWhere('last_name', 'like', $term)
                        ->orWhereHas('company', function ($query) use ($term) {
                            $query->where('name', 'like', $term);
                        });
                });
            });
        }

        if (config('database.default') === 'pgsql') {
            collect(explode(' ', $terms))->filter()->each(function ($term) use ($query) {
                $term = '%'.$term.'%';
                $query->where(function ($query) use ($term) {
                    $query->where('first_name', 'ilike', $term)
                        ->orWhere('last_name', 'ilike', $term)
                        ->orWhereHas('company', function ($query) use ($term) {
                            $query->where('name', 'ilike', $term);
                        });
                });
            });
        }
    }
}
