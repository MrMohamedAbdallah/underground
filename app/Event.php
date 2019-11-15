<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected   $table = 'events',
                $primaryKey = 'id',
                $fillable = [
                    'title', 'description', 'lat', 'lng', 'cover', 'date', 'comments_number', 'views_number'
                ];

    // Relationship between comments
    public function comments(){
        return $this->hasMany('App\Comment', 'event_id', 'id');
    }
}
