<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    protected $table = 'inventaris';
    public $incrementing = true;
    public $timestamps = true;

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
