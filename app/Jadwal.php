<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    public $incrementing = true;
    public $timestamps = true;

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
