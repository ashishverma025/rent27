@include('dashboard/includes.admin-head')
@include('dashboard/includes.admin-sidebar')

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
                    <h3 class="card-title">{{'Add '}} Truck </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form action="{{url('addTruck')}}{{@$TruckDetails->id?'/'.@$TruckDetails->id:''}}" id="t_profile" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <img src="<?= !empty(@$TruckDetails->truck_logo) ? asset('storage/uploads/truck') . '/' . @$TruckDetails->truck_logo : asset('storage/images') . '/not-available.jpg' ?>" id="userImg" height="80" width="80">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group mgt30">
                                            <!-- bnew -->
                                            <div class="file btn btn-primary">
                                                Upload
                                                <input type="file" class="custom-file-input hide-this" name="truck_logo" id="truck_logo" onchange= "readURL(this, 'userImg')" >
                                            </div>
                                            <!-- bnew -->
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label> Truck Name</label>
                                    <input type="text" id="fname" name="truck_name" class="form-control" placeholder="Truck Name" value="<?= @$TruckDetails->truck_name ?>" required>
                                    @if ($errors->has('truck_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('truck_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label> Description</label>
                                    <textarea  id="editor1" name="description" class="form-control textarea" placeholder="Description" required><?= @$TruckDetails->description ?></textarea>
                                    @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label> Source Address</label>
                                    <input type="text" id="source_address" name="source_address" class="form-control" placeholder="Source address" value="<?= @$TruckDetails->source_address ?>" required>
                                    @if ($errors->has('source_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('source_address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label> Destination Address</label>
                                    <input type="text" id="fname" name="destination_address" class="form-control" placeholder="Destination address" value="<?= @$TruckDetails->destination_address ?>" required>
                                    @if ($errors->has('destination_address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('destination_address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label> Modal Year</label>
                                    <input type="text" id="year" name="year" class="form-control" placeholder="Year" value="<?= @$TruckDetails->year ?>" required>
                                    @if ($errors->has('year'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('year') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label> Truck Weight</label>
                                    <input type="text" id="weight" name="weight" class="form-control" placeholder="Weight" value="<?= @$TruckDetails->weight ?>" required>
                                    @if ($errors->has('weight'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('weight') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label> Truck Size</label>
                                    <input type="text" id="size" name="size" class="form-control" placeholder="Size" value="<?= @$TruckDetails->size ?>" required>
                                </div>
                                <div class="form-group">
                                    <label> Leaving</label>
                                    <input type="text" id="leaving" name="leaving" class="form-control" placeholder="Leaving" value="<?= @$TruckDetails->leaving ?>" required>
                                    
                                </div>
                                <div class="form-group">
                                    <label> To Comming</label>
                                    <input type="text" id="to_comming" name="to_comming" class="form-control" placeholder="To Comming" value="<?= @$TruckDetails->to_comming ?>" required>
                                   
                                </div>
                                <div class="form-group">
                                    <label> Dealer Vehicle</label>
                                    <select name="dealervehicle_id" class="form-control">
                                        <option value="">Select Vehicle:</option>
                                        @if(!empty($DealerVehicle))
                                        @foreach($DealerVehicle as $DVehicle)
                                        <option value="{{$DVehicle->id}}" {{ (@$TruckDetails->dealervehicle_id==$DVehicle->id)?'selected':''}}>{{$DVehicle->vehicle_name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label> Truck Type</label>
                                    <select name="truck_type" class="form-control">
                                        <option value="">Select truck:</option>
                                        @if(!empty($vehicleType))
                                        @foreach($vehicleType as $type)
                                        <option value="{{$type->id}}" {{ (@$TruckDetails->truck_type==$type->id)?'selected':''}}>{{$type->vehicle_type}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
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
@include('dashboard/includes.admin-footer')
