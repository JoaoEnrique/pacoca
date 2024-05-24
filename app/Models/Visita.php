<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;

    
    protected $table = 'visitas';
    protected $fillable = ['data_inicio', 'data_final'];
}
