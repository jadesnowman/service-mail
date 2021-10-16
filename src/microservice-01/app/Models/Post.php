<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Post extends Model
{
    protected $connection = 'mongodb';
    protected $collection = 'posts';

    protected $fillable = [
        'name', 'email',
    ];
}
