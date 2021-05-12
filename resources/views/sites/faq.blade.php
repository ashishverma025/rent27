@extends('sites.layout.Sites')
@section('content')
<div style="clear:both"></div>
<section class="addReview pb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="h-100 bg-light btnaligncenter">
                    <div class="p-4">

                        <h1>Q: <span style="color:#000fff">{{@$faqDetails->question}}</span></h1>
                        <hr>
                        <b>Ans: {{@$faqDetails->answer}}</b>
                        <!--<a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#forAddComplaint">Add Complaint</a>-->
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection
