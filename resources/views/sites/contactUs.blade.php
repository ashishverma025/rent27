@extends('sites.layout.Sites')
@section('content')
<!--Business covered sec-->
@if (\Session::has('success'))
    <div class="alert alert-success">
        <ul>
            <li>{!! \Session::get('success') !!}</li>
        </ul>
    </div>
@endif

<section id="business-sec">
    <div class="container">
        <div class="all-head">
            <h2> Thousands of trucks  <span> at your fingertips. </span> </h2>
        </div>
        <div class="business-inner">
            <div class="row">
                <div class="col-md-12">
                    <div class="pt-5 pl-5 pr-5 text-center">
                        <p><b>Company name:</b> EMPTYTRUCK100 Ltd</p>
<!-- <p> <b>Phone:</b> +44 771 638 1938</p> -->
   <p>           <b>Email:</b> admin@emptytruck100.com</p>
      <p>        <b>Address:</b> 107 Lawrence Road, Liverpool, L15 OEF,UK </p>
<p>              <b>Inquiry email:</b> inquiry@emptytruck.com</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="contact-form p-5">
                    <div class="leave-comment">
                        <h4 class="text-center">Leave A Comment</h4>
                        <p class="text-center pb-4">Our staff will get back to you</p>
                    
						
						<form action="{{url('create')}}" method="post">
            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                	<label class="d-block mt-3">Your name</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                                <div class="col-lg-6">
                                	<label class="d-block mt-3">Your email</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                                <div class="col-lg-12">
                                	<label class="d-block mt-3">Subject relate with?</label>
                                    <input type="text" class="form-control" name="sub" required>
                                </div>
                                <div class="col-lg-12">
                                	<label class="d-block mt-3">Your message</label>
                                    <textarea class="form-control" rows="5" name="message" required></textarea>
                                    <button type="submit" class="btn btn-primary mt-4">Send message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Business covered sec ends-->
@endsection
