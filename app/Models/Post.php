<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['id_user', 'img', 'text'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
