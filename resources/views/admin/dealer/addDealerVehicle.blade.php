@include('admin/includes.admin-head')
@include('admin/includes.admin-sidebar')
@php
    $formTitle = @$vehicleDetails->type == "1" ? 'Sale': 'Rent';
    $formDisabled = !empty($uid) ? 'disabled' : '';
@endphp
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
                    <h3 class="card-title">{{$button}} <span id="formTitle">{{$formTitle}}</span>  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form name="frm_vehicle_details" action="{{url('admin')}}/{{@$method}}/{{@$did}}/{{@$uid}}" method="post" id="salefrm_vehicle_details" autocomplete="off">
                        {{ csrf_field() }}
                       
                            <div class="form-group">
                                <label for="types">Truck Type:</label>
                                <select name="types"  class="form-control types" {{@$formDisabled}}>
                                    <option value="0" <?= @$vehicleDetails->type == 0 ? 'selected': '' ?> >Add Truck For Rent</option>
                                    <option value="1" <?= @$vehicleDetails->type == 1 ? 'selected': '' ?> >For Truck For Sale</option>
                                </select>
                            </div>
                        <div id="saleForm" >
                            <div class="form-group">
                                <label> Truck Name:</label>
                                <input type="text" id="fname" name="truck_name" class="form-control" placeholder="Truck Name" value="<?= @$vehicleDetails->truck_name ?>" required>
                                @if ($errors->has('truck_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('truck_name') }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="vehicle_name">Model:</label>
                                <select name="vehicle_id" id="vehicle_name" class="form-control">
                                    <option value="">Select</option>
                                    <?php
                                    if ($vehicles) {
                                        foreach ($vehicles as $vehicle) {
                                            $selected = '';
                                            if (@$vehicleDetails->vehicle_id == $vehicle->id) {
                                                $selected = 'selected';
                                            }
                                            echo "<option value='$vehicle->id'  $selected> $vehicle->vehicle_name</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="vehicle_category">Vehicle Category:</label>
                                <select name="vehicle_category" id="vehicle_category" class="form-control">
                                    <option value="">Select</option>
                                    <?php
                                    if ($vehicleTypes) {
                                        foreach ($vehicleTypes as $vehicleType) {
                                            $selected = '';
                                            if (@$vehicleDetails->vehicle_type_id == $vehicleType->id) {
                                                $selected = 'selected';
                                            }

                                            echo '<option value="' . $vehicleType->id . '" ' . $selected . '>' . ucwords($vehicleType->vehicle_type) . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            
                            <div class="form-group">
                                <label for="vehicle_fuel_type">Fuel Type:</label>
                                <select name="vehicle_fuel_type" id="vehicle_fuel_type" class="form-control">
                                    <option value="">Select</option>
                                    <?php
                                    if ($vehicleFuelTypes) {
                                        foreach ($vehicleFuelTypes as $vehicleFuelType) {
                                            $selected = '';
                                            if (@$vehicleDetails->fuel_type_id == $vehicleFuelType->id) {
                                                $selected = 'selected';
                                            }
                                            echo '<option value="' . $vehicleFuelType->id . '" ' . $selected . '>' . ucwords($vehicleFuelType->fuel_type) . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="vehicle_reg_no">Reg. Year :</label>
                                <input type="text" class="form-control" name="vehicle_reg_no" id="vehicle_reg_no" value="{{ @$vehicleDetails->registration_number }}">
                            </div>
                            
                            <div class="form-group">
                                <label for="mileage">Mileage:</label>
                                <input type="text" class="form-control" id="mileage" name="mileage" value="{{ @$vehicleDetails->mileage }}">
                            </div>
                           
                            <div class="form-group">
                                <label for="vehicle_color">Color(optional): </label>
                                <input type="color" class="form-control" id="vehicle_color" name="vehicle_color" value="{{ @$vehicleDetails->color }}">
                            </div>

                           <div class="form-group">
                                <label for="vehicle_air_condition">AC Fitted:</label>
                                <select name="vehicle_air_condition" id="vehicle_air_condition" class="form-control">
                                    <option value="">Select</option>
                                    <option value="0" {{ ( @$vehicleDetails->air_condition == '0' ) ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ ( @$vehicleDetails->air_condition == '1' ) ? 'selected' : '' }}>Yes</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="axle_config">Axle Config:</label>
                                <input  name="axle_config" value="{{ @$vehicleDetails->axle_config }}" type="text" class="form-control" id="axle_config">
                            </div>

                            <div class="form-group">
                                <label for="gross_vehicle_weight">Gross Vehicle Weight:</label>
                                <input  name="gross_vehicle_weight" value="{{ @$vehicleDetails->gross_vehicle_weight }}" type="text" class="form-control" id="gross_vehicle_weight">
                            </div>

                            <div class="form-group">
                                <label for="engine_size">Engine Size:</label>
                                <input  name="engine_size" value="{{ @$vehicleDetails->engine_size }}" id="engine_size" type="text" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="transmission">Transmission:</label>
                                <input  name="transmission" value="{{ @$vehicleDetails->transmission }}" id="transmission" type="text" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="brake_horse_power">Brake Horse Power:</label>
                                <input  name="brake_horse_power" value="{{ @$vehicleDetails->brake_horse_power }}" id="brake_horse_power" type="text" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="interior_condition">Interior Condition:</label>
                                <input  name="interior_condition" value="{{ @$vehicleDetails->interior_condition }}" id="interior_condition" type="text" class="form-control" >
                            </div>
                            <!-- <div class="form-group">
                                <label for="tyre_condition">Tyre Condition:</label>
                                <input  name="tyre_condition" value="{{ @$vehicleDetails->tyre_condition }}" id="tyre_condition" type="text" class="form-control" >
                            </div> -->
                            <div class="form-group">
                                <label for="driver_position">Driver Position:</label>
                                <input  name="driver_position" value="{{ @$vehicleDetails->driver_position }}" id="driver_position" type="text" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="number_of_seats">Number of Seats:</label>
                                <input  name="number_of_seats" value="{{ @$vehicleDetails->number_of_seats }}" id="number_of_seats" type="text" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="condition">Condition:</label>
                                <input  name="condition" value="{{ @$vehicleDetails->condition }}" id="condition" type="text" class="form-control" >
                            </div>


                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="0" {{ ( @$vehicleDetails->status == '0' ) ? 'selected': '' }}>Inactive</option>
                                    <option value="1" {{ ( @$vehicleDetails->status == '1' ) ? 'selected': '' }}>Approve</option>
                                    <option value="2" {{ ( @$vehicleDetails->status == '2' ) ? 'selected': '' }}>On Hold</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="comment">Comments (If Any):</label>
                                <textarea name="comment" id="comment" class="form-control">{{ @$vehicleDetails->comment }}</textarea>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <label> Truck Image:</label>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <img src="<?= !empty(@$vehicleDetails->truck_logo) ? asset('storage/uploads/truck') . '/' . @$vehicleDetails->truck_logo : asset('storage/images') . '/not-available.jpg' ?>" id="userImg" height="80" width="80">
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
                                        <label> Description:</label>
                                        <textarea  id="editor1" name="description" class="form-control textarea" placeholder="Description" required><?= @$vehicleDetails->description ?></textarea>
                                        @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label> Source Location:</label>
                                        <input type="text" id="from_location" name="source_address" class="form-control" placeholder="Source address" value="<?= @$vehicleDetails->source_address ?>" required>
                                        @if ($errors->has('source_address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('source_address') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    
                                    <div class="form-group">
                                        <label> Truck Weight:</label>
                                        <input type="text" id="weight" name="weight" class="form-control" placeholder="Weight" value="<?= @$vehicleDetails->weight ?>" required>
                                        @if ($errors->has('weight'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('weight') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label> Truck Size:</label>
                                        <input type="text" id="size" name="size" class="form-control" placeholder="Size" value="<?= @$vehicleDetails->size ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label> Price for sale</label>
                                        <input type="text" id="price_for_sale" name="price_for_sale" class="form-control" placeholder="Price For Sale" value="<?= @$vehicleDetails->price_for_sale ?>" required>
                                        @if ($errors->has('price_for_sale'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('price_for_sale') }}</strong>
                                        </span>
                                        @endif
                                    </div>
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
                            </div>
                        </div>
                        <div id="rentForm" >

                            <div class="form-group">
                                <label> Truck Name:</label>
                                <input type="text" id="fname" name="truck_name" class="form-control" placeholder="Truck Name" value="<?= @$vehicleDetails->truck_name ?>" required>
                                @if ($errors->has('truck_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('truck_name') }}</strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="vehicleid">Model:</label>
                                <select name="vehicle_id" id="vehicleid" class="form-control">
                                    <option value="">Select</option>
                                    <?php
                                        if ($vehicles) {
                                            foreach ($vehicles as $vehicle) {
                                                $selected = '';
                                                if (@$vehicleDetails->vehicle_id == $vehicle->id) {
                                                    $selected = 'selected';
                                                }
                                                echo "<option value='$vehicle->id' $selected> $vehicle->vehicle_name</option>";
                                            }
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="vehicle_category">Vehicle Category:</label>
                                <select name="vehicle_category" id="vehicle_category" class="form-control">
                                    <option value="">Select</option>
                                    @php
                                    if ($vehicleTypes) {
                                        foreach ($vehicleTypes as $vehicleType) {
                                            $selected = '';
                                            if (@$vehicleDetails->vehicle_type_id == $vehicleType->id) {
                                                $selected = 'selected';
                                            }

                                            echo '<option value="' . $vehicleType->id . '" ' . $selected . '>' . ucwords($vehicleType->vehicle_type) . '</option>';
                                        }
                                    }
                                    @endphp
                                </select>

                            </div>

                            <div class="form-group">
                                <label for="vehicle_fuel_type">Fuel Type:</label>
                                <select name="vehicle_fuel_type" id="vehicle_fuel_type" class="form-control">
                                    <option value="">Select</option>
                                    @php
                                    if ($vehicleFuelTypes) {
                                        foreach ($vehicleFuelTypes as $vehicleFuelType) {
                                            $selected = '';
                                            if (@$vehicleDetails->fuel_type_id == $vehicleFuelType->id) {
                                                $selected = 'selected';
                                            }
                                            echo '<option value="' . $vehicleFuelType->id . '" ' . $selected . '>' . ucwords($vehicleFuelType->fuel_type) . '</option>';
                                        }
                                    }
                                    @endphp
                                </select>
                            </div>
                            <div class="form-group">
                                        <label> Reg. Year:</label>
                                        <input type="date" id="year" name="year" class="form-control" placeholder="Year" value="<?= @$vehicleDetails->year ?>" required>
                                        @if ($errors->has('year'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('year') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                            <div class="form-group">
                                <label for="pickup_date">Pick Up Date:</label>
                                <input  name="pickup_date" value="{{ @$vehicleDetails->pickup_date }}" id="pickup_date" type="date" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="drop_date">Dropping Off Date:</label>
                                <input  name="drop_date" value="{{ @$vehicleDetails->drop_date }}" id="drop_date" type="date" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="vehicle_distance_covered">Distance Covered (optional):</label>
                                <input type="text" class="form-control" id="vehicle_distance_covered" name="vehicle_distance_covered" value="{{ @$vehicleDetails->distance_covered }}">
                            </div>
                            <div class="form-group">
                                <label for="vehicle_color">Color(optional):</label>
                                <input type="color" class="form-control" id="vehicle_color" name="vehicle_color" value="{{ @$vehicleDetails->color }}">
                            </div>


                            <div class="form-group">
                                <label for="vehicle_renting_policies">Renting Policies:</label>
                                <textarea name="vehicle_renting_policies" id="vehicle_renting_policies" class="form-control">{{ @$vehicleDetails->renting_policies }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="transmission">Transmission:</label>
                                <input  name="transmission" value="{{ @$vehicleDetails->transmission }}" id="transmission" type="text" class="form-control" >
                            </div>

                            <div class="form-group">
                                <label for="status">Status:</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="0" {{ ( @$vehicleDetails->status == '0' ) ? 'selected': '' }}>Inactive</option>
                                    <option value="1" {{ ( @$vehicleDetails->status == '1' ) ? 'selected': '' }}>Approve</option>
                                    <option value="2" {{ ( @$vehicleDetails->status == '2' ) ? 'selected': '' }}>On Hold</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="comment">Comments (If Any):</label>
                                <textarea name="comment" id="comment" class="form-control">{{ @$vehicleDetails->comment }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label> Truck Image:</label>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <img src="<?= !empty(@$vehicleDetails->truck_logo) ? asset('storage/uploads/truck') . '/' . @$vehicleDetails->truck_logo : asset('storage/images') . '/not-available.jpg' ?>" id="userImg" height="80" width="80">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group mgt30">
                                                <!-- bnew -->
                                                <div class="file btn btn-primary">
                                                    Upload
                                                    <input type="file" multiple="" class="custom-file-input hide-this" name="truck_logo" id="truck_logo" onchange= "readURL(this, 'userImg')" >
                                                </div>
                                                <!-- bnew -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label> Descriptions:</label>
                                        <textarea  id="editor1" name="description" class="form-control textarea" placeholder="Description" required><?= @$vehicleDetails->description ?></textarea>
                                        @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label> Source Location:</label>
                                        <input type="text" id="pickup_location" name="source_address" class="form-control" placeholder="Source address" value="<?= @$vehicleDetails->source_address ?>" required>
                                        @if ($errors->has('source_address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('source_address') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label> Destination Location:</label>
                                        <input type="text" id="dropping_location" name="destination_address" class="form-control" placeholder="Destination address" value="<?= @$vehicleDetails->destination_address ?>" required>
                                        @if ($errors->has('destination_address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('destination_address') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <!-- <div class="form-group">
                                        <label> Truck Weight</label>
                                        <input type="text" id="weight" name="weight" class="form-control" placeholder="Weight" value="<?= @$vehicleDetails->weight ?>" required>
                                        @if ($errors->has('weight'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('weight') }}</strong>
                                        </span>
                                        @endif
                                    </div> -->
                                    <div class="form-group">
                                        <label> Truck Size:</label>
                                        <input type="text" id="size" name="size" class="form-control" placeholder="Size" value="<?= @$vehicleDetails->size ?>" required>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label> Leaving</label>
                                        <input type="text" id="leaving" name="leaving" class="form-control" placeholder="Leaving" value="<?= @$vehicleDetails->leaving ?>" required>

                                    </div>
                                    <div class="form-group">
                                        <label> To Comming</label>
                                        <input type="text" id="to_comming" name="to_comming" class="form-control" placeholder="To Comming" value="<?= @$vehicleDetails->to_comming ?>" required>

                                    </div> -->

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
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script>

$(document).ready(function() {
    var types = "{{@$vehicleDetails->type}}";
    console.log(types)
    if(types == '0'){
        $("#rentForm").css('display','block')
        $("#saleForm").css('display','none')
        $("#formTitle").text('Rent')
        $("#rentForm :input").prop('disabled', false);
        $("#saleForm :input").prop('disabled', true);
    }else{
        $("#saleForm").css('display','block')
        $("#rentForm").css('display','none')
        $("#saleForm :input").prop('disabled', false);
        $("#rentForm :input").prop('disabled', true);
        $("#formTitle").text('Sale')

    }
});

$(".types").on('change',function(){
    var types = $(this).children("option:selected").val();
    console.log(types)

    if(types == 0){
        $("#rentForm").css('display','block')
        $("#saleForm").css('display','none')
        $("#formTitle").text('Rent')
        $("#rentForm :input").prop('disabled', false);
        $("#saleForm :input").prop('disabled', true);

    }else{
        $("#saleForm").css('display','block')
        $("#rentForm").css('display','none')
        $("#saleForm :input").prop('disabled', false);
        $("#rentForm :input").prop('disabled', true);
        $("#formTitle").text('Sale')

    }
});
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('public/sites/users/js/common.js') }}"></script>

@include('admin/includes.admin-footer')

