<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pemain extends Model
{
    protected $table = 'pemain';
    public $incrementing = true;
    public $timestamps = true;

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
