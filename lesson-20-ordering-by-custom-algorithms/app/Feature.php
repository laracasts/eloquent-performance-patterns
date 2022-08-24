<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Feature extends Model
{
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function scopeOrderByStatus($query, $direction)
    {
        $query->orderBy(DB::raw("
            case
                when status = 'Requested' then 1
                when status = 'Approved' then 2
                when status = 'Completed' then 3
            end
        "), $direction);
    }

    public function scopeOrderByActivity($query, $direction)
    {
        if (config('database.default') === 'mysql' || config('database.default') === 'sqlite') {
            $query->orderBy(
                DB::raw('-(votes_count + (comments_count * 2))'),
                $direction
            );
        }

        if (config('database.default') === 'pgsql') {
            $votes = Vote::selectRaw('count(*)')
                ->whereColumn('votes.feature_id', 'features.id')
                ->toSql();

            $comments = Comment::selectRaw('count(*)')
                ->whereColumn('comments.feature_id', 'features.id')
                ->toSql();

            $query->orderBy(
                DB::raw("($votes) + (($comments) * 2)"),
                $direction
            );
        }
    }
}
