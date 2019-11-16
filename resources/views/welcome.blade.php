@extends('layout.app')


@section('content')

<sectoin class="hero-section">
    <div class="overlay"></div>
    <div class="content-wrapper col-6 col-md-12">
        <h1 class="text-light">Here We <span class="text-primary">Go</span></h1>
        <p class="text-light">Explore thousands of events on the most used events website in the world and create your
            own with 100% anonymity granted</p>
        <div class="btn-group">
            <button><a href="{{ route('explore') }}">Explore</a></button>
            <button class="btn-border"><a href="/create.html">Create</a></button>
        </div>
    </div>
</sectoin>
<div class="features">
    <div class="container">
        <div class="row">
            <div class="feature col-4 col-sm-12">
                <h3 class="feature-header">Anonymity</h3><img class="feature-img" src="/images/feature-1.svg" />
                <p class="feature-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ornare
                    convallis nisi, a convallis nunc egestas vel. Nam malesuada sem id condimentum bibendum. Suspendisse
                    venenatis sit amet lorem vel varius. Nulla facilisi</p>
            </div>
            <div class="feature col-4 col-sm-12">
                <h3 class="feature-header">Free</h3><img class="feature-img" src="/images/feature-2.svg" />
                <p class="feature-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ornare
                    convallis nisi, a convallis nunc egestas vel. Nam malesuada sem id condimentum bibendum. Suspendisse
                    venenatis sit amet lorem vel varius. Nulla facilisi</p>
            </div>
            <div class="feature col-4 col-sm-12">
                <h3 class="feature-header">Cross The World</h3><img class="feature-img" src="/images/feature-3.svg" />
                <p class="feature-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ornare
                    convallis nisi, a convallis nunc egestas vel. Nam malesuada sem id condimentum bibendum. Suspendisse
                    venenatis sit amet lorem vel varius. Nulla facilisi</p>
            </div>
        </div>
    </div>
</div>
<div id="particles-js"></div>
@endsection


@section('script')
<script src="{{ asset('js/particles.min.js') }}"></script>
<script>particlesJS.load('particles-js', "{{ asset('js/particlesjs-config.json') }}");</script>

@endsection