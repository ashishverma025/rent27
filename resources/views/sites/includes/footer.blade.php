<!--footer-->
<footer id="footer">
    <div class="container">
        <div class="footer-menu">
            <div class="row">

                <div class="col-xl-3 col-md-6 col-sm-6"> 
                    <div class="footer-col footer-logo">
                        <img src="public/sites/images/footer-logo.png" alt="footer">
                        <p>
                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                        </p>

                        <p><a href="#">read more <img src="public/sites/images/red-arrow.png" alt="arrow"> </a></p>

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
                            <li><a href="#">Home</a> </li>
                            <li><a href="#">About</a> </li>
                            <li><a href="#">Services</a> </li>
                            <li><a href="#">Blog</a> </li>
                            <li><a href="#">Contct Us</a> </li>
                            <li><a href="#">FAQ</a> </li>
                            <li><a href="#">Locations</a> </li>
                            <li><a href="#">Testimonials</a> </li>
                            <li><a href="#">Partners</a> </li>
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
                            <li><span> <img src="public/sites/images/time-icon.png" alt="time-icon"> </span> 24/7 </li>
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

<div class="cd-user-modal"> <!-- this is the entire modal form, including the background -->
    <div class="cd-user-modal-container"> <!-- this is the container wrapper -->
        <ul class="cd-switcher">
            <li><a href="#0">Sign in</a></li>
            <li><a href="#0">New account</a></li>
        </ul>

        <div id="cd-login"> 
            <!-- log in form -->
            <form class="cd-form" action="{{url('login')}}" id="login_form" method="post">
                @csrf
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
                </p>

                <p class="fieldset">
                    <input class="full-width" type="submit" value="Login" id="user-login-btn">
                </p>
            </form>
            <p class="cd-form-bottom-message"><a href="{{url('password/reset')}}">Forgot your password?</a></p>
            <!-- <a href="#0" class="cd-close-form">Close</a> -->
        </div> <!-- cd-login -->

        <div id="cd-signup"> <!-- sign up form -->
            <form class="cd-form" action="{{url('register')}}" method="post">
                @csrf
                <p class="fieldset">
                    <span class="cd-error-message" id="signUpErr">Error message here!</span>
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-username" for="signup-fname">First Name</label>
                    <input class="full-width has-padding has-border" id="signup-fname" name="fname" type="text" placeholder="First Name">
                    <span class="cd-error-message">Error message here!</span>
                </p>
                <p class="fieldset">
                    <label class="image-replace cd-username" for="signup-lname">Last Name</label>
                    <input class="full-width has-padding has-border" id="signup-lname" name="lname" type="text" placeholder="Last Name">
                    <span class="cd-error-message">Error message here!</span>
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-email" for="signup-email">E-mail</label>
                    <input class="full-width has-padding has-border" id="signup-email" name="email" type="email" placeholder="E-mail">
                    <span class="cd-error-message">Error message here!</span>
                </p>

                <p class="fieldset">
                    <label class="image-replace cd-password" for="signup-password">Password</label>
                    <input class="full-width has-padding has-border" id="signup-password" type="password" name="password" placeholder="Password">
                    <a href="#0" class="hide-password">Show</a>
                    <span class="cd-error-message">Error message here!</span>
                </p>
                <p class="fieldset">
                    <label class="image-replace cd-password" for="signup-cpassword">Confirm Password</label>
                    <input class="full-width has-padding has-border" id="signup-cpassword" type="password" name="password_confirmation" placeholder="Confirm Password">
                    <span class="cd-error-message">Error message here!</span>
                </p>
                <p class="fieldset">
                    <label class="image-replace " for="signup-dob">Date of birth</label>
                    <input class="full-width has-padding has-border" id="signup-dob" type="text" name="dob" placeholder="DOB">
                </p>
                <p class="fieldset">
                    <input type="checkbox" id="accept-terms">
                    <label for="accept-terms">I agree to the <a href="#0">Terms</a></label>
                </p>
                    <input type="submit" class="full-width has-padding" id="signupBtn" value="Create account">

                <p class="fieldset">
<!--                    <input type="submit" class="full-width has-padding" id="signupBtn" value="Create account">-->
                </p>
            </form>
            <!-- <a href="#0" class="cd-close-form">Close</a> -->
        </div>
        <!-- cd-signup -->

        <div id="cd-reset-password"> <!-- reset password form -->
            <p class="cd-form-message">Lost your password? Please enter your email address. You will receive a link to create a new password.</p>

            <form class="cd-form">
                <p class="fieldset">
                    <label class="image-replace cd-email" for="reset-email">E-mail</label>
                    <input class="full-width has-padding has-border" id="reset-email" type="email" placeholder="E-mail">
                    <span class="cd-error-message">Error message here!</span>
                </p>

                <p class="fieldset">
                    <input class="full-width has-padding" type="submit" value="Reset password">
                </p>
            </form>
            <p class="cd-form-bottom-message"><a href="#0">Back to log-in</a></p>
        </div> <!-- cd-reset-password -->
        <a href="#0" class="cd-close-form">Close</a>
    </div> <!-- cd-user-modal-container -->
</div> <!-- cd-user-modal -->
<!-- popup forms end-->

<!-- script -->
<script src='{{ url('public/sites/js/jquery.min.js') }}'></script> 
<script src='{{ url('public/sites/js/owl.carousel.min.js') }}'></script> 
<script  src="{{ url('public/js/login_script.js') }}"></script> 
<script src="{{ url('public/sites/js/popper.min.js') }}"></script> 
<script src="{{ url('public/sites/js/bootstrap.min.js') }}"></script> 
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<!--<script type="text/javascript" src="{{ url('public/sites/js/main.js') }}"></script>-->
</body>
</html>