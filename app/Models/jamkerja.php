<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jamkerja extends Model
{
    protected $table = 'waktu_kerja';
    public $timestamps = false;

    public function divisi(){
        return $this->hasMany(divisi::class);
    }
    use HasFactory;
}
