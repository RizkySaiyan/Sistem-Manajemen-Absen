<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     * 
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];
    protected $table = 'users';
    // protected $fillable = ['nama_divisi','kode_divisi'];
    public $timestamps = false;

    public function divisi(){
        return $this->belongsTo(divisi::class);
    }

    public function absensi(){
        return $this->belongsTo(absensi::class);
    }

    

    // public function jam_kerja(){
    //     return $this->hasOne(jamkerja::class,'divisi_id');
    // }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];
}
