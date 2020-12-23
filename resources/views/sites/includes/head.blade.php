<html lang="en"><head>
        <!-- META -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <meta name="robots" content="">    
        <meta name="description" content="">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="route" content="{{ url('/') }}">
        <!-- FAVICONS ICON 
        <link rel="icon" href="public/sites/images/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" type="image/x-icon" href="public/sites/images/favicon.png">
        -->
        <!-- PAGE TITLE HERE -->
        <title>EMPTYTRUCK100 | Home  </title>

        <!-- MOBILE SPECIFIC -->
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- BOOTSTRAP STYLE SHEET -->
        <link rel="stylesheet" type="text/css" href="{{url('public/sites/css/bootstrap.min.css')}}">
        <!-- FONTAWESOME STYLE SHEET -->
        <link rel="stylesheet" type="text/css" href="{{url('public/sites/css/font-awesome.min.css')}}">

        <!--<link rel="stylesheet" href="{{ url('public/sites/css/all.css') }}">-->
        <link rel="stylesheet" href="{{ url('public/sites/css/bootstrap.min.css') }}">
        <link rel='stylesheet' href='{{ url('public/sites/css/owl.carousel.min.css') }}'>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- BOOTSTRAP SELECT BOX STYLE SHEET -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">

        <!-- CUSTOM  STYLE SHEET -->
        <link rel="stylesheet" type="text/css" href="{{url('public/sites/css/custom.css')}}">  
        <!-- RESPONSIVE STYLE SHEET -->
        <link rel="stylesheet" type="text/css" href="{{url('public/sites/css/responsive.css')}}"> 

        <!-- GOOGLE FONTS -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;600;700;800;900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    </head>
    <body>
        <?php
        $dob = get_custom_dob();
        $userDetails = getUserDetails();
        $name = @$userDetails->name;
//        prd($userDetails->name);
        ?>

        <!-- HEADER START -->

        <header>
            <div class="lang-social"> 
                <div class="container"> 
                    <div class="social-top">
                        <a href="#"> <i class="fa fa-facebook" aria-hidden="true"></i> </a>
                        <a href="#"> <i class="fa fa-twitter" aria-hidden="true"></i> </a>
                        <a href="#"> <i class="fa fa-youtube-play" aria-hidden="true"></i> </a>
                    </div>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="flag-icon flag-icon-us"> </span> </a>
                        <div class="dropdown-menu" aria-labelledby="dropdown09">
                            <a class="dropdown-item" href="#fr"><span class="flag-icon flag-icon-fr"> </span>  </a>
                            <a class="dropdown-item" href="#it"><span class="flag-icon flag-icon-it"> </span>  </a>
                            <a class="dropdown-item" href="#ru"><span class="flag-icon flag-icon-ru"> </span>  </a>
                        </div>
                    </div>
                </div> 
            </div>

            <div class="top-bar"> 
                <div class="container">
                    <ul>
                        <li><a href="#"> <span> <i class="fa fa-map-marker" aria-hidden="true"></i> </span> 5999 76 Ave SE, Calgary AB, 11715 170 St, Abhklupt HP </a></li>
                        <li><a href="#"> <span> <i class="fa fa-send" aria-hidden="true"></i> </span> Info@emptytruck100.com </a></li>
                        <li><a href="#"> <span> <i class="fa fa-phone" aria-hidden="true"></i> </span> 2-555-333-8886 </a></li>
                        @guest
                        <li>
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">login
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu main-nava">
                                    <li><a class="cd-signin" href="#0">Customer </a></li>
                                    <li><a href="#">Driver</a></li>
                                </ul>
                            </div>
                        </li>
                        @else
                        <li>
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">{{@$name}}
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu main-nava">
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
            <!--Navigation-->
            <div class="main-nav">
                <div class="container">
                    <nav class="navbar navbar-expand-lg">
                        <a class="navbar-brand" href="index.html">
                            <img src="{{url('public/sites/images/logo.png')}}" alt="logo">
                        </a> 
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list-2" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbar-list-2">
                            <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="#"> Home </a>      
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"> About Us </a>      
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"> Services </a>      
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#"> Blog </a>      
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#"> Privacy policy </a>      
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="#"> Contact Us </a>      
                                </li>
                            </ul>
                        </div>

                    </nav>



                    <style type="text/css">
                        .dropdown>.dropdown-menu {
                            top: 200%;
                            transition: 0.3s all ease-in-out;
                        }
                        .dropdown:hover>.dropdown-menu {
                            display: block;
                            top: 100%;
                        }

                        .dropdown>.dropdown-toggle:active {
                            /*Without this, clicking will make it sticky*/
                            pointer-events: none;
                        }

                    </style>


                </div>
            </div>
            <!--Navigation //-->


            <!-- HEADER END -->
        </header>

