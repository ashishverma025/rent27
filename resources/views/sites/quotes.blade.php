@extends('sites.layout.Sites')
@section('content')
<!--Business covered sec-->

@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session()->get('message') }}
    </div>
@endif <!-- end .flash-message -->
<section id="business-sec">
    <div class="container">
	@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <form action="{{url('quotes')}}" method="post">
            @csrf
            <section id="banner-sec" >
                <div class="container-fluid">
                   
                    <div class="overlay-main all-head">
                        <h2>
                            <span></span>FIND BEST RENTAL TRUCK</span>
                        </h2>
                        <div class="banner-overlay">
                            <p class="search-para"> Search for Cheap Rental Trucks Wherever Your Are </p>
                            <div class="over-form"> 
                                <!-- Include Bootstrap Datepicker -->
                                <div class="row dates">
                                    <div class="col-lg-4"><label>Name</label><input type="text" value="{{@$userDetails->name?@$userDetails->name:@$queryString['name']}}"  placeholder="Name" id="name" name="name" autocomplete="off"></div>
                                    <div class="col-lg-4 start_date"><label>Email</label><input type="email" value="{{@$userDetails->email?@$userDetails->email:@$queryString['email']}}" name="email" id="email"  placeholder="Email" autocomplete="off"></div>
                                    <div class="col-lg-4"><label>Mobile</label><input type="number" value="{{@$userDetails->mobile_no?@$userDetails->mobile_no:@$queryString['mobile_no']}}" placeholder="Mobile" name="mobile_no" id="mobile_no" autocomplete="off"> </div>
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
                                    <!--<div class="col-lg-3 date" id="pickoff_hour"><label>Picking Off Hour</label><input type="time" name="pickoff_hour" placeholder="" ></div>-->
                                </div>
                            </div>
                            <div class="all-btns-main">
							 <button type="submit" class="btn btn-primary"id="getQuote" class="smalCopybtn" style="margin-top:2px;">Get Quotes</button>
                         
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>

    </div>
</section>
<!--Business covered sec ends-->
@endsection
