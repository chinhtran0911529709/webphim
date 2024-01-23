<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkMovie extends Model
{
    use HasFactory;
    public $timestamp = false;
    protected $table = 'linkphim';
    protected $fillable = [
        'title','description','status'
    ];
}
