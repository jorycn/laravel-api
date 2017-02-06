<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BxjkMessage extends Model
{
    protected $table = 'bxjk_message';
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $fillable = [
        'type', 'content', 'ip'
    ];
}
