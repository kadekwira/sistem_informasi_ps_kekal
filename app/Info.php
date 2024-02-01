<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    protected $table = 'infos';
    public $incrementing = true;
    public $timestamps = true;
}
