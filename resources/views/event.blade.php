@extends('layout.app')

@section('title'){{ $event->title }}@endsection

@section('content')

<section class="event-section">
    <ul class="timer" id="timer" data-time="{{ strtotime($event->date) }}">
        <li>
            <span class="name">{{ __("app.day") }}</span>
            <span class="time" id="day">00:</span></li>
        <li>
            <span class="name">{{ __("app.hour") }}</span>
            <span class="time" id="hour">00:</span></li>
        <li>
            <span class="name">{{ __("app.minute") }}</span>
            <span class="time" id="min">00:</span></li>
        <li>
            <span class="name">{{ __("app.second") }}</span>
            <span class="time" id="sec">00</span></li>
    </ul>
    <div class="event-map" id="map"> </div>
    <div class="container">
        <div class="info">
            <div class="date">{{ $event->date }}</div>
            <div class="icons">
                <span class="icon">{{ $event->comments_number }} <i class="far fa-comment"></i></span>
                <span class="icon">{{ $event->views_number }} <i class="fas fa-eye"></i></span>
            </div>
        </div>
        <div class="event">
            @if($event->cover)
            <div class="event-img"><img src="/storage/{{ $event->cover }}" /></div>
            @endif
            <div class="event-title">{{ $event->title }}</div>
            <pre class="event-text">{{ $event->description }}</pre>
            <div class="btn-right">
                <button data-open="#comment-form">{{ __("app.add comment") }}</button>
            </div>
        </div>
    </div>
    <div class="container">
        <form class="row comment-form hide-form" id="comment-form" action="{{ route('comment.store') }}" method="POST">
            @csrf
            <input type="hidden" name="event" value="{{ $event->id }}">
            <div class="form-group col-12">
                <label for="name">{{ __("app.name") }}</label>
                <input type="text" name="name" id="name" placeholder="Anonymous" value="{{ old('name') }}"
                    class="@error('name') is-invalid @enderror" />
                @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <span class="invalid-feedback"></span>
            </div>
            <div class="form-group col-12">
                <label for="body">{{ __("app.comment") }}</label>
                <textarea rows="5" name="body" id="body"
                    class="@error('body') is-invalid @enderror">{{ old('body') }}</textarea>
                @error('body')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <span class="invalid-feedback"></span>
            </div>
            <div class="col-12">
                {{-- Recaptcha --}}
                @component('comps.recaptcha')
                @endcomponent
                {{-- /Recaptcha --}}
            </div>

            <div class="col-12">
                <button type="submit">{{ __("app.submit") }}</button>
            </div>
        </form>
        <div class="comments">
            @foreach($comments as $comment)
            <div class="comment">
                <div class="comment-header">
                    <span class="comment-name">{{ $comment->name }}</span>
                    <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
                </div>
                <pre class="comment-text">{{ $comment->body }}</pre>
            </div>
            @endforeach
        </div>
    </div>
    {{-- Commments pagination --}}
    {{ $comments->links() }}

    <div class="container">
        <div class="btn-right">
            <button data-open="#delete-form" class="bg-danger text-white">{{ __("app.delete") }}</button>
        </div>
        <form class="row hide-form" id="delete-form" action="{{ route('event.delete', $event->id) }}" method="POST">
            @csrf
            @method("DELETE")
            <div class="form-group col-12">
                <label for="password">{{ __("app.password") }}</label>
                <input type="password" name="password" id="password"
                    value="{{ old('password') }}" class="@error('password') is-invalid @enderror" min="6" />
                @error('password')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <span class="invalid-feedback"></span>
            </div>
            {{-- Recaptcha --}}
            @component('comps.recaptcha')
            @endcomponent
            {{-- /Recaptcha --}}
            <div class="col-12">
                <button type="submit">{{ __("app.submit") }}</button>
            </div>
        </form>
    </div>
</section>


@endsection


{{-- Script for the map & comment form --}}
@section('script')
<script>
    // =================
    // Event count down
    // =================

    // Adds zero to the number if it's less than 10
    function addZero(num){
        num = parseInt(num);
        return num < 10 ? '0' + num : num;
    }

    let timer = document.getElementById("timer");
    let dayElem = $("#day");
    let hourElem = $("#hour");
    let minElem = $("#min");
    let secElem = $("#sec");

    let theDate = new Date(parseInt(timer.dataset.time) * 1000);



    let interval = setInterval(function(){
        let now = new Date();

        let diff = theDate.getTime() - now.getTime();

        if(diff <= 0){
            clearInterval(interval);
            $("#timer").addClass('done');
            return;
        }

        let sec = Math.floor(diff / 1000);
        let min = Math.floor(sec / 60);
        let hour = Math.floor(min / 60);
        let day = Math.floor(hour / 24);
        
        hour %= 24;
        min %= 60;
        sec %= 60;


        dayElem.text(addZero(day) + ":");
        hourElem.text(addZero(hour) + ":");
        minElem.text(addZero(min) + ":");
        secElem.text(addZero(sec));

    }, 1000)

    // =================
    //  Google map
    // =================
    function initMap(){
            let position = {lat: {{ $event->lat }}, lng: {{ $event->lng }} };
            let map = new google.maps.Map(document.getElementById('map'),{
                center: position,
                zoom: 8
            });
            // Create new marker
            let marker = new google.maps.Marker({
                map: map,
                position: position
            });
        }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={!! env('map_key') !!}&callback=initMap">
</script>
{{-- Recaptcha --}}
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

@endsection