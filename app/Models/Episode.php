<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;
    protected $table = 'episodes';
    public function movie(){
        return $this->belongsTo(Movie::class,'movie_id');
        // belong to : 1 tap thuoc 1 phim
    }
}
