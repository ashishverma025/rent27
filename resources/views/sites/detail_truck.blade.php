@extends('sites.layout.Sites')
@section('content')
<input type="hidden" id="truck_id" value="{{@$truck_id}}">
<div style="clear:both"></div>
<!--truck-detail covered sec-->
<section id="truck-detail-main">
    <div class="container">
        <div class="detail-inner-box">

            <div class="row">
                <div class="col-md-9">    
                    <h2> {{@$truckDetails->truck_name}} </h2>
                    <p> ONLY 629,000KMS </p>

                    <ul class="get-fin">
                        <li><a href="#"> <img src="{{asset('assets/sites/images/')}}/cir-logo.jpg" alt="cir"> Get finance quote </a></li>
                        <li><a href="#"> <img src="{{asset('assets/sites/images/')}}/e-logo.jpg" alt="cir">   Check vehicle history </a> </li>
                    </ul>

                </div>

<!--                <div class="col-md-3">  
                    <div class="pro-cost">  
                        <h2> £35,000 + VAT </h2>
                        <h6> €38,127 </h6>
                    </div>
                </div>-->

            </div>

            <div class="row">
                <div class="col-md-6">
                    <section id="detail">
                        <div class="product-img">

                            <!-- Product Images & Alternates -->
                            <div class="product-images demo-gallery">
                                <!-- Begin Product Images Slider -->
                                <div class="main-img-slider">
                                    <a data-fancybox="gallery" href="{{asset('storage/uploads/truck')}}/{{@$truckDetails->truck_logo}}"><img src="{{asset('storage/uploads/truck')}}/{{@$truckDetails->truck_logo}}" class="img-fluid"></a>
                                    <a data-fancybox="gallery" href="{{asset('storage/uploads/truck')}}/{{@$truckDetails->truck_logo}}"><img src="{{asset('storage/uploads/truck')}}/{{@$truckDetails->truck_logo}}" class="img-fluid"></a>
                                    <a data-fancybox="gallery" href="{{asset('storage/uploads/truck')}}/{{@$truckDetails->truck_logo}}"><img src="{{asset('storage/uploads/truck')}}/{{@$truckDetails->truck_logo}}" class="img-fluid"></a>
                                    <a data-fancybox="gallery" href="{{asset('storage/uploads/truck')}}/{{@$truckDetails->truck_logo}}"><img src="{{asset('storage/uploads/truck')}}/{{@$truckDetails->truck_logo}}" class="img-fluid"></a>
                                    <a data-fancybox="gallery" href="{{asset('storage/uploads/truck')}}/{{@$truckDetails->truck_logo}}"><img src="{{asset('storage/uploads/truck')}}/{{@$truckDetails->truck_logo}}" class="img-fluid"></a>
                                    <a data-fancybox="gallery" href="{{asset('storage/uploads/truck')}}/{{@$truckDetails->truck_logo}}"><img src="{{asset('storage/uploads/truck')}}/{{@$truckDetails->truck_logo}}" class="img-fluid"></a>

                                </div>
                                <!-- End Product Images Slider -->

                                <!-- Begin product thumb nav -->
                                <ul class="thumb-nav">
                                    <li><img src="{{asset('storage/uploads/truck')}}/{{@$truckDetails->truck_logo}}"></li>
                                    <li><img src="{{asset('storage/uploads/truck')}}/{{@$truckDetails->truck_logo}}"></li>
                                    <li><img src="{{asset('storage/uploads/truck')}}/{{@$truckDetails->truck_logo}}"></li>
                                    <li><img src="{{asset('storage/uploads/truck')}}/{{@$truckDetails->truck_logo}}"></li>
                                    <li><img src="{{asset('storage/uploads/truck')}}/{{@$truckDetails->truck_logo}}"></li>
                                </ul>
                                <!-- End product thumb nav -->
                            </div>
                            <!-- End Product Images & Alternates -->

                            <div class="save-share">

                                <!--                                <ul>
                                                                    <li><a href="#"><img src="{{asset('assets/sites/images/')}}/save-icon.png" alt="save"> Save </a></li>
                                                                    <li><a href="#"><img src="{{asset('assets/sites/images/')}}/share-icon.png" alt="save"> Share </a></li>
                                                                    <li><a href="#"><img src="{{asset('assets/sites/images/')}}/print-icon.png" alt="save"> Print </a></li>
                                                                    <li><a href="#"><img src="{{asset('assets/sites/images/')}}/report-icon.png" alt="save"> Report ad</a></li>
                                                                </ul>-->

                            </div>
                        </div>
                    </section>

                </div>  

                <div class="col-md-6">
                    <div class="product-img-detail">
                        <div class="pro-logo">
                            <img src="{{ asset('storage/uploads/sites/users') }}<?= !empty($truckDetails->avatar) ? '/' . $truckDetails->user_id . '/' . $truckDetails->avatar : '/dummy.jpg' ?>"" height="60" width="60">
                            <!-- <img src="{{asset('assets/sites/images/')}}/a&m-logo.jpg" alt="logo"> -->
                         </div>

                        <h6> {{@$truckDetails->name}}  </h6>

                        <ul class="phone-no">
                            <li> {{@$truckDetails->mobile_no}} </li>
                            <!-- <li> +44 (0)88 3333 6666 </li> -->
                        </ul>

<!--                        <ul class="loc-dir">
                            <li> <img src="{{asset('assets/sites/images/')}}/map-icon.png" alt="map-icon"> Location Map  </li>
                            <li> <img src="{{asset('assets/sites/images/')}}/direction-icon.png" alt="map-icon"> Get Directions </li>
                        </ul>-->

                        <!--                        <div class="chat-status">
                                                    <img src="{{asset('assets/sites/images/')}}/wifi-icon.png"  alt="wifi-icon">
                                                    <p>Seller offline <br>
                                                        Cannot chat with seller this time</p>
                                                </div>-->

                        <div class="seller-btn">
                            <a href="#" data-toggle="modal" data-target="#forEmailSeller"> email seller </a>
                            <!-- <a href="#"> seller's website </a> -->
                        </div>

                        <div class="modal fade" id="forEmailSeller" tabindex="-1" role="dialog" aria-labelledby="forEmailSeller" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="forEmailSeller">Send email to Seller</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="leave-comment">
                                            <form action="#" class="comment-form">
                                                <div class="row">
                                                    <!-- <div class="col-lg-12">
                                                        <label class="d-block mt-3">Title</label>
                                                        <input type="text" id="complaint_title" class="form-control">
                                                    </div> -->
                                                    <div class="col-lg-12">
                                                        <label class="d-block mt-3">Enter Message</label>
                                                        <textarea class="form-control" id="email_message" rows="5" placeholder="Write Your Message"></textarea>
                                                        <button type="submit" id="emailToSaller" class="btn btn-primary mt-4">Send Email</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>




<!--                        <div class="inter-sec">
                            <h5> Interested in this vehicle? </h5>
                            <p> 
                                Find the best finance quote for trucks with our finance provider <span> Funding Options.</span>
                                <img src="{{asset('assets/sites/images/')}}/cir-logo.jpg" alt="logo">
                            </p>
                        </div>-->

<!--                        <div class="inter-sec">
                            <h5> Check the vehicle history  </h5>
                            <p> 
                                Get peace of mind before you buy with a vehicle check from <span>Experian.</span>
                                <img src="{{asset('assets/sites/images/')}}/e-logo.jpg" alt="logo">
                            </p>
                        </div>-->

                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
<!--truck-detail covered sec ends-->

<section class="addReview pb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="all-head">
                    <h2>Customer <span> Reviews </span> </h2>
                </div>
                <div class="customer-review-option">
                    @if(!empty($reviewList))
                    <p class="pb-3"><b>{{count($reviewList)}} Review</b></p>
                    @foreach($reviewList as $review)
                    <div class="comment-option">
                        <div class="co-item">
                            <div class="avatar-pic">
                                 <img src="{{ asset('storage/uploads/sites/users') }}<?= !empty($review->avatar) ? '/' . $review->user_id . '/' . $review->avatar : '/dummy.jpg' ?>" id="userImg" height="80" width="80">
                                <!-- <img src="{{asset('storage/uploads/sites/users').'/'.$review->user_id.'/'.$review->avatar}}" alt=""> -->
                            </div>
                            <div class="avatar-text">
                                <div class="at-rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <h5>{{$review->name}} </h5>
                                <h3>{{$review->created_at}}</h3>
                                <p class="at-reply">{{$review->description}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif

                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="h-100 bg-light btnaligncenter">
                    <div class="p-4">
                        @guest
                        @else
                        <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#forAddReview">Add Review</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="addReview pb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="all-head">
                    <h2>Customer <span> Complaint </span> </h2>
                </div>
                <div class="customer-review-option">
                    @if(!empty($complaintList))
                    <p class="pb-3"><b>{{count($complaintList)}} Complaint</b></p>
                    @foreach($complaintList as $complain)
                    <div class="comment-option">
                        <div class="co-item">
                            <div class="avatar-pic">
                            <img src="{{ asset('storage/uploads/sites/users') }}<?= !empty($complain->avatar) ? '/' . $complain->user_id . '/' . $complain->avatar : '/dummy.jpg' ?>" id="userImg" height="80" width="80">

                                <!-- <img src="{{asset('storage/uploads/sites/users').'/'.$complain->user_id.'/'.$complain->avatar}}" alt=""> -->
                            </div>
                            <div class="avatar-text">
                                <h5>{{$complain->name}} </h5>
                                <h3>{{$complain->created_at}}</h3>
                                <p class="at-reply">{{$complain->description}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif

                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="h-100 bg-light btnaligncenter">
                    <div class="p-4">
                        @guest
                        @else
                        <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#forAddComplaint">Add Complaint</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add Add Review modal -->
<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#forAddReview">
  Launch demo modal
</button>-->
<!-- Modal -->
<div class="modal fade" id="forAddReview" tabindex="-1" role="dialog" aria-labelledby="forAddReview" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forAddReview">Add Your Rating</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="personal-rating">
                    <div class="rating">
                        <a href="javascript:void(0);" class="active"><i class="fa fa-star"></i></a>
                        <a href="javascript:void(0);" class="active"><i class="fa fa-star"></i></a>
                        <a href="javascript:void(0);" class="active"><i class="fa fa-star"></i></a>
                        <a href="javascript:void(0);" class="active"><i class="fa fa-star"></i></a>
                        <a href="javascript:void(0);" class="no-active"><i class="fa fa-star"></i></a>
                    </div>
                    <input type="hidden" id="review_rating">
                </div>
                <div class="leave-comment">
                    <h4 class="mt-3">Leave A Comment</h4>
                    <form action="#" class="comment-form">
                        <div class="row">
                            <div class="col-lg-6">
                                <label class="d-block mt-3">Your name</label>
                                <input type="text" id="review_name" class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label class="d-block mt-3">Your email</label>
                                <input type="text" id="review_email" class="form-control">
                            </div>
                            <div class="col-lg-12">
                                <label class="d-block mt-3">Your Review</label>
                                <textarea class="form-control" id="review_comment" rows="5"></textarea>
                                <button type="button" id="userReview" class="btn btn-primary mt-4">Post Review</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Add Complaint modal -->
<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#forAddComplaint">
  Launch demo modal
</button>-->
<!-- Modal -->
<div class="modal fade" id="forAddComplaint" tabindex="-1" role="dialog" aria-labelledby="forAddComplaint" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forAddComplaint">Add Your Complaint</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="leave-comment">
                    <form action="#" class="comment-form">
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="d-block mt-3">Title</label>
                                <input type="text" id="complaint_title" class="form-control">
                            </div>
                            <div class="col-lg-12">
                                <label class="d-block mt-3">Enter Description</label>
                                <textarea class="form-control" id="complaint_description" rows="5"></textarea>
                                <button type="submit" id="userComplaint" class="btn btn-primary mt-4">Post Complaint</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!--overview-->
<section id="overview">
    <div class="container">
        <div class="overview">
            <h2> Overview </h2>
            <ul class="overiew-list">
            @if(@$truckDetails->axle_config) <li><img src="{{asset('assets/sites/images/')}}/overview-icon1.png" alt="overview1"> {{@$truckDetails->axle_config?@$truckDetails->axle_config:'N/A'}} Axle </li>@endif                         
            @if(@$truckDetails->engine_size) <li><img src="{{asset('assets/sites/images/')}}/overview-icon2.png" alt="overview1">  {{@$truckDetails->engine_size?@$truckDetails->engine_size:'N/A'}} cc </li>@endif                            
            @if(@$truckDetails->color) <li><img src="{{asset('assets/sites/images/')}}/overview-icon3.png" alt="overview1">  Automatic </li>@endif
            @if(@$truckDetails->distance_covered) <li><img src="{{asset('assets/sites/images/')}}/overview-icon4.png" alt="overview1">  {{@$truckDetails->distance_covered?@$truckDetails->distance_covered:0}} km </li>@endif
            </ul>

            <div class="categary-main">

                <div class="row">
                    <div class="col-md-6">
                        <ul>
                            @if(@$truckDetails->vehicle_type_id)<li> Category <span> {{@$truckDetails->vehicle_type_id?@$truckDetails->vehicle_type_id:'N/A'}}</span> </li>@endif
                            @if(@$truckDetails->axle_config)<li> Axle Config  <span> {{@$truckDetails->axle_config?@$truckDetails->axle_config:'N/A'}}</span> </li>@endif
                            @if(@$truckDetails->gross_vehicle_weight)<li> Gross Vehicle Weight  <span> {{@$truckDetails->gross_vehicle_weight?@$truckDetails->gross_vehicle_weight:'N/A'}} kg</span> </li>@endif
                            @if(@$truckDetails->engine_size)<li> Engine Size  <span> {{@$truckDetails->engine_size?@$truckDetails->engine_size:'N/A'}} cc</span> </li>@endif
                            @if(@$truckDetails->color) <li> Colour  <span> {{@$truckDetails->color?@$truckDetails->color:'N/A'}}</span> </li>@endif
                            @if(@$truckDetails->axle_config)<li> Transmission  <span> Automatic</span> </li>@endif
                            @if(@$truckDetails->year_of_purchase)<li> Reg Year  <span> {{@$truckDetails->year_of_purchase?@$truckDetails->year_of_purchase:'N/A'}} ( Reg)</span> </li>@endif
                        </ul>

                    </div>

                    <div class="col-md-6">
                        <ul>
                        @if(@$truckDetails->brake_horse_power)<li> Brake Horse Power  <span> {{@$truckDetails->brake_horse_power?@$truckDetails->brake_horse_power:'N/A'}} BHP </span> </li>@endif
                        @if(@$truckDetails->fuel_type_id)<li> Fuel Type  <span> {{@$truckDetails->fuel_type_id?@$truckDetails->fuel_type_id:'N/A'}}</span> </li>@endif
                        @if(@$truckDetails->interior_condition)<li> Interior Condition  <span> {{@$truckDetails->interior_condition?@$truckDetails->interior_condition:'N/A'}}</span> </li>@endif
                        @if(@$truckDetails->tyre_condition)<li> Tyre Condition  <span> {{@$truckDetails->tyre_condition?@$truckDetails->tyre_condition:'N/A'}}%</span> </li>@endif
                        @if(@$truckDetails->driver_position)<li> Driver Position   <span> {{@$truckDetails->driver_position?@$truckDetails->driver_position:'N/A'}}</span> </li>@endif
                        @if(@$truckDetails->number_of_seats)<li> Number of Seats  <span> {{@$truckDetails->number_of_seats?@$truckDetails->number_of_seats:'N/A'}}</span> </li>@endif
                        @if(@$truckDetails->condition)<li> Condition  <span> {{@$truckDetails->condition?@$truckDetails->condition:'N/A'}} </span> </li>@endif
                        </ul>
                    </div>
                </div>

<!--                <p> 2012 (61) Scania Topline, 6x2 twin wheel tag axle, 3 pedal opticruise gearbox, retarder, will Plate to 65,000kg, 610ltr fuel capacity, Euro 5 engine, Alcoa alloy wheels, top Kelsa bar and spots, beacons, leather, fridge, Bluetooth, air con, good original truck, Mot February 2021</p>

                <div class="seller-btn">
                    <a href="#"> email seller </a>-->
            </div>

        </div>

    </div>
</div>
</section>
<!--overview ends-->


<!--auto trader-->
<!--<section id="auto-trader">
    <div class="container">
        <div class="auto-trader">
            <h2> Auto Trader Trucks vehicle check </h2>
            <h5> Recorded as Category </h5>

            <div class="cate-c">
                <p> 
                    Category C. At some point this vehicle was damaged and written off by an insurer because it was uneconomical to repair. The category of write off can vary depending on the vehicle's age and value. Category C vehicles are often put back on the road.
                </p>

                <p><a href="#"> Learn more about insurance categories </a> </p>
                <p><a href="#"> Buy full check </a> </p>

            </div>


            <div class="auto-trader-trucks">
                <h4> Auto Trader Trucks 5 vehicle checks </h4>
                <div class="row">

                    <div class="col-md-6">
                        <ul>
                            <li> Stolen <span> Clear <img src="{{asset('assets/sites/images/')}}/red-tick.png" alt="red-tick"></span></li>
                            <li> Scrapped <span> Clear <img src="{{asset('assets/sites/images/')}}/red-tick.png" alt="red-tick"> </span></li>
                            <li> Category C/D/S/N <span> Advisory <i class="fa fa-exclamation-circle" aria-hidden="true"></i> </span></li>
                        </ul>
                    </div> 

                    <div class="col-md-6">
                        <ul>
                            <li> Imported <span> Clear <img src="{{asset('assets/sites/images/')}}/red-tick.png" alt="red-tick"></span></li>
                            <li> Exported <span> Clear <img src="{{asset('assets/sites/images/')}}/red-tick.png" alt="red-tick"> </span></li>
                        </ul>
                    </div> 

                </div>
            </div>

            <div class="auto-trader-trucks">
                <h4> Further recommended checks </h4>
                <p> The seller may have conducted their own full check. </p>
                <div class="row">

                    <div class="col-md-6">
                        <ul>
                            <li> Outstanding Finance <span> Clear <img src="{{asset('assets/sites/images/')}}/lock.png" alt="lock"></span></li>
                            <li> Mileage Data <span> Clear <img src="{{asset('assets/sites/images/')}}/lock.png" alt="lock"> </span></li>
                            <li> Colour Changes <span> Advisory <img src="{{asset('assets/sites/images/')}}/lock.png" alt="lock"> </span></li>
                            <li> Recorded Vehicle Data (13) <span> Clear <img src="{{asset('assets/sites/images/')}}/lock.png" alt="lock"> </span></li>
                            <li> Environmental Report <span> Advisory <img src="{{asset('assets/sites/images/')}}/lock.png" alt="lock"> </span></li>
                        </ul>
                    </div> 

                    <div class="col-md-6">
                        <ul>
                            <li> Previous Keepers <span> Clear <img src="{{asset('assets/sites/images/')}}/lock.png" alt="lock"></span></li>
                            <li> Reg Plate Changes <span> Clear <img src="{{asset('assets/sites/images/')}}/lock.png" alt="lock"> </span></li>
                            <li> High Risk Vehicle <span> Clear <img src="{{asset('assets/sites/images/')}}/lock.png" alt="lock"></span></li>
                            <li> Extra Data <span> Clear <img src="{{asset('assets/sites/images/')}}/lock.png" alt="lock"> </span></li>
                        </ul>
                    </div> 

                </div>

                <div class="row">
                    <div class="col-md-6 ml-auto">
                        <div class="seller-btn pow-by"> <h6> Powered By </h6>  <img src="{{asset('assets/sites/images/')}}/experian-logo.jpg" alt="exp"> <a href="#"> BUY FULL CHECK </a>  </div>
                    </div>
                </div>


            </div>

            <div class="row">
                <div class="col-md-12 vehicle-check">
                    <p> The 5 checks were performed when the advert was placed and therefore the information may be out of date. We advise you to carry out your own enquiries into the vehicle's history, for example by purchasing a full vehicle check with a data guarantee of up to £30,000 using the link above. <a href="#"> Terms and conditions apply</a>.</p>
                    <p> <strong> Please note: </strong>  The seller may have conducted their own checks. Results of your personal check will not appear on our website.</p>
                </div>
            </div>

        </div>
    </div>
</section>-->
<!--auto trader-->


<!--about this seller -->
<section id="about-seller">
    <div class="container">
        <div class="about-seller">
            <h2> About this seller </h2>
            <h5> {{@$truckDetails->name}}</h5>

            <p>
                Have been in the truck business for over 30 years and offers the widest range of used tractor units, rigid HGVs, trailers, plant equipment and vans, as well as a full export service from its three locations in the United Kingdom and Republic of Ireland. This family-run business can be found just off the M62 at Risley, near Warrington; south-west of Keady in County Armagh, Northern Ireland and in Castleshane, County Monaghan in the Republic of Ireland.
            </p>

            <div id="accordion" class="myaccordion">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                            <button class="d-flex align-items-center justify-content-between btn btn-link collapsed" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                <span class="fa-stack fa-sm">
                                    <i class="fa fa-plus fa-inverse" aria-hidden="true"></i>
                                    Services offered
                                </span>


                            </button>
                        </h2>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <p> Have been in the truck business for over 30 years and offers the widest range of used tractor units, rigid HGVs, trailers, plant equipment and vans, as well as a full export service from its three locations in the United Kingdom and Republic of Ireland. This family-run business can be found just off the M62 at Risley, near Warrington; south-west of Keady in County Armagh, Northern Ireland and in Castleshane, County Monaghan in the Republic of Ireland.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- dealer images-->
<section id="dearler-group">
    <div class="container-fluid"> 
        <h2> More from this dealer </h2>

        <div class="dealer-row">
            @if(!empty($truckList))
            @foreach($truckList as $trucks)
            <div class="col-1-5">
                <div class="img-sec">
                    <img src="{{$trucks->truck_name?asset('storage/uploads/truck').'/'.$trucks->truck_logo:asset('assets/sites/images/list-img-box.jpg')}}" alt="t1">
                </div>
                <div class="img-sed-desp">
                    <h5> {{$trucks->truck_name}} </h5>
                    <h6>  DAF CF  </h6>
                    <p>  {{$trucks->year}} (65 Reg) | Sleeper cab  </p>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>
<!-- dealer images ends-->

<!--safty rules-->
<section id="safty-rules">
    <div class="container">
        <div class="safty">
            <h2> Safety and security </h2>
            <h5> <a href="#"> Read more </a> </h5>

            <p>
                We're dedicated to providing you with the tools you need for a hassle-free experience. From vehicle history checks and scams to be aware of, to our top tips to stay safe online. Use our guides to buy and sell a vehicle with confidence. 
            </p>

            <div class="price-dis">
                <h4> Price disclaimer </h4>
                <p> 
                    The vehicle prices displayed in Euro and Sterling are estimates based on conversion rates supplied by ECB. Please check the price with the seller before proceeding with a transaction.
                </p>
            </div>

            <div class="price-dis">
                <h4> Please note </h4>
                <p> 
                    The data displayed above details the usual specification of the most recent model of this vehicle. It is not the exact data for the actual vehicle being offered for sale and data for older models may vary slightly. We recommend that you always check the details with the seller prior to purchase.
                </p>
            </div>

            <div class="price-dis">
                <h4> Insurance categories and 5 basic Vehicle Checks </h4>
                <p> 
                    The 5 basic checks were provided by Experian when the advert was placed using the details provided.  We use the details sourced from Motor Insurance Anti-Fraud and Theft Register (MIAFTR), operated by Insurance Database Services Ltd, to check whether the vehicle is recorded as having been written off. The write off category indicators are provided for your assistance, but the presence or absence of an indicator in an advert should not be relied upon by you to indicate the status of a vehicle. Data can change, so you are strongly advised to obtain a full vehicle history check before making an offer on a vehicle. This Basic Check is provided by Auto Trader (using data provided by Experian) for information only and to the extent permitted by law, neither Auto Trader nor Experian will be liable for any inaccuracies or for any loss you suffer if you rely on it as detailed in our <a href="#"> Terms of Use </a>.
                </p>
            </div>


        </div>
    </div>
</section>
<!--safty rules ends-->

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js'></script>
<script  src="{{ asset('assets/sites/js/product_script.js') }}"></script> 

@endsection
