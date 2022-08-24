<?php

namespace App;

class Customer extends Model
{
    public function salesRep()
    {
        return $this->belongsTo(User::class);
    }
}
