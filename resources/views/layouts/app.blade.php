<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title','Social Network')</title>
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{url('css/toastr.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}">

</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top ">
        <div class="container">
            <div class="navbar-header">
                
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <!-- Branding Image -->
                <a href="" class="navbar-brand">
                    Laravel
                </a>
            </div>
            
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <vue-search></vue-search>
                
                </ul>
                
                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right ">
                    {{--profile route--}}
                    @if(auth()->check())
                        <li><a href="{{url('/profile/')}}">Home</a></li>
                        <li>
                            <a href="{{url('/profile/'.auth()->user()->slug)}}"  >
                                <img src="{{Storage::url(''.auth()->user()->avatar)}}"  alt="" style="width: 30px;height: 30px;border-radius: 50%; ">
                                My Profile
                            </a>
                        </li>
                        {{--custom dropdown with vue template--}}
                        
                        <related-friend :user_id ="{{auth()->id()}}">
                            <template slot="imgUrl">
                                <img src="{{asset('/image/friend_request.png')}}" class="img-circle" alt="" style="width: 30px;height: 30px;border-radius: 50%; ">
                            </template>
                        
                        </related-friend>
                        {{--pending user section--}}
                        
                        <pending-friend :user_id ="{{auth()->id()}}">
                            <template slot="imgUrl2">
                                <img src="{{asset('image/friend_request.png')}}" class="img-circle" alt="" style="width: 30px;height: 30px;border-radius: 50%; ">
                            </template>
                        </pending-friend>
                    @endif
                <!-- Authentication Links -->
                    @guest
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                        <a href="{{url('/profile/'.auth()->id().'/edit')}}">Setting</a>
                                        
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @endguest
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{url('js/toastr.min.js')}}"></script>
<script>
        @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            toastr.options.closeDuration = 200;
            break;

        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            toastr.options.closeDuration = 200;
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            toastr.options.closeDuration = 200;
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            toastr.options.closeDuration = 200;
            break;
    }
    @endif

</script>
</body>
</html>
