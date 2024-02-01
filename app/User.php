<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Karyawan;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nama', 'level', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function pemain()
    {
        return $this->hasMany(Pemain::class);
    }

    public function inventaris()
    {
        return $this->hasMany(Inventaris::class);
    }

    public function galeri()
    {
        return $this->hasMany(Galeri::class);
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function log()
    {
        return $this->hasMany(LogActivity::class);
    }
}
