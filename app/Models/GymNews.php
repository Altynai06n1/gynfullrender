<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GymNews extends Model
{
    protected $table = 'music_news';
    protected $fillable = ['title', 'description', 'event_date'];

   
    protected $casts = [
        'event_date' => 'date',
    ];
} 
