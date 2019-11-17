<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Event;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'event' => 'required',
            'name'  => 'nullable|min:3',
            'body'  => 'required|min:2'
        ]);

        try{

            $eventID = $request->event;

            // Find the event
            $event = Event::where('date', '>', 'NOW()')
                            ->where('id', $eventID)
                            ->firstOrFail();

            // Create new comment
            $comment = new Comment();

            $comment->name = $request->name ? $request->name : 'Anonymous';
            $comment->body = $request->body;
            $comment->event_id = $request->event;

            // Save the comment to DB;
            $comment->save();
            
            
            return redirect()->route('event', $event->id);
        } catch(Exception $e){
            return abort(400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
