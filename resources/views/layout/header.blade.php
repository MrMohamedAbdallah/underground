<!DOCTYPE html>
<html lang="{{App::getLocale()}}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="icon" href="/favicon.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap" />
    <link rel="stylesheet" href="{{ asset("/css/all.min.css") }}" />
    <link rel="stylesheet" href="{{ asset("/css/style.min.css") }}" />
    <title>@hasSection('title')@yield('title') | @endif{{ __("app.underground") }}</title>
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <div class="row">
                <div class="col-1 col-md-2">
                    <div class="logo"><a href="/"><svg xmlns="http://www.w3.org/2000/svg" width="63" height="40.813"
                                viewBox="0 0 63 40.813">
                                <g transform="translate(-1369.66 -186.33)">
                                    <path d="M1380.95,285.45h22.31l-6.025,10.437-5.13,8.885-5.13-8.885Z"
                                        transform="translate(-8.842 -77.629)" fill="#9cb7f6" />
                                    <path
                                        d="M1396.866,199.935a13.549,13.549,0,0,1-1.258,5.717h-24.691a13.6,13.6,0,1,1,25.948-5.717Z"
                                        transform="translate(0 0)" fill="#9cb7f6" />
                                </g><text transform="translate(27 29)" fill="#9cb7f6" font-size="26"
                                    font-family="Montserrat-Bold, Montserrat" font-weight="700"
                                    letter-spacing="-0.194em">
                                    <tspan x="0" y="0">UG</tspan>
                                </text>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="col">
                    <ul class="navbar-nav">
                        <li>
                            <a class="{{ request()->routeIs('explore') ? 'active' : '' }}"
                                href="{{ route('explore') }}">{{ __("app.explore")}}</a>
                        </li>
                        <li>
                            <a class="{{ request()->routeIs('event.create') ? 'active' : '' }}"
                                href="{{ route('event.create') }}">{{ __("app.create") }}</a>
                        </li>
                        <li class="langs"><span><i class="fas fa-globe-africa"></i></span>
                            <ul class="dropdown">
                                @if(app()->getLocale() == 'ar')
                                <li class="active">العربية</li>
                                @else 
                                <li><a href="{{ route('lang', 'ar') }}">العربية</a></li>
                                @endif
                                {{--============================= --}}
                                {{--============================= --}}
                                @if(app()->getLocale() == 'en')
                                <li class="active">English</li>
                                @else 
                                <li><a href="{{ route('lang', 'en') }}">English</a></li>
                                @endif                                
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="col-2 col-md-4 col-sm-12">
                    <form class="nav-form" method="GET" action="{{ route("search") }}">
                        <input type="text" name="query" id="query" placeholder="{{ __("app.search") }}" />
                        <button class="icon"><i class="fas fa-search icon"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </nav>