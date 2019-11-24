<?php

use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $events = factory(App\Event::class, 30)->create()->each(function($e){

            $commentsNumber = rand(5, 50);

            $comments = factory(App\Comment::class, $commentsNumber)->make()->each(function($c) use ($e){
                $c->event_id = $e->id;
                $c->save();
                $e->comments_number += 1;
            });

            $e->save();
            
        });
    }
}
