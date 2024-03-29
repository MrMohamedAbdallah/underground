@extends('layout.app')


@section('title') {{__("app.create new event")}} @endsection


@section('content')

<div class="create-event">
    <h1 class="heading">{{ __("app.create new event") }}</h1>
    <div class="container">
        <div class="row">
            <form class="create-event-form col-8 col-md-12 mx-auto" method="POST" action="{{ route('event.store') }}"
                enctype="multipart/form-data">

                @csrf
                <div class="row">
                    <div class="form-group col-12">
                        <label for="title">{{ __("app.title") }}</label>
                        <input type="text" name="title" id="title" value="{{ old('title') }}"
                            class="@error('title') is-invalid @enderror" autocomplete="off"/>
                        @error('title')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group col-12">
                        <label for="description">{{ __("app.description") }}</label>
                        <textarea rows="5" name="description" id="description"
                            class="@error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group col-12">
                        <label for="password">{{ __("app.password") }}</label>
                        <input type="password" name="password" id="password" value="{{ old('password') }}"
                            class="@error('password') is-invalid @enderror" autocomplete="off"/>
                        @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group col-6 col-md-12">
                        <label for="lat">{{ __("app.lat") }}</label>
                        <input type="number" name="lat" id="lat" step="0.000000000000001" value="{{ old('lat') }}"
                            class="@error('lat') is-invalid @enderror" />
                        @error('lat')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group col-6 col-md-12">
                        <label for="lng">{{ __("app.lng") }}</label>
                        <input type="number" name="lng" id="lng" step="0.000000000000001" value="{{ old('lng') }}"
                            class="@error('lng') is-invalid @enderror" />
                        @error('lng')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group col-6 col-md-12">
                        <label for="date">{{ __("app.date") }}</label>
                        <input type="datetime-local" name="date" id="date" value="{{ old('date') }}"
                            class="@error('date') is-invalid @enderror" />
                        @error('date')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="form-group col-6 col-md-12">
                        <label for="cover">{{ __("app.cover") }}</label>
                        <input type="file" name="cover" id="cover" data-value="#cover-value" />
                        <span data-file="#cover" class="file-placeholder @error('cover') is-invalid @enderror">Upload
                            Cover</span>
                        <span class="file-value" id="cover-value"></span>
                        @error('cover')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                        <span class="invalid-feedback"></span>
                    </div>
                    <div class="col-12">
                        <div class="map" id="map"></div>
                    </div>
                    <div class="col-12">
                        {{-- Recaptcha --}}
                        @component('comps.recaptcha')
                        @endcomponent
                    </div>
                    <div class="col-12">
                        <button type="submit">{{ __("app.submit") }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


@section('script')
<script>
    function initMap(){
      let map = new google.maps.Map(document.getElementById('map'),{
        center: {lat: 30.0444, lng: 31.2357},
        zoom: 3
      });
    
        let latInput = $('#lat');
        let lngInput = $('#lng');
    
        let marker = null;
        // Function to change marker values
        function changeMarker(pos){
    
        if(marker == null){
            marker = new google.maps.Marker({
            position: pos.latLng,
            map: map,
            });
        } else {
            marker.setPosition(pos.latLng);
        }
            
            latInput.val(marker.getPosition().lat())
            lngInput.val(marker.getPosition().lng())
    
        }
        // Add "click" event to the map
        map.addListener('click', changeMarker);
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={!! env('map_key') !!}&callback=initMap">
</script>
{{-- Recaptcha --}}
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endsection