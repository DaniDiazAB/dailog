<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amigo extends Model
{
    use HasFactory;

    //relacion 1 a muchos inversa
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function friends() {
        return $this->belongsToMany(User::class, 'amigos');
    } 
}
