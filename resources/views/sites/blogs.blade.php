@extends('sites.layout.Sites')
@section('content')
<div style="clear:both"></div>

<section class="addReview pb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="h-100 bg-light btnaligncenter">
                    <div class="p-4">
                        <div class="avatar-pic">
                            <img src="{{asset('storage/uploads/blog/').'/'.@$blogDetails->blog_image}}" alt="">
                        </div>
                        {{@$blogDetails->title}}
                        {!! html_entity_decode(@$blogDetails->description) !!}
                        <!--<a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#forAddComplaint">Add Complaint</a>-->
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="all-head">
                    <h2>{{@$blogDetails->title}} <span> Blog </span> </h2>
                </div>
                <div class="customer-review-option">
                    @if(!empty($allBlogs))
                    <p class="pb-3"><b>{{count($allBlogs)}} Blogs</b></p>
                    @foreach($allBlogs as $blog)
                    <div class="comment-option">
                        <div class="co-item">
                            <div class="avatar-pic">
                                <img src="{{asset('storage/uploads/blog/').'/'.$blog->blog_image}}" alt="">
                            </div>
                            <div class="avatar-text">
                                <h5>{{$blog->title}} </h5>
                                <p class="at-reply"> {!! html_entity_decode($blog->description) !!}</p>
                                <h3>{{$blog->created_at}}</h3>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>



@endsection
