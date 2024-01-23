<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    use HasFactory;
    public function movie(){
        return $this->hasMany(Movie::class)->orderBy('id','DESC');
        // thêm phần sắp xếp cho phim mới lên trc
        // mỗi danh mục sẽ trả về nhiều movie
        // belongTo tức là mỗi phim thuộc 1 danh mục
        // hasMany là mỗi phim thuộc nhiều danh mục
    }
}
