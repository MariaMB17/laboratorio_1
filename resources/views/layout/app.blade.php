<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ url('/bootstrap-3.3.7-dist/css/bootstrap.min.css')}}" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="{{ url('/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css')}}" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">        
        <!-- <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css"> -->
        <link href="{{ url('/css/styles.css')}}" rel="stylesheet" />
        <link href="{{ url('select2-4.0.3/dist/css/select2.min.css')}}" rel="stylesheet">
    </head>
    <body id="home">
          <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                @if((Auth::guest())) 
                <a class="navbar-brand" href="{{ url('/') }}">
                    CSI
                </a>
                @else
                <a class="navbar-brand" href="{{ url('/home') }}">
                    CSI
                </a>
                @endif
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @if(!(Auth::guest())) 
                    
                    @endif                                  
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Registrarse</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Cerrar conexión</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

        @yield('content')
        <<script type="text/javascript"src="{{url('/jquery/jquery.min.js')}}"></script>
        <script type="text/javascript"src="{{url('/jquery/jquery.validate.min.js')}}"></script>
        <script type="text/javascript"src="{{url('/jquery/additional-methods.min.js')}}"></script>
        <<script type="text/javascript"src="{{url('/select2-4.0.3/dist/js/select2.min.js')}}"></script>        
        <!-- Latest compiled and minified JavaScript -->
        <script src="{{url('/bootstrap-3.3.7-dist/js/bootstrap.min.js')}}" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>




