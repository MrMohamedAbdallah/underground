<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected   $table = 'comments',
                $primaryKey = 'id',
                $filalble = [
                    'name', 'body', 'event_id'
                ];

    // Relationship with event
    public function event(){
        return $this->belongsTo('App\Event', 'event_id', 'id');
    }
}
