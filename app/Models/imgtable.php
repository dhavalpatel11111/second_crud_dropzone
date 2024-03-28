<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imgtable extends Model
{
    use HasFactory;

    protected $table = "imgtable";

    protected $fillable = [
        'mainid',
        'img'
    ];
}
