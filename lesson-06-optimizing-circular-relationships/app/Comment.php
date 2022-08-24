<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isAuthor()
    {
        return $this->feature->comments->first()->user_id === $this->user_id;
    }
}
