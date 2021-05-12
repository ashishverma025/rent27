@extends('sites.layout.Sites')
@section('content')
@php
$type_of_truck = @$queryString['type_of_truck'];
@endphp
<div style="clear:both"></div>
<!--truck-detail covered sec-->
<section id="truck-detail">
    <div class="container all-head">
      <span> <h1> Rent A Truck</h1></span>
    </div>

</section>
{{-- <section id="calgry-sec">

    <div class="container">
        </div>
  </section>       --}}



<section id="calgry-sec">

    <div class="container">

        <div class="calgry-sec">
            <h3> We provide the best trucks in the world</h3>
            <div class="custom-select">
                <select>
                    <option value="0">Most Recent Ads</option>
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
                    <div class="exp-btn"><button >RENT NOW</button></div>
                </div>
            </div>
        </div>
        @endforeach
        @endif
    </div>

</section>

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

@endsection
<script>
    $(document).ready(function () {
    // Handler for .ready() called.
    $('html, body').animate({
        scrollTop: $('#searchh').offset().top
    }, 'slow');
});
</script>
