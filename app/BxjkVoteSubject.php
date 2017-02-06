<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BxjkVoteSubject extends Model
{
    protected $table = 'bxjk_vote_subjects';
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = [
        'title', 'type', 'vote_id'
    ];
    public function options()
    {
        return $this->hasMany('App\BxjkVoteOption', 'subject_id');
    }
}
