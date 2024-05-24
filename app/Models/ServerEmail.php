<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerEmail extends Model
{
    use HasFactory;

    protected $table = 'server_email';

    protected $fillable = [
        'id', 
        'email', 
        'img', 
        'subject',
        'phone', 
        'text', 
        'link1', 
        'link2', 
    ];
}
