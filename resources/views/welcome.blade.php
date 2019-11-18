@extends('layout.app')


@section('content')

<sectoin class="hero-section">
    <div class="overlay"></div>
    <div class="content-wrapper col-6 col-md-12">
        <h1 class="text-light">{!! __('app.welcome') !!}</h1>
        <p class="text-light">{{ __('app.hero paragraph') }}</p>
        <div class="btn-group">
            <button><a href="{{ route('explore') }}">{{ __('app.explore') }}</a></button>
            <button class="btn-border"><a href="/create.html">{{ __("app.create") }}</a></button>
        </div>
    </div>
</sectoin>
<div class="features">
    <div class="container">
        <div class="row">
            <div class="feature col-4 col-sm-12">
                <h3 class="feature-header">{{ __('app.anonymity') }}</h3><img class="feature-img" src="/images/feature-1.svg" />
                <p class="feature-text">{{ __('app.lorem')}}</p>
            </div>
            <div class="feature col-4 col-sm-12">
                <h3 class="feature-header">{{ __('app.free') }}</h3><img class="feature-img" src="/images/feature-2.svg" />
                <p class="feature-text">{{ __('app.lorem')}}</p>
            </div>
            <div class="feature col-4 col-sm-12">
                <h3 class="feature-header">{{ __('app.worldwide') }}</h3><img class="feature-img" src="/images/feature-3.svg" />
                <p class="feature-text">{{ __('app.lorem')}}</p>
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