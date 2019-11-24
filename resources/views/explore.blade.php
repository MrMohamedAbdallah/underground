@extends('layout.app')

@section('title'){{__("app.explore the world")}}@endsection


@section('content')

<section class="cards clear-fix">
    <div class="heading">{{__("app.explore the world")}}</div>
    <div class="container">
        <div class="grid">
            <div class="grid-col grid-col--1"></div>
            <div class="grid-col grid-col--2"></div>
            <div class="grid-col grid-col--3"></div>

            @foreach($events as $event)
            <div class="card">
                @if($event->cover)
                <div class="card-img"><img src="/storage/{{ $event->cover }}" /></div>
                @endif
                <div class="card-body">
                    <h3 class="card-header"> <a href="{{ route("event", $event->slug) }}">{{ $event->title }}</a></h3>
                    <p class="card-text">
                        {{-- @dd($event->description) --}}
                        @if(strlen($event->description) > 200)
                        {{ substr($event->description,0, 200) . '...' }}
                        @else
                        {{ $event->description }}
                        @endif
                    </p>
                    <div class="card-footer">
                        {{-- <div class="card-location"> 
                            <a href="/event.html">
                                <i class="fas fa-map-marker"></i> Al-Quds -Palestine
                            </a>
                        </div> --}}
                        <div class="icons">
                            <div class="card-icon">{{ $event->comments_number }} <i class="far fa-comment"></i></div>
                            <div class="card-icon">{{ $event->views_number }} <i class="fas fa-eye"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
        {{-- Pagination --}}
        {{ $events->links() }}
    </div>
</section>
@endsection


{{-- Script section for masonry view --}}
@section('script')
<script src="{{ asset('js/colcade.js') }}"></script>
<script>
    var colcade = new Colcade( '.grid', {
      columns: '.grid-col',
      items: '.card'
  });
</script>
@endsection