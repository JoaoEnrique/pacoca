<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagePost extends Model
{
    use HasFactory;

    protected $table = 'images_post';
    protected $fillable = ['id_post', 'path', 'type'];
}
