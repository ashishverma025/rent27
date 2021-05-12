@extends('sites.layout.Sites')
@section('content')


<div style="clear:both"></div>
<!--truck-detail covered sec-->
<section id="truck-detail">
    <div class="container">
        <div class="truck-detail-inner">
            <div class="results-found">
                <h3> 4,699 results found </h3>
                <h5> <a href="#"> Reset search  <span><i class="fa fa-refresh" aria-hidden="true"></i></span></a> </h5>
            </div>

            <div class="serch-row">
                <div class="row">

                    <div class="col-md-3">
                        <input type="text" name="">
                    </div>

                    <div class="col-md-3">
                        <div class="custom-select">
                            <select>
                                <option value="0">Select car:</option>
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

                    <div class="col-md-3">
                        <button><img src="{{asset('assets/sites/images/tick-mark.png')}}" alt="tick"> I'm outside of the UK</button>
                    </div>

                </div>
            </div>


            <div class="serch-boxes">
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
                                        <div class="col-md-12"><label> From </label>  <select><option>(any)</option><option>New(197)</option></select></div>
                                        <div class="col-md-12"><label> To </label>    <select><option>(any)</option><option>New(197)</option></select></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="any-box">Engine Power  <span>Any <i class="fa fa-angle-double-right" aria-hidden="true"></i></span></div>
                    </div>

                </div>


                <div class="row">

                    <div class="col-md-4">
                        <div class="any-box">Modal <input type="text" name=""> <span>Any <i class="fa fa-angle-double-right" aria-hidden="true"></i></span></div>
                    </div>

                    <div class="col-md-4">
                        <div class="any-box">
                            <h3> Price </h3>
                            <div class="dropdown year-drop">
                                <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown">Any</button>
                                <div class="dropdown-menu dropdown-menu-tip-nw">
                                    <div class="row">
                                        <div class="col-md-12"><label> From </label>  <select><option>(any)</option><option>New(197)</option></select></div>
                                        <div class="col-md-12"><label> To </label>    <select><option>(any)</option><option>New(197)</option></select></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="any-box">Emission Class  <span>Any <i class="fa fa-angle-double-right" aria-hidden="true"></i></span></div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4">
                        <div class="any-box">Body Type  <span>Any <i class="fa fa-angle-double-right" aria-hidden="true"></i></span></div>
                    </div>

                    <div class="col-md-4">
                        <div class="any-box">GVW <span>Any <i class="fa fa-angle-double-right" aria-hidden="true"></i></span></div>
                    </div>

                    <div class="col-md-4">
                        <div class="any-box">Driver Position  <span>Any <i class="fa fa-angle-double-right" aria-hidden="true"></i></span></div>
                    </div>

                </div>


                <div class="row">

                    <div class="col-md-4">
                        <div class="any-box">Category  <span>Any <i class="fa fa-angle-double-right" aria-hidden="true"></i></span></div>
                    </div>

                    <div class="col-md-4">
                        <div class="any-box">Cab Type <span>Any <i class="fa fa-angle-double-right" aria-hidden="true"></i></span></div>
                    </div>

                    <div class="col-md-4">
                        <div class="any-box">Keywords <input type="text" name=""> </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4">
                        <div class="any-box">Subcategory  <span>Any <i class="fa fa-angle-double-right" aria-hidden="true"></i></span></div>
                    </div>
                    <div class="col-md-4">
                        <div class="any-box">
                            <h3> GTW </h3>
                            <div class="dropdown year-drop">
                                <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown">Any</button>
                                <div class="dropdown-menu dropdown-menu-tip-nw">
                                    <div class="row">
                                        <div class="col-md-12"><label> From </label>  <select><option>(any)</option><option>New(197)</option></select></div>
                                        <div class="col-md-12"><label> To </label>    <select><option>(any)</option><option>New(197)</option></select></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>

                <div class="row">

                    <div class="col-md-4">
                        <div class="any-box">Axle Config  <span>Any <i class="fa fa-angle-double-right" aria-hidden="true"></i></span></div>
                    </div>


                    <div class="col-md-4">
                        <div class="any-box">
                            <h3> Mileage </h3>
                            <div class="dropdown year-drop">
                                <button type="button" class="btn  dropdown-toggle" data-toggle="dropdown">Any</button>
                                <div class="dropdown-menu dropdown-menu-tip-nw">
                                    <div class="row">
                                        <div class="col-md-12"><label> From </label>  <select><option>(any)</option><option>New(197)</option></select></div>
                                        <div class="col-md-12"><label> To </label>    <select><option>(any)</option><option>New(197)</option></select></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>




            </div>
        </div>
    </div>


    <!--all popup-->
    <div class="modal fade custom-modal" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" id="exampleModalLabel">Select Make</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">Close</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="custom-filtermb-3">
                                    <input type="text" name="" placeholder="type to filter">
                                </div>
                            </div>
                        </div>

                        <div class="filter-results">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                                        <label class="custom-control-label" for="customCheck">2014 18 BAY FULTON THERMAL HEATER SYSTEM(1)</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheck2" name="example2">
                                        <label class="custom-control-label" for="customCheck2">2014 18 BAY FULTON THERMAL HEATER SYSTEM(1)</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheck3" name="example3">
                                        <label class="custom-control-label" for="customCheck3">2014 18 BAY FULTON THERMAL HEATER SYSTEM(1)</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheck4" name="example4">
                                        <label class="custom-control-label" for="customCheck4">2014 18 BAY FULTON THERMAL HEATER SYSTEM(1)</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheck5" name="example5">
                                        <label class="custom-control-label" for="customCheck5">2014 18 BAY FULTON THERMAL HEATER SYSTEM(1)</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheck6" name="example6">
                                        <label class="custom-control-label" for="customCheck6">2014 18 BAY FULTON THERMAL HEATER SYSTEM(1)</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheck7" name="example7">
                                        <label class="custom-control-label" for="customCheck7">2014 18 BAY FULTON THERMAL HEATER SYSTEM(1)</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheck8" name="example8">
                                        <label class="custom-control-label" for="customCheck8">2014 18 BAY FULTON THERMAL HEATER SYSTEM(1)</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheck9" name="example9">
                                        <label class="custom-control-label" for="customCheck9">2014 18 BAY FULTON THERMAL HEATER SYSTEM(1)</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheck10" name="example10">
                                        <label class="custom-control-label" for="customCheck10">2014 18 BAY FULTON THERMAL HEATER SYSTEM(1)</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheck11" name="example11">
                                        <label class="custom-control-label" for="customCheck11">2014 18 BAY FULTON THERMAL HEATER SYSTEM(1)</label>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox mb-3">
                                        <input type="checkbox" class="custom-control-input" id="customCheck12" name="example12">
                                        <label class="custom-control-label" for="customCheck12">2014 18 BAY FULTON THERMAL HEATER SYSTEM(1)</label>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="modal-footer border-top-0 d-flex justify-content-right">
                        <button type="submit" class="btn btn-cl">Clear All</button>
                        <button type="submit" class="btn btn-ok">OK</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--all popup end-->

</section>
<!--truck-detail covered sec ends-->

<!--Calgry sec-->
<section id="calgry-sec">

    <div class="container">

        <div class="calgry-sec">
            <h3> We provide best truck in Calgry </h3>
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
                        <h6> {{$trucks->year}}  | {{$trucks->weight}}  kg </h6>
                        <p> {!! html_entity_decode($trucks->description) !!}</p>

                        <div class="trade"><p>Trade seller - <span> View all from seller </span> </p> </div>

                        <div class="img-cout"> <img src="{{asset('assets/sites/images/img-cam.png')}}" alt="img-cam"> <span>25</span></div>

                        <div class="report"><p><a href="#"> Report this advert</a> | <a href="#"> Save Advert </a> </p> </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="exp-btn"><button>EXPLORE MORE</button></div>
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

        <div class="cal-list">
            <div class="row">
                <div class="col-md-3">
                    <div class="cal-img-box"><img src="{{asset('assets/sites/images/list-img-box5.jpg')}}" alt="img-box"> </div>
                </div>
                <div class="col-md-6">
                    <div class="cal-img-detail">
                        <h4> DAF XF 460 FTG SuperSpace 6x2 Tractor Unit </h4>
                        <h6> 2016 | 44000 kg </h6>
                        <p> Climate control,electric windows/mirrors,cruise control,MX Engine brake,Sat nav/Radio/Cd player,fridge,2nd bunk,combi lights,lane departure warning,advanced emergency braking system,electric sunroof,Skylights,sun ...</p>

                        <div class="trade"><p>Trade seller - <span> View all from seller </span> </p> </div>

                        <div class="img-cout"> <img src="{{asset('assets/sites/images/img-cam.png')}}" alt="img-cam"> <span>25</span></div>

                        <div class="report"><p><a href="#"> Report this advert</a> | <a href="#"> Save Advert </a> </p> </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="exp-btn"><button>EXPLORE MORE</button></div>
                </div>
            </div>
        </div>

        <div class="cal-list">
            <div class="row">
                <div class="col-md-3">
                    <div class="cal-img-box"><img src="{{asset('assets/sites/images/list-img-box6.jpg')}}" alt="img-box"> </div>
                </div>
                <div class="col-md-6">
                    <div class="cal-img-detail">
                        <h4> DAF XF 460 FTG SuperSpace 6x2 Tractor Unit </h4>
                        <h6> 2016 | 44000 kg </h6>
                        <p> Climate control,electric windows/mirrors,cruise control,MX Engine brake,Sat nav/Radio/Cd player,fridge,2nd bunk,combi lights,lane departure warning,advanced emergency braking system,electric sunroof,Skylights,sun ...</p>

                        <div class="trade"><p>Trade seller - <span> View all from seller </span> </p> </div>

                        <div class="img-cout"> <img src="{{asset('assets/sites/images/img-cam.png')}}" alt="img-cam"> <span>25</span></div>

                        <div class="report"><p><a href="#"> Report this advert</a> | <a href="#"> Save Advert </a> </p> </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="exp-btn"><button>EXPLORE MORE</button></div>
                </div>
            </div>
        </div>

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
