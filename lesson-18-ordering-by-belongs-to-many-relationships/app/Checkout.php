<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Checkout extends Pivot
{
    protected $table = 'checkouts';

    protected $casts = [
        'borrowed_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
