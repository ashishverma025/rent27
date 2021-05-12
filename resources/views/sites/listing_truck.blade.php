@extends('sites.layout.Sites-filter')
@section('content')
@php
$type_of_truck = @$queryString['type_of_truck'];
@endphp
<div style="clear:both"></div>

<!--Calgry sec-->
<section id="truck-detail">
    <div class="container">
        <div class="calgry-sec">
            <div class="row">
                <div class="col-md-12">
                <h3> We provide the best trucks in the World </h3>
            <form action="{{url('listing/truck')}}" method="get" >
                <div class="serch-row">
                    <div class="row">
                        <div class="col-md-3">
                            <input type="text" name="from" id="from_location" value="{{@$queryString['from']}}" placeholder="From">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="to" id="to_location" value="{{@$queryString['to']}}" placeholder="To">
                        </div>
                        <!--<div class="col-md-3">
                            <input type="text" name="leaving" value="{{@$queryString['leaving']}}" placeholder="Leaving">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="to_comming" value="{{@$queryString['to_comming']}}" placeholder="To Commong">
                        </div>-->
                    </div>
                </div>
                <div class="serch-row" style="margin-top: 15px">
                    <div class="row">
                        <!-- <div class="col-md-3">
                            <div class="custom-select">
                                <select name="size">
                                    <option value="">Select truck Size:</option>
                                    @if(!empty($truckSizeList))
                                    @foreach($truckSizeList as $size)
                                    <option value="{{$size->size}}" {{(@$queryString['size'] == $size->size )?'selected':''}}>{{$size->size}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div> -->
                        <div class="col-md-3">
                            <div class="custom-select">
                                <select name="type_of_truck">
                                    <option value="">Select truck Type:</option>
                                    @if(!empty($vehicleType))
                                    @foreach($vehicleType as $type)
                                    <option value="{{$type->id}}" {{($type_of_truck == $type->id )?'selected':''}}>{{$type->vehicle_type}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                            <div class="col-md-3">
                            <div class="custom-select">
                                <select name="buy rent">
                                    <option value="">Select truck Services</option>
                                   <option value="">Buy</option>
                                   <option value="">Rent</option>
                                   <!-- <option value="">Sale:</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit"><img src="{{asset('assets/sites/images/tick-mark.png')}}" alt="tick"> Filter Truck</button>
                        </div>
                    </div>
                </div>
            </form>
                    <div class="serch-boxes" style="display: none">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="any-box" data-toggle="modal" data-target="#form">Make <span>Any <i class="fa fa-angle-double-right" aria-hidden="true"></i></span></div>
                            </div>
                            <div class="col-md-4">
                                <div class="any-box">
                                    <h3> Year </h3>
                                    <div class="dropdown year-drop">
                                        <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown">Any</button>
                                        <div class="dropdown-menu dropdown-menu-tip-nw">
                                            <div class="row">
                                                <div class="col-md-12"><label> From </label></div>
                                                <div class="col-md-12"><label> To </label></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="any-box">Engine Power  <span>Any <i class="fa fa-angle-double-right" aria-hidden="true"></i></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                            <div class="custom-select">
                            <select>
                                <option value="0">Model</option>
                                <option value="1">Audi</option>
                                <option value="2">BMW</option>
                                <option value="3">Citroen</option>
                                <option value="4">Ford</option>
                                <option value="5">Honda</option>
                                <option value="6">Jaguar</option>
                                <option value="7">Land Rover</option>
                                <option value="8">Mercedes</option>
                                <option value="9">Mini</option>
                                <option value="10">Nissan</option>
                                <option value="11">Toyota</option>
                                <option value="12">Volvo</option>
                            </select>
                        </div>
                </div>
                 <div class="truck-detail-inner">
                    <div class="results-found" id="searchh">
                        <h3> {{count($truckList)}} results found </h3>
                        <h5> <a href="{{url('listing/truck')}}"> Reset search  <span><i class="fa fa-refresh" aria-hidden="true"></i></span></a> </h5>
                    </div>
                    
                </div>
            </div>
        </div>
        
        @if(!empty($truckList))
        @foreach($truckList as $trucks)
        <div class="cal-list">
            <div class="row">
                <div class="col-md-3">
                    <div class="cal-img-box"><img src="{{$trucks->truck_name?asset('storage/uploads/truck').'/'.$trucks->truck_logo:asset('assets/sites/images/list-img-box.jpg')}}" alt="img-box"> </div>
                </div>
                <div class="col-md-6">
                    <div class="cal-img-detail">
                        <h4> {{$trucks->truck_name}} </h4>
                        <h6> {{$trucks->year}}  | {{$trucks->weight}}  kg | {{$trucks->source_address}} To {{$trucks->destination_address}}</h6>
                        <h6> {{$trucks->size}}</h6>
                        <p> {!! html_entity_decode($trucks->description) !!}</p>

                        <div class="trade"><p>Trade seller - <span> View all from seller </span> </p> </div>

                        <div class="img-cout"> <img src="{{asset('assets/sites/images/img-cam.png')}}" alt="img-cam"> <span>25</span></div>

                        <div class="report"><p><a href="#"> Report this advert</a> | <a href="#"> Save Advert </a> </p> </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="exp-btn"><button onclick="location.href='{{url('detail/truck') .'/'.$trucks->id}}'">EXPLORE MORE</button></div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>

</section>
<!--Calgry secsec ends-->

<!--image sec-->
<section id="image-sec">
    <div class="container">
        <div class="image-sec">
            <div class="row">

                <div class="col-md-4">
                    <div class="img-box"> <img src="{{asset('assets/sites/images/img-gal-1.jpg')}}" alt="img1"> </div>
                    <div class="img-box-det">
                        <ul>
                            <li><a href="#"> POA </a></li>
                            <li><a href="#"> DAF CF</a></li>
                            <li><a href="#"> 2016</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="img-box"> <img src="{{asset('assets/sites/images/img-gal-2.jpg')}}" alt="img2"> </div>
                    <div class="img-box-det">
                        <ul>
                            <li><a href="#"> POA </a></li>
                            <li><a href="#"> DAF CF</a></li>
                            <li><a href="#"> 2016</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="img-box"> <img src="{{asset('assets/sites/images/img-gal-3.jpg')}}" alt="img3"> </div>
                    <div class="img-box-det">
                        <ul>
                            <li><a href="#"> POA </a></li>
                            <li><a href="#"> DAF CF</a></li>
                            <li><a href="#"> 2016</a></li>
                        </ul>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>
<!--image sec end-->


<section id="calgry-sec" class="cal-sec2">
    <div class="container">
        <div class="page-no">
            <ul class="pagination">
                <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link " href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item disabled"><a class="page-link" href="#">Next</a></li>
            </ul>
        </div>

    </div>
</section>
<style>
.calgry-sec .col-md-3 .custom-select {width: 100%;max-width: 100%;}
.calgry-sec {background: #fff;padding: 20px 25px;}
.calgry-sec .truck-detail-inner { width: 100%;text-align: center;}
.calgry-sec .truck-detail-inner{box-shadow:none;}
.calgry-sec .serch-row input[type="text"] {padding-left: 16px;font-size: 14px;}
.truck-detail-inner h3, .truck-detail-inner h5 {display: inline-block;margin: 0 10px;}
.image-sec {margin-top: 70px;}
.over-form textarea {background: #4b4d51;border: 0;color: #fff;padding: 10px;margin-bottom: 5px;}
.calgry-sec h3{font-size:25px;}
</style>

@endsection
<script>
    $(document).ready(function () {
    // Handler for .ready() called.
    $('html, body').animate({
        scrollTop: $('#searchh').offset().top
    }, 'slow');
});
</script>