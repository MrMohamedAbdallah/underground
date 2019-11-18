<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Illuminate\Support\Facades\Session;

class Lang
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $langs = ['ar', 'en'];

        if(Session::has('locale')){
            App::setLocale(Session::get('locale'));
        } else {
            App::setLocale('en');
        }

        return $next($request);
    }
}
