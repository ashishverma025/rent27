<html lang="en"><head>
        <!-- META -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="keywords" content="">
        <meta name="author" content="">
        <meta name="robots" content="">    
        <meta name="description" content="">
        <!-- FAVICONS ICON 
        <link rel="icon" href="public/sites/images/favicon.ico" type="image/x-icon">
        <link rel="shortcut icon" type="image/x-icon" href="public/sites/images/favicon.png">
        -->
        <!-- PAGE TITLE HERE -->
        <title>Emptytruck100 | Home  </title>

        <!-- MOBILE SPECIFIC -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- [if lt IE 9]>
            <script src="js/html5shiv.min.js"></script>
            <script src="js/respond.min.js"></script>
            <![endif] -->
        <!--Roboto font-->
        <!-- BOOTSTRAP STYLE SHEET -->
        <link rel="stylesheet" type="text/css" href="{{url('public/sites/css/bootstrap.min.css')}}">
        <!-- FONTAWESOME STYLE SHEET -->
        <link rel="stylesheet" type="text/css" href="{{url('public/sites/css/font-awesome.min.css')}}">

        <!-- BOOTSTRAP SELECT BOX STYLE SHEET -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/css/bootstrap-select.min.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css" rel="stylesheet" />

        <!-- OWL CAROUSEL STYLE SHEET -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


        <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">

        <!-- CUSTOM  STYLE SHEET -->
        <link rel="stylesheet" type="text/css" href="{{url('public/sites/css/custom.css')}}">  
        <!-- RESPONSIVE STYLE SHEET -->
        <link rel="stylesheet" type="text/css" href="{{url('public/sites/css/responsive.css')}}"> 

        <!-- GOOGLE FONTS -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;600;700;800;900&display=swap" rel="stylesheet">
    </head>
    <body>
        <?php
        $dob = get_custom_dob();
        
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
                        <!--<li class="signup"><a class="btn" > Log In</a></li>-->
                        <li>
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">login
                                    <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="#" id="loginModal">Customer </a></li>
                                    <li><a href="#" id="loginModals">Driver</a></li>
                                </ul>
                            </div>
                        </li>
                        @if (Route::has('register'))
                        <li class="signup"><a class="btn" id="signUpModal">Sign Up</a></li>
                        @endif

                        @else
                        @php
                        $userDetails = getUserDetails();
                        $name = explode(' ',$userDetails['name']);
                        @endphp
                        <li class="signup">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
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
                            <img src="public/sites/images/logo.png" alt="logo">
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


        <!--<div id="closeModal"></div>-->
        <!-- Sign Up Modal -->
        <div class="modal fade SignUpModal" id="SignUpModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>REGISTER</h2>
                        <button type="button" class="btn-dismiss-modal" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div id="socialSignup">
                            <div id="model1" class="model1">
                                <!--                                <div class="col-sm-12">
                                                                    <a href="{{ url('/login/facebook') }}" class="btn-facebook">
                                                                        <span class="icon-container"><i class="fa fa-facebook"></i></span>
                                                                        <span class="text-container">Continue with Facebook</span>
                                                                    </a>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <a href="https://tutify.com.sg/home/g_sign_in" class="btn-google">
                                                                        <span class="icon-container g-icon"><img src="{{url('public/sites/images/google_icon.png')}}"></span>
                                                                        <span class="text-container continueee">Continue with Google</span>
                                                                    </a>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="signup-or-separator">
                                                                        <span class="h6 signup-or-separator--text">or</span>
                                                                        <hr>
                                                                    </div>
                                                                </div>-->
                                <div class="col-sm-12">
                                    <a href="#" class="btn-google signup_with_email" id="signupForm">
                                        <span id="signup_with_email" class="icon-container g-icon">
                                            <img src="{{url('public/sites/images/email-icon-white.png')}}">Sign up with Email</span>
                                    </a>
                                </div>
                                <div class="col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="remember" id="tos_outside" >
                                                <label class="container1">
                                                    <input type="checkbox" name="remember_me">
                                                    <span class="checkmark"></span>
                                                    <small>By signing up, I agree to Tutify's <a href="#" data-popup="true">Terms of Service</a>, <a href="#" data-popup="true">Privacy Policy</a>, <a href="#" data-popup="true">Guest Refund Policy</a>, and <a href="#" data-popup="true">Host Guarantee Terms</a>.</small>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="bottom-line">
                                <div class="clearfix"></div>
                                <div class="row accountsignup">
                                    <div class="col-sm-6 donotaccount">
                                        <p>Already an Tutify Member?</p>
                                    </div>
                                    <div class="col-sm-6 signup">
                                        <p><a data-toggle="modal" class="btn" data-dismiss="modal" id="log-in-link"> Log in </a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                        <!--form-->
                        <form class="form-inline" action="{{url('register')}}" id="manualSignup" method="post" style="display: none">
                            @csrf
                            <!--<h6 class="btn-google">Sign up with <span>Facebook</span> or <span>Google</span></h6>-->
                            <!--                            <div class="col-sm-12">
                                                            <div class="signup-or-separator">
                                                                <span class="h6 signup-or-separator--text">or</span>
                                                                <hr>
                                                            </div>
                                                        </div>-->
                            <div class="col-sm-12">
                                <div class="form-field">
                                    <div class="alert alert-dismissible text-center" id="server_resposne" style="display: none;">
                                        <button type="button" class="close"></button>
                                        <span id="server_resposne_msg"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row custom-gutter">
                                    <div class="col-sm-6">
                                        <div class="form-field">
                                            <!--<label for="name">Name:</label>-->
                                            <input type="text" class="form-control" id="fname" placeholder="First name" name="fname">
                                            <span class="form-icon"><img src="{{url('public/sites/images/name-icon.png')}}"></span>
                                            @if ($errors->has('fname'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('fname') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-field">
                                            <!--<label for="name">Name:</label>-->
                                            <input type="text" class="form-control" id="lname" placeholder="Last name" name="lname">
                                            <span class="form-icon"><img src="{{url('public/sites/images/name-icon.png')}}"></span>
                                            @if ($errors->has('lname'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('lname') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-field">
                                    <!--<label for="email">Email:</label>-->
                                    <input type="email" class="form-control" id="email" placeholder="Email address" name="email" autocomplete="false">
                                    <span class="form-icon"><img src="{{url('public/sites/images/email-icon.png')}}"></span>
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row custom-gutter">

                                    <div class="col-md-6">
                                        <div class="form-field">
                                            <!--<label for="password">Password:</label>-->
                                            <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                                            <span class="form-icon showPwd"><img src="{{url('public/sites/images/pass-icon.png')}}"></span>
                                            @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-field">
                                            <!--<label for="cpassword"> Confirm Password:</label>-->
                                            <input type="password" class="form-control" id="password_confirmation" placeholder="Confirm password" name="password_confirmation">
                                            <span class="form-icon showCnfrmPwd"><img src="{{url('public/sites/images/pass-icon.png')}}"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-field">
                                            <strong class="brthdy">Birthday </strong>
                                            <strong id="birthday-signup-form-question-trigger"><i class="fa fa-question-circle"></i> </strong>
                                        </div>
                                    </div>
                                </div>
                                <div class="row custom-gutter">
                                    <div class="col-sm-4">
                                        <select class="form-control" name="months" id="months">
                                            <?php
                                            foreach ($dob['months'] as $key => $value) {
                                                ?>
                                                <option value="<?= $key ?>" <?= (@$UserDob['months'] == $key) ? 'selected' : '' ?>><?= $value ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="days" id="days">
                                            <?php
                                            foreach ($dob['days'] as $key => $value) {
                                                ?>
                                                <option value="<?= $value ?>" <?= (@$UserDob['days'] == ($key + 1)) ? 'selected' : '' ?>><?= $value ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="years" id="years">
                                            <?php
                                            foreach ($dob['years'] as $key => $value) {
                                                ?>
                                                <option value="<?= $value ?>" <?= (@$UserDob['years'] == $value) ? 'selected' : '' ?>><?= $value ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!--<button class="button clear" type="reset">Clear</button>-->

                            <!-- server response -->
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="remember" id="tos_outside">
                                            <label class="container1">
                                                <input type="checkbox" name="remember_me">
                                                <span class="checkmark"></span>
                                                <small>By signing up, I agree to Tutify's <a href="#" data-popup="true">Terms of Service</a>, <a href="#" data-popup="true">Privacy Policy</a>, <a href="#" data-popup="true">Guest Refund Policy</a>, and <a href="#" data-popup="true">Host Guarantee Terms</a>.</small>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 loginbtn">
                                        <button type="submit" id="btn_registration" class="btn btn-block btn-danger btn-lg " id="user-login-btn">Sign Up</button>
                                    </div>
                                    <div class="col-sm-12">                                        
                                        <hr class="bottom-line">
                                        <div class="clearfix">
                                            <div class="row accountsignup">
                                                <div class="col-sm-6 donotaccount">
                                                    <p>Already an Betting Member?</p>
                                                </div>
                                                <div class="col-sm-6 signup">
                                                    <p><a data-toggle="modal" class="btn" data-dismiss="modal" id="log-in-link"> Log in </a></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </form>
                        <!--end-->
                    </div>

                </div>
            </div>
        </div>
        <!-- Login Modal -->
        <div class="modal alert-modal fade login-model" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="LoginModalLabel" aria-hidden="true">
            <div class="modal-vertical">
                <div class="modal-vertical-inner">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content ">
                            <div class="f_msg" style="display: none;"></div>
                            <div class="modal-header">
                                <h2>LOGIN</h2>
                                <button type="button" class="btn-dismiss-modal" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <div class="col-sm-12">
                                    <a href='{{ url('/facebook-login') }}' class='btn-facebook'>
                                        <span class="icon-container"><i class="fa fa-facebook"></i></span>
                                        <span class="text-container">Log in with Facebook</span>
                                    </a>

                                    <a href='{{ url('/google-login') }}' class="btn-google">
                                        <span class="icon-container g-icon"><img src="{{url('public/sites/images/google_icon.png')}}"></span>
                                        <span class="text-container">Log in with Google</span>
                                    </a>

                                    <div class="clearfix"></div>
                                </div>
                                <div class="col-sm-12">

                                    <div class="signup-or-separator">
                                        <span class="h6 signup-or-separator--text">or</span>
                                        <hr>
                                    </div>
                                </div>

                                <form action="{{url('login')}}" class="login-form" id="login_form" method="post" accept-charset="utf-8" novalidate="novalidate">
                                    @csrf
                                    <div id="input-formm">
                                        <div class="col-sm-12">    
                                            <div class="errMsg align-center" id="errMsg" style="display: none; text-align: center;height: 40px;padding-top: 6px;font-size: 16px;"></div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-field">

                                                <input type="email" class="form-control" name="username" id="username" placeholder="Email Address">
                                                <span class="form-icon"><img src="{{url('public/sites/images/email-icon.png')}}"></span>
                                                @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-field">

                                                <input type="password" class="form-control" name="password" id="pwd" placeholder="Password">
                                                <span class="form-icon showLoginPwd"><img src="{{url('public/sites/images/pass-icon.png')}}"></span>
                                                @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="row">
                                        <div id="tos_outside" class="remember col-md-6">
                                            <div class="check-sec">
                                                <label class="container1">
                                                    <input type="checkbox" name="remember_me">
                                                    <span class="checkmark"></span><span>Remember Me</span></label>
                                            </div>
                                        </div>
                                        <div class="forget_section col-md-6">
                                            <a href="{{url('password/reset')}}" class="btn" id="log-in-link">Forgot password?</a>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 loginbtn">
                                        <button type="submit" class="btn btn-block btn-danger btn-lg" id="user-login-btn">Log In</button>
                                    </div>

                                </form>
                                <div class="col-sm-12">
                                    <hr class="bottom-line">
                                    <div class="row accountsignup">
                                        <div class="col-sm-6 donotaccount">
                                            <p>Don't have an account?</p>
                                        </div>
                                        <div class="col-sm-6 signup">
                                            <p><a data-toggle="modal" class="btn" data-dismiss="modal" id="sign-up-link">Sign up</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End User login/signup Modal -->
