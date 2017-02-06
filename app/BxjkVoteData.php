<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BxjkVoteData extends Model
{
    protected $table = 'bxjk_vote_data';
    protected $fillable = [
        'vote_id', 'field', 'ip'
    ];
}
