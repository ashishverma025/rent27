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

<!-- script -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>




<script>

    var loginObj = {
        init: function () {
            loginObj.holdFormSubmit();
            loginObj.formValidation();
            loginObj.loginFunction();
        },
        holdFormSubmit: function () {
            // Form validations
            $('#login_form').submit(function (e) {
                e.preventDefault();
            });
        },
        formValidation: function () {
            $('#login_form').validate({
                rules: {
                    username: {
                        required: true,
                        validateEmail: true,
                        email: true,
                    },
                    password: {
                        required: {
                            depends: function () {
                                $(this).val($.trim($(this).val()));
                                return true;
                            }
                        },
                    }

                },
                messages: {
                    username: {
                        required: 'Please enter email address',
                        email: 'Please enter a valid email id',
                        validateEmail: 'Please enter a valid email id'
                    },
                    password: {
                        required: 'Please enter password',
                    },
                }
            });
        },
        loginFunction: function () {
            // Login functionality
            $('#user-login-btn').click(function () {
                // Check the validation
                if ($('#login_form').valid()) {
                    // Hold the button reference
                    var btn = $(this);
                    $('#server_resposne').hide();
                    $('#server_resposne_msg').html('');
                    var email = $("#username").val()
                    var password = $("#pwd").val()

                    $.ajax({
                        url: "{{url('signin')}}",
                        method: 'post',
                        data: {
                            'email': email,
                            'password': password
                        },
                        beforeSend: function () {
                            // Disable the button
                            $(btn).attr('disabled', true);
                            $('#loading_spinner').show();
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        complete: function () {
                            // Enable the button
                            $(btn).attr('disabled', false);
                            $('#loading_spinner').hide();
                        },
                        success: function (response) {
                            console.log(response)

                            if (response.success) {
                                // Reset the form
                                $('#errMsg').show();
                                $('#login_form')[0].reset();
                                $('#errMsg').removeClass('alert-danger').addClass('alert-success');
                                $('#errMsg').html(response.message);
                                location.reload();
                                window.location.href = "{{url('/')}}"
                            } else {
                                $('#errMsg').removeClass('alert-success').addClass('alert-danger');
                                $('#errMsg').removeClass('alert-success').addClass('alert-danger');
                                $('#errMsg').html(response.message);
                                $('#errMsg').show();
                            }
                        }
                    });
                }
            });
        }
    }
</script>
<!-- script ends-->
<script>
    $(document).ready(function () {
        $('#loginModal,#log-in-link').click(function () {
            $('#LoginModal').modal('toggle');
            $('#SignUpModal').modal('hide');
        });
        $('#signUpModal,#sign-up-link').click(function () {
            $('#SignUpModal').modal('toggle');
            $("#manualSignup").hide();
            $("#socialSignup").show();
            $('#LoginModal').modal('hide');
            $('#SignUpModal').removeClass('fixedModal');
        });
        $('.modal-backdrop').click(function () {
            $('#LoginModal').modal('hide');
            $('#SignUpModal').modal('hide');
            $('.modal').remove();
            $('.modal-backdrop').remove();
            $('body').removeClass("modal-open");
        });
        //Banner_v1 script
        $('#banner_home').owlCarousel({
            items: 1,
            //animateOut: 'fadeOut',
            autoplayTimeout: 10000,
            loop: true,
            autoplay: true,
            nav: false,
            dots: false,
            mouseDrag: true,
            margin: 0,
        });
        //Banner_v1 script
        $('#video_banner').owlCarousel({
            items: 1,
            //animateOut: 'fadeOut',
            autoplayTimeout: 10000,
            loop: true,
            autoplay: true,
            nav: true,
            dots: false,
            mouseDrag: true,
            margin: 0,
        });
        // Sticky header header_v9
        $(window).scroll(function () {
            var scroll = $(window).scrollTop();
            if (scroll >= 120) {
                $("#sticky-top").addClass("sticky-nav");
            } else if (scroll <= 120) {
                $("#sticky-top").removeClass("sticky-nav");
            }
        });
    });
</script>
<script>
//fix nav top
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

</body>
</html>