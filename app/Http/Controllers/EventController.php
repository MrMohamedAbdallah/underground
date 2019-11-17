<?php

namespace App\Http\Controllers;

use App\Event;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('created_at', 'DESC')->paginate(10);

        // Check if there are events
        if($events->count()){
            return view('explore', compact('events'));
        } else {
            // Return to empty page
            return view('no-result', compact('events'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());

        // Validate
        $request->validate([
            'title' => 'required|min:5',
            'description' => 'required|min:3',
            'lat'   => 'required|latlng:-90,90',
            'lng'   => 'required|latlng:-180,180',
            'date'  => 'required|date_format:Y-m-d\TH:i|after:+1 week',
            'cover' => 'nullable|image|mimes:jpg,png,gif,jpeg',
            'g-recaptcha-response'    => 'required|recaptcha'
        ]);

        // Upload the file if exits
        $filePath = '';  // Default path value
        
        if($request->cover){
            $filePath = $request->cover->store('public/images');
            // Remove pulic path
            $filePath = explode('/', $filePath);
            $filePath = array_slice($filePath, 1);
            $filePath = implode('/', $filePath);
        }
        // Create new
        $event = new Event();

        $event->title = $request->title;
        $event->description = $request->description;
        $event->lat = $request->lat;
        $event->lng = $request->lng;
        $event->date = $request->date;
        $event->cover = $filePath;

        $event->comments_number = 0;
        $event->views_number    = 0;

        // Save the event
        $event->save();

        // Redirect to the event page
        return redirect()->route('event', $event->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $event = Event::findOrFail($id);

            // Get event comments
            $comments = Comment::where('event_id', $event->id)
                                ->orderBy('created_at', 'DESC')
                                ->paginate(10);


            // ================================================
            //      Increase the number of views
            //      if the user didn't see it in that session
            // ================================================
            $visited = true;    // If the user visited that event indecator
            $sessionEvents = Session::get('events') ? Session::get('events') : [];
            if($sessionEvents){
                // Check if there's the event id
                if(!in_array($event->id, $sessionEvents)){
                    $visited = false;
                }
            } else {
                $visited = false;
            }

            // dd($sessionEvents);
            
            // Increase the number
            if(!$visited){
                $sessionEvents = array_merge($sessionEvents, [$event->id]);
                
                // Store the new array in the session
                Session::put('events', $sessionEvents);
                // Add one to the number of views
                $event->views_number += 1;
                // Save changes
                $event->save();
            }


            return view('event', compact('event', 'comments'));
        } catch (Exception $e){
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }
}
