<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class crudDropzone extends Model
{
    use HasFactory;
    protected $fillable =[
        'fname',
        'lname',
        'no',
        'status'
    ];
}
