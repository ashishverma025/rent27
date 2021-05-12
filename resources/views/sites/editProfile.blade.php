@extends('sites.layout.Sites')
@section('content')

<section id="banner-sec" >
    <div class="container-fluid">
        <img src="{{asset('assets/sites/images/slider-01.jpg')}}" alt="slider">
        <div class="overlay-main">
            <h1>EDIT PROFILE</h1>
            <form action="{{url('editProfile')}}/{{$userDetails->id}}" method="post">
                @csrf
                <div class="banner-overlay">
                    <!--<p> Search for Cheap Rental Trucks Wherever Your Are </p>-->

                    <div class="over-form"> 
                        <!-- Include Bootstrap Datepicker -->

                        <div class="row dates">
                            <div class="col-lg-4"><label>Name</label><input type="text" value="{{$userDetails->name}}" name="name" placeholder="Name"> </div>
                            <div class="col-lg-5 start_date"><label>Email</label><input disabled="" type="text"  value="{{$userDetails->email}}" name="email" id="email"  placeholder="Email"> </div>
                            <div class="col-lg-3"><label>Mobile</label><input type="text"  value="{{$userDetails->mobile_no}}" placeholder="Mobile" name="mobile_no" id="mobile_no"> </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3"><label>Gender</label>
                                <select name="gender" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option value="Male" {{$userDetails->gender=='Male'?'selected':''}}>Male</option>
                                    <option value="Female" {{$userDetails->gender=='Female'?'selected':''}}>Female</option>
                                </select>
                            </div>
                            <div class="col-lg-3 end_date"><label>DOB</label><input type="text"  value="{{$userDetails->dob}}" class="end_date" name="dob" id="startdate_datepicker"   placeholder="DOB" autocomplete="off"> <i class="fa fa-calendar" aria-hidden="true"></i></div>
                            <div class="col-lg-6" id="pickoff_hour"><label>Address</label><input type="text"  value="{{$userDetails->address}}" name="address" placeholder="Address" ></div>
                        </div>

                    </div>
                    <p><button type="submit">Update</button></p>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection
