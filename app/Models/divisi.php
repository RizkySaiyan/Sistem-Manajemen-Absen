<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class divisi extends Model
{
    protected $table = 'divisi';
    protected $fillable = ['nama_divisi','kode_divisi'];
    public $timestamps = false;
    use HasFactory;
}
