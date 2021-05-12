@if(Session::has('role_id_click'))
Role Id : {{ Session::get('role_id_click') }}
@endif

<footer id="footer">
    <div class="container">
        <div class="footer-menu">
            <div class="row">

                <div class="col-xl-3 col-md-6 col-sm-6"> 
                    <div class="footer-col footer-logo">
                        <img src="{{asset('assets/sites/images/footer-logo.png')}}" alt="footer">
                        <p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                        </p>

                        <p><a href="#">read more <img src="{{asset('assets/sites/images/red-arrow.png')}}" alt="arrow"> </a></p>

                        <ul class="social-icons">
                            <li><a href="#"><i class="fa fa-facebook-f" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa fa-instagram" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 col-sm-6"> 
                    <div class="footer-col quick-links">
                        <h3> Information </h3>
                        <ul>
                            <li><a href="{{url('/')}}">Home</a> </li>
                            <li><a href="{{url('/aboutus')}}">About Us</a> </li>
                            <li><a href="{{url('/')}}">Services</a> </li>
                            <li><a href="{{url('/contactus')}}">Contct Us</a> </li>
                                <li><a href="{{url('/privacy-procedure')}}">Privacy Procedure</a> </li>
                            <!--
                            <li><a href="{{url('/buy_truck')}}">Buy Truck</a> </li>
                            
                            <li><a href="#">Blog</a> </li>
                            <li><a href="#">FAQ</a> </li>
                            <li><a href="#">Locations</a> </li>
                            <li><a href="#testimonial">Testimonials</a> </li>
                            <li><a href="#">Partners</a> </li>
                            -->
                        </ul>  

                    </div>
                </div>

                <div class="col-xl-3 col-md-6 col-sm-6"> 
                    <div class="footer-col footer-add">
                        <h3> Categary </h3>
                        <ul>
                            <li><span> <i class="fa fa-map-marker" aria-hidden="true"></i> </span>  5399 72 Ave SE, Calgary AB, 1999999 St, Edmonton AB </li>
                            <li><span> <i class="fa fa-mobile" aria-hidden="true"></i> </span> +1234-546-789 </li>
                            <li><span> <i class="fa fa-envelope-o" aria-hidden="true"></i> </span> Info@emptytruck100.com </li>
                            <li><span> <img src="{{asset('assets/sites/images/time-icon.png')}}" alt="time-icon"> </span> 24/7 </li>
                        </ul> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bot">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p> &copy; 2019 Emptytruck100, Inc. All Rights Reserved </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--footer ends-->

<!-- popup form-->
@if (Session::has('message'))
   <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="cd-user-modal  @if(Auth::user()) hide-model-login @else @endif"> <!-- this is the entire modal form, including the background -->
    <div class="cd-user-modal-container"> <!-- this is the container wrapper -->
        <ul class="cd-switcher">
            <li><a href="#0">Sign in</a></li>
            <li><a href="#0">New account</a></li>
        </ul>
        <input type="hidden" id="role_type" name="role_type" value="">
        <input type="hidden" id="signin_url" value="{{url('signin')}}">
        <input type="hidden" id="signup_url"  value="{{url('registration')}}">
        <div id="cd-login"> 
            <!-- log in form -->
        
            <form class="cd-form" action="{{url('login')}}" id="login_form" method="post">
                @csrf
                <p class="fieldset">
                <div class="full-width" ><span id="userType"></span> Login</div>
                </p>
                <p class="fieldset">
                    <label class="image-replace cd-email" for="username">E-mail</label>
                    <input class="full-width has-padding has-border" name="username" id="username" type="email" placeholder="E-mail">
                    <span class="cd-error-message" id="loginErrMsg"></span>
                </p>
                <p class="fieldset">
                    <label class="image-replace cd-password" for="pwd">Password</label>
                    <input class="full-width has-padding has-border" name="password" id="pwd" type="password"  placeholder="Password">
                    <a href="#0" class="hide-password">Show</a>
                    <span class="cd-error-message" id="pwdErrMsg">Error message here!</span>
                </p>

                <p class="fieldset">
                    <input type="checkbox" id="remember-me" checked>
                    <label for="remember-me">Remember me</label>
                    <span class="cd-form-bottom-message"><a href="{{url('password/reset')}}">Forgot your password?</a></span>
                </p>
                <p class="signin-socialmedia">
         <a href="{{ url('/auth/facebook') }}"><img src="{{asset('assets/sites/images/f-signin.jpg')}}"></a>
                <a href="{{ url('/auth/twitter') }}" ><img src="{{asset('assets/sites/images/twitterlink.jpg')}}" ></a>
                    <a href="{{ url('/auth/google') }}"><img src="{{asset('assets/sites/images/g-signin.jpg')}}" ></a>
                </p>


                <p class="fieldset">
                    <input class="full-width" type="submit" value="Login" id="user-login-btn">
                </p>
            </form>
            
            <!-- <a href="#0" class="cd-close-form">Close</a> -->
        </div> <!-- cd-login -->

        <div id="cd-signup"> <!-- sign up form -->
            <span class='err' id="signuperr"></span>
            <form class="cd-form" id="signUpForm" action="{{url('register')}}" method="post">
                @csrf
                <p class="fieldset">
                    <span class="cd-error-message" id="signUpErr">Error message here!</span>
                </p>

                <p class="fieldset">
                    <label class="image-replace"  >Role</label>
                    <select name="role_id" class="full-width has-padding has-border form-control" id="role_id">
                        <option value="" >Select Role</option>
                        <option value="1" >Company</option>
                        <option value="2" >Driver</option>
                        <option value="3" >Customer</option>
                    </select>
                    <span class="cd-error-message">Error message here!</span>
                </p>
                
                <span id="company_fields" style="display: none;">
                    <p class="fieldset">
                        <label class="image-replace cd-username" for="company_name">Company Name</label>
                        <input class="full-width has-padding has-border" id="company_name" name="company_name" type="text" placeholder="Company Name">
                        <span class="cd-error-message">Error message here!</span>
                    </p>

                    <p class="fieldset">
                        <label class="image-replace cd-username" for="company_registration_number">Registration Number</label>
                        <input class="full-width has-padding has-border" id="company_registration_number" name="company_registration_number" type="text" placeholder="Company Registration Number">
                        <span class="cd-error-message">Error message here!</span>
                    </p>
                </span>

               <!--<p class="fieldset">
                    <label class="image-replace"  >User Type</label>
               <select class="full-width has-padding has-border form-control" id="signupUserType">
                        <option value="" >Select User Type</option>
                        <option value="Silver" >Silver</option>
                        <option value="Gold" >Gold</option>
                    </select>
                    <span class="cd-error-message">Error message here!</span>
                </p> -->

                <p class="fieldset">
                    <label class="image-replace cd-username" for="fname">First Name</label>
                    <input class="full-width has-padding has-border" id="fname" name="fname" type="text" placeholder="First Name">
                    <span class="cd-error-message">Error message here!</span>
                </p>
                <p class="fieldset">
                    <label class="image-replace cd-username" for="lname">Last Name</label>
                    <input class="full-width has-padding has-border" id="lname" name="lname" type="text" placeholder="Last Name">
                    <span class="cd-error-message">Error message here!</span>
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-email" for="email">E-mail</label>
                    <input class="full-width has-padding has-border" id="email" name="email" type="email" placeholder="E-mail">
                    <span class="cd-error-message">Error message here!</span>
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-password" for="password">Password</label>
                    <input class="full-width has-padding has-border" id="password" type="password" name="password" placeholder="Password">
                    <a href="#0" class="hide-password">Show</a>
                    <span class="cd-error-message">Error message here!</span>
                </p>
                <p class="fieldset">
                    <label class="image-replace cd-password" for="password_confirmation">Confirm Password</label>
                    <input class="full-width has-padding has-border" id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm Password">
                    <span class="cd-error-message">Error message here!</span>
                </p>
                <!--<p class="fieldset">
                    <label class="image-replace " for="signup-dob">Date of birth</label>
                    <input class="full-width has-padding has-border" id="signup-dob" type="text" name="dob" placeholder="DOB">
                </p>-->
                <p class="fieldset">
                    <input type="checkbox" id="accept-terms" name="accept-terms">
                    <label for="accept-terms">I agree to the <a href="#0">Terms</a></label>
                </p>

                <span id="responseMessage" style="color: red;"></span>

                <input type="submit" class="full-width has-padding" id="" value="Create account">
                
                <p class="fieldset">
<!--                    <input type="submit" class="full-width has-padding" id="signupBtn" value="Create account">-->
                </p>
            </form>

            <!------ Nishant Code Start ------->

            <script type="text/javascript">

                $('#signUpForm').validate({
                    rules: {
                        role_id: {
                            required: true,
                        },
                        fname: {
                            required: true,
                        },
                        lname: {
                            required: true,
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        password: {
                            required: true,
                        },
                        password_confirmation: {
                            equalTo: "#password"
                        },
                        company_name: {
                            required: true,
                        },
                        company_registration_number: {
                            required: true,
                        },
                        "accept-terms": {
                            required: true,
                            minlength: 1
                        },
                    },
                    submitHandler: function(form) {
                        var formdata = $('#signUpForm').serialize(); // here $(this) refere to the form its submitting
                        $.ajax({
                            type: 'POST',
                            url: "{{ url('/register') }}",
                            data: formdata, // here $(this) refers to the ajax object not form
                            success: function (data) {
                                if(data.error)
                                {
                                    $("#responseMessage").html('');
                                    jQuery.each(data.error, function(i, val) {
                                        $("#responseMessage").append('<li>'+ val +'</li>');
                                    });
                                }
                                if(data.resCode == 0)
                                {

                                    location.reload();
                                }
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                        return false;
                    }
                });
            </script>

            <!------ Nishant Code End ------->



            <!-- <a href="#0" class="cd-close-form">Close</a> -->
        </div>
        <!-- cd-signup -->

        <div id="cd-reset-password"> <!-- reset password form -->
            <p class="cd-form-message">Lost your password? Please enter your email address. You will receive a link to create a new password.</p>

            <form id="forgetPass" class="cd-form" method="POST" action="{{ url('/forget-password') }}">
                @csrf
                <p class="fieldset">
                    <label class="image-replace cd-email" for="reset-email">E-mail</label>
                    <!--<input class="full-width has-padding has-border" id="reset-email" type="email" placeholder="E-mail">-->
                    <!--<span class="cd-error-message">Error message here!</span>-->
                    <input id="email" type="email" required class="full-width has-padding has-border @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </p>

                <p class="fieldset">
                    <input id="reset-password-button" class="full-width has-padding" type="submit" value="Reset password">
                </p>
                <span style="color: #c80c0c" id="forget-pass-msg"></span>
            </form>
            
            <script>
                $('#forgetPass').validate({
                    rules: {
                        email: {
                            required: true,
                            email: true
                        }
                    },
                    submitHandler: function(form) {
                        var formdata = $('#forgetPass').serialize(); // here $(this) refere to the form its submitting
                        $("#reset-password-button").prop('disabled', true);
                        $.ajax({
                            type: 'POST',
                            url: "{{ url('/forget-password') }}",
                            data: formdata, // here $(this) refers to the ajax object not form
                            success: function (data) {
                                if(data.error)
                                {
                                    $("#forget-pass-msg").html('');
                                    jQuery.each(data.error, function(i, val) {
                                        $("#forget-pass-msg").append('<li>'+ val +'</li>');
                                    });
                                    $("#reset-password-button").prop('disabled', false);
                                }
                                if(data.status == 'error')
                                {
                                    $("#forget-pass-msg").html(data.message);
                                    $("#reset-password-button").prop('disabled', false);
                                }
                                if(data.status == 'success')
                                {
                                    $("#forget-pass-msg").html(data.message);
                                    $("#reset-password-button").prop('disabled', false);
                                }
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                        return false;
                    }
                });
            </script>
            
            <p class="cd-form-bottom-message"><a href="#0">Back to log-in</a></p>
        </div> 
        <!-- cd-reset-password -->
        <a href="#0" class="cd-close-form">Close</a>
    </div> <!-- cd-user-modal-container -->
</div> <!-- cd-user-modal -->
<!-- popup forms end-->

<script>
    function setType(rId, name) {
        var role_id = rId;
        $("#role_type").val(rId);
        $("#userType").text(name);

        /*Ajax Request Header setup*/
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('set-user-type-session')}}",
            type: 'post',
            dataType: "json",
            data: {role_id: role_id},
            success: function(response){
                console.log(response);
            }
        });
    }


    $("#signupType").on('change', function () {
        var rId = this.value;
        $("#role_type").val(rId)
    })
</script>
<script>
    $(document).ready(function () {
        var date = new Date();
        var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
        var end = new Date(date.getFullYear(), date.getMonth(), date.getDate());

        $("#startdate_datepicker").datepicker({
            format: "yyyy-mm-dd",
            todayHighlight: true,
            startDate: today,
//                                endDate: end,
            autoclose: true
        });
        $("#enddate_datepicker").datepicker({
            format: "yyyy-mm-dd",
            todayHighlight: true,
            startDate: today,
//                                endDate: end,
            autoclose: true
        });
    });
    
    // Nishant Code
    $("#role_id").on("change", function(){
        var role_id = this.value;
        if(role_id == 1){
            $("#company_fields").css('display', 'block');
            $("#company_name").prop('disabled', false);
            $("#company_registration_number").prop('disabled', false);
        }
        else{
            $("#company_fields").css('display', 'none');
            $("#company_name").prop('disabled', true);
            $("#company_registration_number").prop('disabled', true);
        }
    });
</script> 


<!-- script -->
<script  src="{{ asset('assets/sites/js/modernizr.min.js') }}"></script> 
<script  src="{{ asset('assets/sites/js/login_script.js') }}"></script> 
<script  src="{{ asset('assets/sites/js/custom.js') }}"></script> 
<script src="{{ asset('assets/sites/js/popper.min.js') }}"></script> 
<script src="{{ asset('assets/sites/js/bootstrap-select.min.js') }}"></script> 
<script src="{{ asset('assets/sites/js/bootstrap.min.js') }}"></script> 

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script src="{{ asset('assets/sites/js/owl.carousel.min.js') }}"></script> 
<!--<script type="text/javascript" src="{{ asset('assets/sites/js/main.js') }}"></script>-->


<script>
$('#signupRole').on('change', function() {
if(this.value == 3){
    $("#signup-fname").attr('placeholder','Company Name')
    $("#signup-lname").attr('placeholder','Registration #')
}else{
    $("#signup-fname").attr('placeholder','First Name')
    $("#signup-lname").attr('placeholder','Last Name')
}
});
</script>
<script>
            $(window).scroll(function () {
        if ($(window).scrollTop() >= 42) {
            $('.main-nav').addClass('fixed-header');
            $('.main-nav').addClass('visible-title');
        } else {
            $('.main-nav').removeClass('fixed-header');
            $('.main-nav').removeClass('visible-title');
        }
    });

//ll

    $(function () {
        $('.selectpicker').selectpicker();
    });


//testimonial
    jQuery("#carouselnew").owlCarousel({
        autoplay: true,
        lazyLoad: true,
        loop: true,
        margin: 50,
        /*
         animateOut: 'fadeOut',
         animateIn: 'fadeIn',
         */
        responsiveClass: true,
        autoHeight: true,
        autoplayTimeout: 7000,
        smartSpeed: 800,
        nav: true,
        responsive: {
            0: {
                items: 1
            },

            600: {
                items: 1
            },

            1024: {
                items: 1
            },

            1366: {
                items: 1
            }
        }
    });


//language script
    $(function () {
        $('.selectpicker').selectpicker();
        $('pick__lang').selectpicker();
    });

    function go__bahasa() {
        location = document.pilih__bahasa.ipicked__bahasa.
                options[document.pilih__bahasa.ipicked__bahasa.selectedIndex].value
    }

//youtube
    $(document).ready(function () {
        var video_src = "https://www.youtube.com/embed/" + $("#video").data("video-id") + "?&autoplay=1";
        $(".btnPlay").click(function (e) {
            $("#player").attr("src", video_src).addClass("active")
            $(".caseStudyImage, .btnPlay").addClass("displayNone");
            e.preventDefault();
        });
    });
</script>



<script>

//language script
    $(function () {
        $('.selectpicker').selectpicker();
        $('pick__lang').selectpicker();
    });

    function go__bahasa() {
        location = document.pilih__bahasa.ipicked__bahasa.
                options[document.pilih__bahasa.ipicked__bahasa.selectedIndex].value
    }

//youtube
    $(document).ready(function () {
        var video_src = "https://www.youtube.com/embed/" + $("#video").data("video-id") + "?&autoplay=1";
        $(".btnPlay").click(function (e) {
            $("#player").attr("src", video_src).addClass("active")
            $(".caseStudyImage, .btnPlay").addClass("displayNone");
            e.preventDefault();
        });
    });
</script>


<script>
    var x, i, j, l, ll, selElmnt, a, b, c;
    /*look for any elements with the class "custom-select":*/
    x = document.getElementsByClassName("custom-select");
    l = x.length;
    for (i = 0; i < l; i++) {
        selElmnt = x[i].getElementsByTagName("select")[0];
        ll = selElmnt.length;
        /*for each element, create a new DIV that will act as the selected item:*/
        a = document.createElement("DIV");
        a.setAttribute("class", "select-selected");
        a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
        x[i].appendChild(a);
        /*for each element, create a new DIV that will contain the option list:*/
        b = document.createElement("DIV");
        b.setAttribute("class", "select-items select-hide");
        for (j = 1; j < ll; j++) {
            /*for each option in the original select element,
             create a new DIV that will act as an option item:*/
            c = document.createElement("DIV");
            c.innerHTML = selElmnt.options[j].innerHTML;
            c.addEventListener("click", function (e) {
                /*when an item is clicked, update the original select box,
                 and the selected item:*/
                var y, i, k, s, h, sl, yl;
                s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                sl = s.length;
                h = this.parentNode.previousSibling;
                for (i = 0; i < sl; i++) {
                    if (s.options[i].innerHTML == this.innerHTML) {
                        s.selectedIndex = i;
                        h.innerHTML = this.innerHTML;
                        y = this.parentNode.getElementsByClassName("same-as-selected");
                        yl = y.length;
                        for (k = 0; k < yl; k++) {
                            y[k].removeAttribute("class");
                        }
                        this.setAttribute("class", "same-as-selected");
                        break;
                    }
                }
                h.click();
            });
            b.appendChild(c);
        }
        x[i].appendChild(b);
        a.addEventListener("click", function (e) {
            /*when the select box is clicked, close any other select boxes,
             and open/close the current select box:*/
            e.stopPropagation();
            closeAllSelect(this);
            this.nextSibling.classList.toggle("select-hide");
            this.classList.toggle("select-arrow-active");
        });
    }
    function closeAllSelect(elmnt) {
        /*a function that will close all select boxes in the document,
         except the current select box:*/
        var x, y, i, xl, yl, arrNo = [];
        x = document.getElementsByClassName("select-items");
        y = document.getElementsByClassName("select-selected");
        xl = x.length;
        yl = y.length;
        for (i = 0; i < yl; i++) {
            if (elmnt == y[i]) {
                arrNo.push(i)
            } else {
                y[i].classList.remove("select-arrow-active");
            }
        }
        for (i = 0; i < xl; i++) {
            if (arrNo.indexOf(i)) {
                x[i].classList.add("select-hide");
            }
        }
    }
    /*if the user clicks anywhere outside the select box,
     then close all select boxes:*/
    document.addEventListener("click", closeAllSelect);
</script>
<style>
#login_form .cd-form-bottom-message {
    position: inherit;
    width: auto;
    left: 0;
    bottom: unset;
    float: right;
}
#login_form .cd-form-bottom-message a {
    color: #5a8292;
}    
</style>
</body>
</html>