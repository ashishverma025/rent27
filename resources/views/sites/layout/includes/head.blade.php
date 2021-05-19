<html lang="en"><head>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        <!-- META -->
		<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
<style>
.main-img{
background-image: url('{{ asset('assets/sites/images/uss.png')}}');
    background-repeat: no-repeat;
    position: absolute;
    width: 100%;
    height: 100%;
}
.eRrMSG{
    color: red !important;
}
</style>

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
        <script  src="{{ asset('assets/sites/js/modernizr.min.js') }}"></script> 

        <!-- FONTAWESOME STYLE SHEET -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/sites/css/bootstrap-select.min.css')}}">

        <!--<link rel="stylesheet" href="{{ asset('assets/sites/css/all.css') }}">-->
        <link rel="stylesheet" href="{{ asset('assets/sites/css/bootstrap.min.css') }}">
        <link rel='stylesheet' href="{{ asset('assets/sites/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{asset('assets/sites/css/font-awesome.min.css')}}">

        <!-- BOOTSTRAP SELECT BOX STYLE SHEET -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.1.0/css/flag-icon.min.css" rel="stylesheet">
        <link rel='stylesheet' href="{{ asset('assets/sites/css/slick.css') }}">
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css'>
        <!-- CUSTOM  STYLE SHEET -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/sites/css/custom.css?').date('Y-m-d h:i:sa')}}">  
        <!-- RESPONSIVE STYLE SHEET -->
        <link rel="stylesheet" type="text/css" href="{{asset('assets/sites/css/responsive.css')}}"> 

        <!-- GOOGLE FONTS -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;600;700;800;900&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <!--<script src="{{ asset('assets/sites/js/jquery.min.js') }}"></script>-->
        <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script> 
        <!-- BOOTSTRAP DATEPICKER -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
 </head>

    <body>
	
        <?php
        $dob = get_custom_dob();
        $userDetails = getUserDetails();
        $name = @$userDetails->name;
        $roleId = @$userDetails->role_id;
        $segment = Request::segment(1);
//        prd($segment);
        ?>
        <!-- HEADER START -->
        <meta name="UID" content="{{@$userDetails->id}}">

        <header>
            <div class="lang-social"> 
                <div class="container"> 
                <a href="#" style="color:white;font-weight: bold;">{{@$userDetails->company_name}}</a>

                    <div class="social-top">

                        <a href="https://www.facebook.com/empyytruck100/ "> <img src="{{asset('assets/sites/images/fb.png')}}"></a>
                            <a href="https://twitter.com/EmptyTruck100"> <img src="{{asset('assets/sites/images/twt.png')}}"> </a>
                           <!-- <a href="#">  <img src="{{asset('assets/sites/images/youtube.jpg')}}"> </a>-->
                               <!--<a href="#">  <img src="{{asset('assets/sites/images/ins.png')}}"> </a>-->
                      				
                           <!--<a href="#">  <img src="{{asset('assets/sites/images/google.png')}}"> </a>-->
                           <a  href="https://twitter.com/EmptyTruck100?ref_src=twsrc%5Etfw">  <img src="{{asset('assets/sites/images/twitter.jpg')}}"> </a>
                    </div>
                    <div class="nav-item dropdown">
					
                                                     <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span  class="flag-icon-squared icon main-img" > </span> </a>
                        <div class="dropdown-menu" aria-labelledby="dropdown09">
                            <script>
                                $( document ).ready(function() {
                                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                                    $.ajax({
                                            /* the route pointing to the post function */
                                            url: '{{url("/getCountries")}}',
                                            type: 'GET',
                                            /* send the csrf-token and the input to the controller */
                                            data: {_token: CSRF_TOKEN},
                                            dataType: 'JSON',
                                            /* remind that 'data' is the response of the AjaxController */
                                            success: function (data) {
                                                jQuery.each(data, function(i, val) {
                                                  $("#country-dropdown").append('<a class="dropdown-item" href="#fr"> <img src="https://flagcdn.com/w20/'+i+'.jpg"> '+val+' </a>');
                                                });
                                            }
                                    });
                                });
                            </script>
                            <div id="country-dropdown" style="overflow-y: scroll; max-height: 300px">
                                
                            </div>
                        </div>
                    </div>
                </div> 
            </div>

            <div class="top-bar"> 
                <div class="container">
                    <ul>
                        <li><a href="#"> <span> <i class="fa fa-map-marker" aria-hidden="true"></i> </span> 107 Lawrence Road, Liverpool, L15 OEF, UK</a></li>
                        <li><a href="#"> <span> <i class="fa fa-send" aria-hidden="true"></i> </span> Info@emptytruck100.com </a></li>
                        <li><a href="#"> <span> <i class="fa fa-phone" aria-hidden="true"></i> </span> 2-555-333-8886 </a></li>
                        @guest
                        <li>
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">login
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu main-nava">
                                    <li><a class="cd-signin" id="customerBtn" onclick="setType(3, 'Customer')" href="#0">Customer </a></li>
                                    <li><a href="#" onclick="setType(2, 'Driver')" id="driverBtn">Driver</a></li>
                                    <li><a href="#" onclick="setType(1, 'Company')" id="companyBtn">Company</a></li>
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
                                    <li><a class="cd-signin" href="{{url('/profile')}}">My Account </a></li>
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
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img src="{{asset('assets/sites/images/logo.png')}}" alt="logo">
                        </a> 
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-list-2" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbar-list-2">
                            <ul class="navbar-nav ml-auto">

                                <li>
                                    @if($roleId != 3) 
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">Services
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" {{Request::segment(1)}}>
                                            <li><a class="cd-signin" href="{{url('/rent-truck')}}">Rent a Truck </a></li>
                                            @if((Request::segment(1) != 'advertise-truck') || (Request::segment(1) != 'dealervehicles') || (Request::segment(1) != 'subscription'))
                                            <!-- <li><a class="cd-signin" href="{{url('/sell-truck')}}">Sell Your Truck </a></li> -->
                                            @endif
                                            <li><a class="cd-signin" href="{{url('/buy-truck')}}">Buy a Truck</a></li>
                                            <li><a class="cd-signin" href="{{url('/advertise-truck')}}">Advertise Your Truck </a></li>
                                                
                                        </ul>
                                    </div>
                                    @endif
                                </li>

                                <!--                                <li class="nav-item">
                                                                    <a class="nav-link" href="{{url('/aboutus')}}"> About Us </a>      
                                                                </li>-->
                               
                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/get_quotes')}}"> Get Quotes </a>      
                                </li>
                                <!--  
                                <li class="nav-item">
                                    <a class="nav-link" href="#blog"> Blog </a>      
                                </li>
                                -->
  

                                <li class="nav-item">
                                    <a class="nav-link" href="{{url('/contactus')}}"> Contact Us </a>      
                                </li>
                                
@if(Auth::user())
<li class="upgradebutton">
    <a href="{{ url('subscription') }}" class="button">
        Upgrade
    </a>
	</li> 
@endif 
<li class="nav-item">
   
<form action="
https://www.paypal.com/donate
" method="post" target="_top">
<input type="hidden" name="hosted_button_id" value="VV6UNZD9VNSA2" />
<input type="image" src="
https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif
" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
<img alt="" border="0" src="
https://www.paypal.com/en_GB/i/scr/pixel.gif
" width="1" height="1" />
</form>
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


        @if($segment == 'listing')
        <!--banner ends-->
        <form action="{{url('listing/truck')}}" method="post" id="searchForm">
            @csrf
            <section id="banner-sec" >
                <div class="container-fluid">
                    <img src="{{asset('assets/sites/images/slider-01.jpg')}}" alt="slider">
                    <div class="overlay-main">
                        <h1>FIND BEST RENTAL TRUCK</h1>
                        <div class="banner-overlay">
                            <p class="search-para"> Search for Cheap Rental Trucks Wherever Your Are </p>
                            <div class="over-form"> 
                                <!-- Include Bootstrap Datepicker -->
                                <div class="row dates">
                                    <div class="col-lg-4"><label>Name</label><input type="text" value="{{@$userDetails->name?@$userDetails->name:@$queryString['name']}}"  placeholder="Name" id="name" name="name" autocomplete="off"></div>
                                    <div class="col-lg-4 start_date"><label>Email</label><input type="text" value="{{@$userDetails->email?@$userDetails->email:@$queryString['email']}}" name="email" id="email"  placeholder="Email" autocomplete="off"></div>
                                    <div class="col-lg-4"><label>Mobile</label><input type="text" value="{{@$userDetails->mobile_no?@$userDetails->mobile_no:@$queryString['mobile_no']}}" placeholder="Mobile" name="mobile_no" id="mobile_no" autocomplete="off"> </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12"><label>Message</label><textarea  placeholder="Enter Message" id="message" name="message" style="width:100%" autocomplete="off">{{@$queryString['message']}}</textarea></div>
                                </div>
                                <div class="row dates">
                                    <div class="col-lg-6"><label>Picking Up Location</label><input type="text" value="{{@$queryString['pickup_location']}}" placeholder="" id="pickup_location" name="pickup_location"> <i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                    <div class="col-lg-6 start_date"><label>Picking Up Date</label><input type="text" value="{{@$queryString['pickup_date']}}" class="start_date" name="pickup_date" id="startdate_datepicker"  placeholder="Picking Up Date" autocomplete="off"> <i class="fa fa-calendar" aria-hidden="true"></i></div>
                                    <!--<div class="col-lg-3"><label>Picking Up Hour</label><input type="time" placeholder="" name="pickup_hour" id="pickup_hour"> </div>-->
                                </div>
                                <div class="row">
                                    <div class="col-lg-6"><label>Dropping Off Location</label><input type="text" value="{{@$queryString['dropping_location']}}" placeholder="" id="dropping_location" name="dropping_location"> <i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                    <div class="col-lg-6 end_date"><label>Dropping Off  Date</label><input type="text" value="{{@$queryString['drop_date']}}" class="end_date" name="drop_date" id="enddate_datepicker"   placeholder="Dropping Off  Date" autocomplete="off"> <i class="fa fa-calendar" aria-hidden="true"></i></div>
                                    <span class="eRrMSG" id="dateValErr"></span>
                                </div>
                            </div>
                            <div class="all-btns-main">
                                <a href="#" id="findTruck" class="all-btns cont-btn">Find Truck</a>
                                <a href="#" id="getQuote" class="all-btns find-btn">Get Quotes</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
        @endif
         @if($segment == '')

        <!--banner ends-->
        <form action="{{url('listing/truck')}}" method="post" id="searchForm">
            @csrf
            <section id="banner-sec" >
                <div class="container-fluid">
                    <img src="{{asset('assets/sites/images/slider-01.jpg')}}" alt="slider">
                    <div class="overlay-main">
                        <h1>FIND BEST RENTAL TRUCK</h1>
                        <div class="banner-overlay">
                            <p class="search-para"> Search for Cheap Rental Trucks Wherever Your Are </p>
                            <div class="over-form"> 
                                <!-- Include Bootstrap Datepicker -->
                                
                                
                                <div class="row dates">
                                    <div class="col-lg-6"><label>Picking Up Location</label><input type="text" value="{{@$queryString['pickup_location']}}" placeholder="" id="pickup_location" name="pickup_location"> <i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                    <div class="col-lg-6 start_date"><label>Picking Up Date</label><input type="text" value="{{@$queryString['pickup_date']}}" class="start_date" name="pickup_date" id="startdate_datepicker"  placeholder="Picking Up Date" autocomplete="off"> <i class="fa fa-calendar" aria-hidden="true"></i></div>
                                    <!--<div class="col-lg-3"><label>Picking Up Hour</label><input type="time" placeholder="" name="pickup_hour" id="pickup_hour"> </div>-->
                                </div>
                                <div class="row">
                                    <div class="col-lg-6"><label>Dropping Off Location</label><input type="text" value="{{@$queryString['dropping_location']}}" placeholder="" id="dropping_location" name="dropping_location"> <i class="fa fa-map-marker" aria-hidden="true"></i></div>
                                    <div class="col-lg-6 end_date"><label>Dropping Off  Date</label><input type="text" value="{{@$queryString['drop_date']}}" class="end_date" name="drop_date" id="enddate_datepicker"   placeholder="Dropping Off  Date" autocomplete="off"> <i class="fa fa-calendar" aria-hidden="true"></i></div>
                                    <!--<div class="col-lg-3 date" id="pickoff_hour"><label>Picking Off Hour</label><input type="time" name="pickoff_hour" placeholder="" ></div>-->
                                </div>
                            </div>
                            <div class="all-btns-main">
                                <!-- <button type="submit" class="all-btns  find-btn">Find Truck</button> -->
                                <a href="javascript:void(0)" id="findTruck" class="all-btns  find-btn">Find Truck</a>
							
                               
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
        @endif
        @if (Session::has('message'))
        <div style="height:100px; width:500px;color:red;margin-left: 403px;" class="alert alert-info ">{{ Session::get('message') }}</div>
        @endif

        <script>

            $('#getQuote').click(function () {
                $('#searchForm').attr('action', "{{url('saveEnquiry')}}");
                setTimeout(function () {
                    $("#searchForm").submit()
                }, 2000);

            });

            $('#findTruck').click(function () {
                
                $("#searchForm").submit()

            });
        </script>


