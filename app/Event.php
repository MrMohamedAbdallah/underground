<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

// Scout package for searching with algolia
use Laravel\Scout\Searchable;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;;

class Event extends Model
{
    use Searchable;
    // Pretty slugs
    use Sluggable;
    use SluggableScopeHelpers;


    protected   $table = 'events',
                $primaryKey = 'id',
                $fillable = [
                    'title', 'description', 'lat', 'lng', 'cover', 'date', 'comments_number', 'views_number'
                ];

    // Relationship between comments
    public function comments(){
        return $this->hasMany('App\Comment', 'event_id', 'id');
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
