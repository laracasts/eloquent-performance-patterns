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
        if (config('database.default') === 'mysql') {
            collect(str_getcsv($terms, ' ', '"'))->filter()->each(function ($term) use ($query) {
                $term = preg_replace('/[^A-Za-z0-9]/', '', $term).'%';
                $query->whereIn('id', function ($query) use ($term) {
                    $query->select('id')
                        ->from(function ($query) use ($term) {
                            $query->select('users.id')
                                ->from('users')
                                ->where('users.first_name_normalized', 'like', $term)
                                ->orWhere('users.last_name_normalized', 'like', $term)
                                ->union(
                                    $query->newQuery()
                                        ->select('users.id')
                                        ->from('users')
                                        ->join('companies', 'users.company_id', '=', 'companies.id')
                                        ->where('companies.name_normalized', 'like', $term)
                                );
                        }, 'matches');
                });
            });
        }

        if (config('database.default') === 'sqlite') {
            throw new \Exception('This lesson does not support SQLite.');
        }

        if (config('database.default') === 'pgsql') {
            collect(str_getcsv($terms, ' ', '"'))->filter()->each(function ($term) use ($query) {
                $term = preg_replace('/[^A-Za-z0-9]/', '', $term).'%';
                $query->whereIn('id', function ($query) use ($term) {
                    $query->select('id')
                        ->from(function ($query) use ($term) {
                            $query->select('users.id')
                                ->from('users')
                                ->whereRaw("regexp_replace(users.first_name, '[^A-Za-z0-9]', '') ilike ?", [$term])
                                ->orWhereRaw("regexp_replace(users.last_name, '[^A-Za-z0-9]', '') ilike ?", [$term])
                                ->union(
                                    $query->newQuery()
                                        ->select('users.id')
                                        ->from('users')
                                        ->join('companies', 'users.company_id', '=', 'companies.id')
                                        ->whereRaw("regexp_replace(companies.name, '[^A-Za-z0-9]', '') ilike ?", [$term])
                                );
                        }, 'matches');
                });
            });
        }
    }
}
