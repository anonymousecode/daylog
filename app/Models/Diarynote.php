<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model; // Base model for MongoDB

class Diarynote extends Model
{
    
    protected $connection = 'mongodb';
    protected $collection = 'diarynotes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'tag',
        'email',
        'day',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [];


}
