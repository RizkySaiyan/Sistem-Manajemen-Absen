<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class divisi extends Model
{
    protected $table = 'divisi';
    public $timestamps = false;

    public function user(){
        return $this->hasMany(User::class);
    }
    use HasFactory;
}
