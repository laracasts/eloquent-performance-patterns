<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function salesRep()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeVisibleTo($query, User $user)
    {
        if (! $user->is_owner) {
            $query->where('sales_rep_id', $user->id);
        }
    }
}
