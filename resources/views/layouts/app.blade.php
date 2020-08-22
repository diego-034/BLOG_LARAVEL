<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOG</title>
    <link rel="stylesheet" href="{{ asset('css/uikit.min.css') }}">

</head>

<body>
    <nav class="uk-navbar-container uk-margin" uk-navbar>
        <div class="uk-navbar-center">
            <div class="uk-navbar-center-left">
                <div>
                    <ul class="uk-navbar-nav">
                        <li><a href="{{ url('/login')}}">Login</a></li>
                    </ul>
                    <ul class="uk-navbar-nav">
                        <li><a href="{{ url('/signin')}}">Sign in</a></li>
                    </ul>
                </div>
            </div>
            <a class="uk-navbar-item uk-logo" href="{{ url('/')}}">BLOG</a>
            <div class="uk-navbar-center-right">
                <div> 
                    <ul class="uk-navbar-nav">
                        <li><a href="{{ url('/profile')}}">Profile</a></li>
                    </ul>
                    <ul class="uk-navbar-nav">
                        <li><a href="{{ url('/exit')}}">Exit</a></li>
                    </ul>
                   
                </div>
            </div>
        </div>
    </nav>
    @yield('content')
    <script src="{{ asset('js/uikit.min.js') }}"></script>
    <script src="{{ asset('js/uikit-icons.min.js') }}"></script>
    <script src="{{ asset('js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>