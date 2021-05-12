@include('admin/includes.admin-head')
@include('admin/includes.admin-sidebar')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    @if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class') }}">{{ Session::get('message') }}</p>
    @endif
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid add-student">
            <!-- SELECT2 EXAMPLE -->
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">{{'Add '}} Dealer </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{url('admin/addDealer')}}{{@$button=='Update'?'/':''}}{{@$dealerDetails->id}}"  enctype="multipart/form-data" method="post" accept-charset="utf-8" >
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="person_name">Person Name: <span class="error">*</span></label>
                                    <input type="text" class="form-control" value="{{@$dealerDetails->dealer_name}}" name="person_name" id="person_name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_name">Company Name:</label>
                                    <input type="text" class="form-control" value="{{@$dealerDetails->company_name}}" name="company_name" id="company_name">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="mobile_no">Mobile No: <span class="error">*</span></label>
                                    <input type="text" class="form-control" value="{{@$dealerDetails->contact_no}}" name="mobile_no" id="mobile_no">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email_id">Email Id: <span class="error">*</span></label>
                                    <input type="email" class="form-control" value="{{@$dealerDetails->email}}"  id="email_id" name="email_id">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            @if(@$button == 'Add')
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Password: <span class="error">*</span></label>
                                    <input type="password" class="form-control"  id="password" name="password">
                                </div>
                            </div>
                            @endif
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div class="row">
                                        <div class="col-md-4 align-center">
                                            <button type="submit" name="savebtn" value="{{@$button}}" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- /.col -->
                </div>
            </div>
            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('public/sites/users/js/common.js') }}"></script>

@include('admin/includes.admin-footer')
