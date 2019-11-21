@extends('layout.app')


@section('content')

<div class="page404">
    <div class="container">
        <div class="sub-heading light">{{ __("app.nothing found") }}</div><img src="/images/not-found.svg" />
        <form class="search-form col-md-12 col-10 mx-auto">
            <div class="form-group col-10 col-md-12">
                <label for="query">{{ __("app.search title") }}</label>
                <input type="text" name="query" id="query" placeholder="" /><span class="invalid-feedback">Something
                    went wrong</span>
            </div>
            <div class="col-2 col-md-12">
                <button type="submit">{{ __("app.search") }}</button>
            </div>
        </form>
    </div>
</div>

@endsection

