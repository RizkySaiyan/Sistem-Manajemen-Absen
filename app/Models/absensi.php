<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class absensi extends Model
{
    protected $table = 'absensi';
    
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    
    use HasFactory;
}
