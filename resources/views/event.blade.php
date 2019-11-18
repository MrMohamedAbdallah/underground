@extends('layout.app')


@section('content')

<section class="event-section">
    <ul class="timer">
        <li> <span class="name">{{ __("app.day") }}</span><span class="time">11:</span></li>
        <li> <span class="name">{{ __("app.hour") }}</span><span class="time">20:</span></li>
        <li> <span class="name">{{ __("app.minute") }}</span><span class="time">30:</span></li>
        <li> <span class="name">{{ __("app.second") }}</span><span class="time">32</span></li>
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
                <button data-comment="data-comment">{{ __("app.add comment") }}</button>
            </div>
        </div>
    </div>
    <div class="container">
        <form class="row comment-form" action="{{ route('comment.store') }}" method="POST">
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
</section>


@endsection


{{-- Script for the map & comment form --}}
@section('script')
<script>
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