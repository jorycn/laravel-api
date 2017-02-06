<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BxjkVideo extends Model
{
    use SoftDeletes;

    protected $table = 'bxjk_video';
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];

    protected $fillable = [
        'title', 'thumb', 'vid', 'year', 'month', 'top'
    ];

}
