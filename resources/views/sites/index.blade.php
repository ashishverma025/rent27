@extends('sites.layout.Sites')
@section('content')
<style>
.center {
  text-align: center;

}
</style>
<!--Business covered sec-->
<section id="business-sec">
    <div class="container">

        <div class="all-head">
            <h2> Thousands of trucks  <span> at your fingertips. </span> </h2>
        </div>

        <div class="business-inner">
            <div class="row">
                <div class="col-lg-3 col-md-6"> 
                    <div class="business-box">
                        <img src="{{asset('assets/sites/images/business-icon1.png')}}" alt="business">
                        <h4> 24/7 Safety Services </h4>
                        <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.  </p>
                        <p> <a href="#"> Read More <img src="{{asset('assets/sites/images/read-more-arrow.png')}}" alt="arrow"> </a> </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6"> 
                    <div class="business-box">
                        <img src="{{asset('assets/sites/images/business-icon2.png')}}" alt="business">
                        <h4> Pay after loading </h4>
                        <p> We highly recommend that customers use companies and drivers that are verified. At the same time, we do not recommend our customers to give their credit card or bank information to anyone, whether they are verified or not.
We strongly advise that our customers ........... </p>
                        <p> <a href="{{url('/pay-after-loading')}}"> Read More <img src="{{asset('assets/sites/images/read-more-arrow.png')}}" alt="arrow"> </a> </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6"> 
                    <div class="business-box">
                        <img src="{{asset('assets/sites/images/business-icon3.png')}}" alt="business">
                        <h4> Get verified drivers </h4>
                        <p> Why is it so important to get verified? This will give our customers more confidence in using your drivers or company. Bob Marley said in one of his songs: “Man to man is so unjust so you don’t know who to trust. So, it is important for us to give our customers confidence in doing business with verified drivers and companies.Customers are........</p>
                        <p> <a href="{{url('/get-verified')}}"> Read More <img src="{{asset('assets/sites/images/read-more-arrow.png')}}" alt="arrow"> </a> </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6"> 
                    <div class="business-box">
                        <img src="{{asset('assets/sites/images/business-icon4.png')}}" alt="business">
                        <h4> Door-to-door support </h4>
                        <p> Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa.  </p>
                        <p> <a href="#"> Read More <img src="{{asset('assets/sites/images/read-more-arrow.png')}}" alt="arrow"> </a> </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!--Business covered sec ends-->

<!--about us sec-->
<section id="about-sec">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12">  
                <div class="about-detail">
                    <div class="all-head">
                        <!--<p>We provide best truck in Calgry</p>-->
                        <h2> About <span> Emptytruck100 </span> </h2>
                    </div>

                    <p> Emptytruck100 is a family-owned business. Global Warming is very much existent and we lose Arctic sea ice at a rate of almost 13% per decade. Trucks and cars collectively emit around 24 pounds of Carbon Dioxide and other greenhouse gases for every gallon of gas into the atmosphere. With this in mind, our business was started in 2015 with the intention of helping customers and drivers save the environment.
                     </p><br>
                     <p>
                         Why are there so many empty trucks on the streets?

                     </p>
                     <p>
                         1.    After delivering the goods, the trucks would have to......
                     </p>

                    <p class="button-hover"><a href="{{url('/aboutus')}}">read more</a></p>
                </div>
            </div>

            <div class="col-lg-6 col-md-12">  
                <div class="about-detail-img">
                    <img src="{{asset('assets/sites/images/about-img.jpg')}}" alt="about-img">
                    <div class="over-year">
                        <h4>20 </h4>
                        <p>Years of experience in this field </p>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</section>
<!--about us sec ends-->


<!--contact sec-->
<section id="contact-row">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="contact-btn"> <p> Lost Goods, issues with driver <br> Please to contact the driver or the company.</p>  </div>
            </div>
            
            <div class="col-lg-6">
                <div class="contact-emr"> <span><i class="fa fa-envelope" aria-hidden="true"></i></span> <h5> All Other Inquiry </h5> <h2> enquiry@emptytruck100.com </h2> </div>
              
            </div>
        </div>
    </div>
</section>
<!--contact sec ends-->

<!--video sec-->
<section id="video-sec">
    <div class="container-fluid">

        <!-- <div class="all-head"> <h2> Video </h2> </div> -->

        <div id="video" data-video-id="oUOmFcyOsKk">
            <!-- <a href="https://www.youtube.com/embed/oUOmFcyOsKk" class="btnPlay"></a> -->
            <a href="https://youtu.be/Ik5MgFOYIK0" class="btnPlay"></a>
            <div id="videoContainer">
                <iframe frameborder="0" allowfullscreen id="player" title="YouTube video player" height="390" width="820" src=""></iframe>

            </div>
        </div>


    </div>
</section>
<!--video sec ends-->




<!--services sec-->
<section id="advantages-sec">
    <div class="container">

        <div class="all-head">
            <h2> Our <span> Advantages </span> </h2>
        </div>
        <div class="advan">

            <div class="row">

                <div class="col-md-3 adv-left">

                    <div class="row">
                        <div class="col-lg-4"> <img src="{{asset('assets/sites/images/adv-icon1.png')}}" alt="adv">  </div>
                        <div class="col-lg-8"> 
                            <h3> Full Load Services </h3>
                            <p> We provide Full Truck load transportation services with varied type of trucks available with the click of a button.</p> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4"> <img src="{{asset('assets/sites/images/adv-icon2.png')}}" alt="adv">  </div>
                        <div class="col-lg-8"> 
                            <h3> Transparent Pricing </h3>
                            <p> We provide prices base on the goods you are transporting.
                            We also take in to in to consideration the distance.
                            </p> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4"> <img src="{{asset('assets/sites/images/adv-icon3.png')}}" alt="adv">  </div>
                        <div class="col-lg-8"> 
                            <h3> Quick & Easy Portal </h3>
                            <p> Quick & Easy Portal is also a great feature that we are looking to add to our website. This would make it easier for us to communicate with each other.</p> 
                        </div>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="adv-img"><img src="{{asset('assets/sites/images/adv-img.png')}}" alt="adv"></div>
                </div>


                <div class="col-md-3">

                    <div class="row">

                        <div class="col-lg-8"> 
                            <h3> GDPR, Data Protection </h3>
                            <p> We take great pride in protecting each and everyone’s data that uses our Site. It would be a breach for EmptyTruck100 to compromise or share Personal data.</p> 
                        </div>
                        <div class="col-lg-4"> <img src="{{asset('assets/sites/images/adv-icon4.png')}}" alt="adv">  </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-8"> 
                            <h3> Live Tracking </h3>
                            <p> Emptytruck100 live tracking system will give customers and companies the ability to track goods and trucks on the road.</p> 
                        </div>
                        <div class="col-lg-4"> <img src="{{asset('assets/sites/images/adv-icon5.png')}}" alt="adv">  </div>
                    </div>

                    <div class="row">

                        <div class="col-lg-8"> 
                            <h3> Insurance </h3>
                            <p> Insurance is one feature we are looking forward to add to EmptyTruck100. So that client would be able insure their goods. </p> 
                        </div>
                        <div class="col-lg-4"> <img src="{{asset('assets/sites/images/adv-icon6.png')}}" alt="adv">  </div>
                    </div>

                </div>


            </div>

        </div>


</section>
<!--vender ends-->


<!--faq sec-->
<section id="faq">
    <div class="container">

        <div class="all-head"><h2> Frequently Asked <span> Questions </span> </h2></div>

        @if(!empty($faqDetails))
        @foreach($faqDetails as $faqs)
        <div class="accordion" id="faq{{$faqs->id}}">
            <div class="card">
                <div class="card-header" id="faqhead{{$faqs->id}}">
                    <a href="{{url('/faq').'/'.$faqs->id}}" class="btn btn-header-link" data-toggles="collapse" data-targets="#faq{{$faqs->id}}"
                       aria-expanded="false" aria-controls="faq{{$faqs->id}}">{{$faqs->question}} </a>
                </div>

                <div id="faq{{$faqs->id}}" class="collapse" aria-labelledby="faqhead{{$faqs->id}}" data-parent="#faq{{$faqs->id}}">
                    <div class="card-body">
                        <hr>
                        <p>{{$faqs->answer}} </p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>
</section>
<!--faq sec ends-->


<!--testmonial-->
<section id="testmonial">
    <div class="container-fluid">

        <div class="tesi-inner">

            <div class="all-head">
                <h2> Testimonials </h2>
            </div>

            <div class="owl-slider col-lg-6 col-md-8 ml-auto mr-auto">
                <div id="carouselnew" class="owl-carousel">
                    @if(!empty($testimonialDetails))
                    @foreach($testimonialDetails as $testimonial)
                    <div class="item">
                        <div class="img-item"> <img class="owl-lazy" height="50" width="50" data-src="{{$testimonial->image?asset('storage/uploads/testimonial').'/'.$testimonial->image:'public/sites/images/test-img1.png'}}" alt=""></div>
                        <h3>{{$testimonial->name}} </h3>
                        <p>{!! html_entity_decode($testimonial->description) !!}</p>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>
<!--testimonial ends-->


<!--blog sec-->
<section id="blog">
    <div class="container">

        <div class="all-head">
            <p> Get upto date information from blogs and events </p>
            <h2> Our Blog & <span> Events </span> </h2>
        </div>
        <div class="blog-inner">
            <div class="row">

                <div class="col-lg-7 col-md-12">
                    <div class="blog-post">
                        <div class="row">
                            @if(!empty($blogDetails))
                            @foreach($blogDetails as $blog)
                            <div class="col-lg-6">
                                <div class="post-img"><img src="{{$blog->blog_image ? asset('storage/uploads/blog').'/'.$blog->blog_image : asset('assets/sites/images/blog-img1.jpg')}}" alt="blog"></div>
                                <h3>{{$blog->name}}  </h3>
                                <ul>
                                    <li><i class="fa fa-calendar" aria-hidden="true"></i>{{$blog->created_at->format('M d, Y')}}</li>
                                    <li><i class="fa fa-user" aria-hidden="true"></i> Nodi Blake</li>
                                </ul>
                                <p>
                                    {!! html_entity_decode($blog->description) !!}
                                </p>
                                <p> <a href="{{url('/blog').'/'.$blog->id}}"> read more <img src="{{asset('assets/sites/images/read-more-arrow.png')}}" alt="arrow"></a> </p>
                            </div>
                            @endforeach
                            @endif


                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-12">
                    <div class="post-list blog-post">

                        @if(!empty($advertisementDetails))
                        @foreach($advertisementDetails as $advertise)

                        <div class="row">
                            <div class="col-lg-3">
                                <!--<div class="date-box"> 18 <span> Oct</span> </div>-->
                                <div class="date-box"> <img src="{{$advertise->advertise_image ? asset('storage/uploads/advr').'/'.$advertise->advertise_image : asset('assets/sites/images/blog-img1.jpg')}}" height="111" width="92" alt="advertise"> </div>
                            </div>

                            <div class="col-lg-9">
                                <h3> {{$advertise->name}}  </h3>
                                <ul>
                                    <li><i class="fa fa-map-marker" aria-hidden="true"></i> Glasgow, DO4 89GR</li>
                                    <li><i class="fa fa-user" aria-hidden="true"></i> Glasgow, DO4 89GR</li>
                                </ul>
                                <p>
                                    {!! html_entity_decode($advertise->description) !!}
                                </p>
                                <!--<p> <a href="#"> read more <img src="{{asset('assets/sites/images/read-more-arrow.png')}}" alt="arrow"></a> </p>-->
                            </div>
                        </div>
                        @endforeach
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!--blog sec ends-->

<!--Sprouse sec-->
<section id="sprouse">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="sprouse-img"><img src="{{asset('assets/sites/images/truck-man.png')}}" alt="truck-man"> </div>
            </div>
            <div class="col-lg-6">
                <div class="sprouse-img-det">

                    <div class="all-head">
                        <p> Youth Fire Stop Prevention & Intervention Program. </p>
                        <h2> Few Facts About <span>Emptytruck100</span> </h2>
                        <p>
                            Every live, every property we save does matter, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud.
                        </p>
                    </div>

                    <div class="spa-facts">
                        <ul>
                            <li> <h3> 369 </h3> <p> Happy Customers </p> </li>
                            <li> <h3> 427 </h3> <p> Trucks Operations </p> </li>
                            <li> <h3> 289 </h3> <p> Lorem ipsum </p>  </li>
                            <li> <h3> 20 </h3> <p> Year of Experience </p>  </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!--Sprouse sec ends-->
<!--subscribe-->
<section id="subscribe">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <div class="subscribe-inner">
                    <div class="row">
                        <div class="col-lg-5"> <h3> Join Our Email List </h3> </div>
                        <div class="col-lg-7"> <div class="input-box"><input type="text" placeholder="Enter your email here..."><button>Submit</button></div> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--subscribe ends-->
<script>
$(document).ready(function(){
    $("#startdate_datepicker,#enddate_datepicker").on('change',function(){
        var pikupDate = $("#startdate_datepicker").val();
        var dropDate = $("#enddate_datepicker").val();
        $("#dateValErr").text("");

        if(Date.parse(pikupDate) < Date.parse(dropDate)){
            $("#startdate_datepicker").val('')
            $("#enddate_datepicker").val('')
            $("#dateValErr").text("Pickup date must be less than droping date.");
            return false;
        }
    });
});
</script>
@endsection
