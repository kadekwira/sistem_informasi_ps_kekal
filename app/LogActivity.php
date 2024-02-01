<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    protected $table = 'log_activity';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'subject', 'url', 'method', 'ip', 'agent', 'users_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
