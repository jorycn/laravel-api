<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BxjkVoteOption extends Model
{
    protected $table = 'bxjk_vote_options';
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = [
        'title', 'vote_id', 'subject_id', 'count'
    ];
    protected $appends = ['percent'];

    public function getPercentAttribute($value)
    {
        $total = BxjkVoteSubject::findOrFail($this->subject_id)->total;
        return $total>0?round($this->count/$total, 4)*100:0;
    }
}
