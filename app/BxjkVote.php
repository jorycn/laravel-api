<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BxjkVote extends Model
{
    use SoftDeletes;

    protected $table = 'bxjk_vote';

    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    protected $fillable = [
        'title', 'fields', 'type', 'uuid'
    ];

    public function subjects()
    {
        return $this->hasMany('App\BxjkVoteSubject', 'vote_id');
    }

    public function options()
    {
        return $this->hasMany('App\BxjkVoteOption', 'vote_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'uuid');
    }
}
