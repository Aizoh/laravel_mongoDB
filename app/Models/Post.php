<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
//use Illuminate\Database\Eloquent\Model;
use MongoDB\Laravel\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';

    // protected $fillable = [
    //     'title',
    //     'edited_at',
    //     'author',
    //     'editor',
    //     'body',
    //     'image',
    //     'views',
    //     'comments',
    //     'content',
    //     'topic',
    //     'publish_date'
    // ];

    protected $guarded = [];

    protected $casts = [
        'edited_at' => 'datetime',
       
    ];
}
