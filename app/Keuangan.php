<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    protected $table = 'keuangan';
    public $incrementing = true;
    public $timestamps = true;

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
