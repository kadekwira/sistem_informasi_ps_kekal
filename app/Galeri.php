<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';
    public $incrementing = true;
    public $timestamps = true;

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
