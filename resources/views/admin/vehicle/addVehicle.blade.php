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
                    <h3 class="card-title">{{'Add '}} Vehicle </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{url('admin/addVehicle')}}{{@$button=='Update'?'/':''}}{{@$VehicleDetails->id}}" id="t_profile" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_name">Company Name:</label>
                                    <select name="company_id" id="company_id" class="form-control">
                                        <option value="">Select Company</option>
                                        @foreach( $companies as $company )
                                        <option value="{{ $company->id }}" {{ $company->id == @$VehicleDetails->company_id ? 'selected':''}} >{{ strtolower( $company->company_name ) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vehicle_category">Vehicle Category:</label>
                                    <select name="vehicle_category" id="vehicle_type_id" class="form-control">
                                        <option value="">Select Vehicle Category</option>
                                        @foreach( $vehicleTypes as $vehicleType )
                                        <option value="{{ $vehicleType->id }}" {{ $vehicleType->id == @$VehicleDetails->vehicle_type_id ? 'selected':''}} >{{ strtolower( $vehicleType->vehicle_type ) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Vehicle Name</label>
                                    <input type="text" class="form-control" id="vehicle_name" value="{{@$VehicleDetails->vehicle_name}}" name="vehicle_name">
                                    @if ($errors->has('vehicle_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('vehicle_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <img src="{{ asset('storage/uploads/vehicle') }}/<?= !empty(@$VehicleDetails->vehicle_image) ? @$VehicleDetails->vehicle_image : 'default_profile_user_img.png' ?>" id="userImg" height="80" width="80">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mgt30">
                                    <!-- bnew -->
                                    <div class="file btn btn-primary">
                                        Upload
                                        <input type="file" class="custom-file-input hide-this" name="vehicle_image" id="vehicle_image" onchange= "readURL(this, 'userImg')" >
                                    </div>
                                    <!-- bnew -->
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">  <label>&nbsp;</label>
                                    <div class="row"><div class="col-md-4">
                                            <button type="submit" id="edit_profile" name="savebtn" value="{{@$button}}" class="btn btn-primary">Save</button></div></div>
                                </div>
                            </div>
                        </div>

                    </form>
                    <!-- /.col -->
                </div>

            </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('public/sites/users/js/common.js') }}"></script>
<script>
                                                    function readURL(input, divID) {
                                                        if (input.files && input.files[0]) {
                                                            var reader = new FileReader();
                                                            $('#' + divID).show()
                                                            reader.onload = function (e) {
                                                                $('#' + divID).attr('src', e.target.result);
                                                            }
                                                            reader.readAsDataURL(input.files[0]);
                                                        }
                                                    }
</script>
@include('admin/includes.admin-footer')
