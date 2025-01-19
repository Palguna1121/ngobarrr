<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //table
    protected $table = 'post';

    //fillable
    protected $fillable = [
        'title',
        'description',
        'category'
    ];

    //guarded
    protected $guarded = [
        'created_at',
        'updated_at'
    ];
}
