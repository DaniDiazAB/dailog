<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //relacion 1 a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }
}
