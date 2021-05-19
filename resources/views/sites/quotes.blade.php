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
        <!-- @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif -->
        <form action="{{url('quotes')}}" method="post" enctype="multipart/form-data">
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
                                    <div class="col-lg-4">
                                        <label>Name</label>
                                        <input type="text" value=""  placeholder="Name" id="name" name="name" autocomplete="off">
                                        @if ($errors->has('name'))
                                                <span class="invalid feedback errMsg"role="alert">
                                                    <strong>{{ $errors->first('name') }}.</strong>
                                                </span>
                                        @endif
                                    </div>
                                    <div class="col-lg-4 start_date">
                                        <label>Email</label>
                                        <input type="email" value="" name="email" id="email"  placeholder="Email" autocomplete="off">
                                        @if ($errors->has('email'))
                                            <span class="invalid feedback errMsg"role="alert">
                                                <strong>{{ $errors->first('email') }}.</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Mobile</label>
                                        <input type="number" value="" placeholder="Mobile" name="mobile_no" id="mobile_no" autocomplete="off">
                                        @if ($errors->has('mobile_no'))
                                            <span class="invalid feedback errMsg"role="alert">
                                                <strong>{{ $errors->first('mobile_no') }}.</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Message</label>
                                        <textarea  placeholder="Enter Message" id="message" class="quoteMessage" name="message" style="width:100%" rows="6" autocomplete="off">{{@$queryString['message']}}</textarea>
                                        @if ($errors->has('message'))
                                            <span class="invalid feedback errMsg"role="alert">
                                                <strong>{{ $errors->first('message') }}.</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row dates">
                                    <div class="col-lg-6">
                                        <label> </label>
                                        <input type="text" value="" id="pickup_location" name="pickup_location" placeholder="Pickingup Location"> <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        @if ($errors->has('pickup_location'))
                                            <span class="invalid feedback errMsg"role="alert">
                                                <strong>{{ $errors->first('pickup_location') }}.</strong>
                                            </span>
                                        @endif    
                                    </div>
                                    <div class="col-lg-6 start_date">
                                        <label> </label>
                                        <input type="text" value="" class="start_date" name="pickup_date" id="startdate_datepicker"  placeholder="Picking Up Date" autocomplete="off"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                         @if ($errors->has('pickup_date'))
                                            <span class="invalid feedback errMsg"role="alert">
                                                <strong>{{ $errors->first('pickup_date') }}.</strong>
                                            </span>
                                        @endif 
                                    </div>
                                    <!--<div class="col-lg-3"><label>Picking Up Hour</label><input type="time" placeholder="" name="pickup_hour" id="pickup_hour"> </div>-->
                                </div>
                                <div class="row">
                                    <div class="col-lg-6"><label> </label>
                                        <input type="text" value="" id="dropping_location" name="dropping_location" placeholder="Dropping Location"> <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        @if ($errors->has('dropping_location'))
                                            <span class="invalid feedback errMsg"role="alert">
                                                <strong>{{ $errors->first('dropping_location') }}.</strong>
                                            </span>
                                        @endif 
                                    </div>
                                    <div class="col-lg-6 end_date"><label> </label>
                                        <input type="text" value="" class="end_date" name="drop_date" id="enddate_datepicker"   placeholder="Dropping Off  Date" autocomplete="off"> <i class="fa fa-calendar" aria-hidden="true"></i>
                                        @if ($errors->has('drop_date'))
                                            <span class="invalid feedback errMsg"role="alert">
                                                <strong>{{ $errors->first('drop_date') }}.</strong>
                                            </span>
                                        @endif 
                                    </div>
                                    <!--<div class="col-lg-3 date" id="pickoff_hour"><label>Picking Off Hour</label><input type="time" name="pickoff_hour" placeholder="" ></div>-->
                                </div>

                                <div class="row">
                                    <div class="col-lg-6"><label> </label><input type="file" name="quote_image" value="" placeholder="Quotes Image"  ></div>
                                    <div class="col-lg-6">
                                        @if ($errors->has('quote_image'))
                                            <span class="invalid feedback errMsg"role="alert">
                                                <strong>{{ $errors->first('quote_image') }}.</strong>
                                            </span>
                                        @endif 
                                    </div>
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
<script>
$(document).ready(function() {

    $('.quoteMessage').keyup(function(event) {
        var maxlength = 750;
        var message = $(this).val();
        var textlen = $(this).val().length;
        if(textlen > 750){
            $('.quoteMessage').val((message).substring(0, maxlength - 1));
            event.preventDefault();
            console.log(textlen-1)
            return false;
        }
    });
});
</script>
<!--Business covered sec ends-->
@endsection
