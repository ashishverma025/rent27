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


                    <form name="frm_vehicle_details" action="{{url('admin')}}/{{@$method}}/{{@$did}}" method="post" id="frm_vehicle_details" autocomplete="off">
                        {{ csrf_field() }}
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
                            <input type="hidden" name="dealer_id" id="vehicle_id" value="{{ @$did }}">
                        </div>
                        <!-- <div class="form-group">
                                <label for="vehicle_sub_category">Vehicle Sub Category:</label>
                                <select name="vehicle_sub_category" id="vehicle_sub_category" class="form-control">
                                        <option value="">Select</option>
                                </select>
                        </div> -->
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
                            <label for="vehicle_name">Vehicle:</label>
                            <select name="vehicle_name" id="vehicle_name" class="form-control">
                                <option value="">Select</option>
                                <?php
                                if ($vehicles) {
                                    foreach ($vehicles as $vehicle) {
                                        $selected = '';
                                        if (@$vehicleDetails->vehicle_id == $vehicle->id) {
                                            $selected = 'selected';
                                        }

                                        echo '<option value="' . $vehicle->id . '" ' . $selected . '>' . ucwords($vehicle->vehicle_name) . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="vehicle_reg_no">Registration No:</label>
                            <input type="text" class="form-control" name="vehicle_reg_no" id="vehicle_reg_no" value="{{ @$vehicleDetails->registration_number }}">
                        </div>
                        
                            <div class="form-group">
                            <label for="source_address">Source Address:</label>
                            <input type="text" class="form-control" name="source_address" id="source_address" value="{{ @$vehicleDetails->source_address }}">
                        </div>
                        
                           <div class="form-group">
                            <label for="source_address">Destination Address:</label>
                            <input type="text" class="form-control" name="destination_address" id="destination_address" value="{{ @$vehicleDetails->destination_address }}">
                        </div>
                           <div class="form-group">
                            <label for="year">Year:</label>
                            <input type="text" class="form-control" name="year" id="year" value="{{ @$vehicleDetails->year }}">
                        </div>
                           <div class="form-group">
                            <label for="weight">Weight:</label>
                            <input type="text" class="form-control" name="weight" id="weight" value="{{ @$vehicleDetails->weight }}">
                        </div>
                           <div class="form-group">
                            <label for="leaving">Leaving:</label>
                            <input type="text" class="form-control" name="leaving" id="leaving" value="{{ @$vehicleDetails->leaving }}">
                        </div>
                           <div class="form-group">
                            <label for="to_comming">To Comming:</label>
                            <input type="text" class="form-control" name="to_comming" id="to_comming" value="{{ @$vehicleDetails->to_comming }}">
                        </div>
                           <div class="form-group">
                            <label for="size">size:</label>
                            <input type="text" class="form-control" name="size" id="size" value="{{ @$vehicleDetails->size }}">
                        </div>
                        <div class="form-group">
                            <label for="vehicle_purchase_year">Year of Purchase:</label>
                            <select name="vehicle_purchase_year" id="vehicle_purchase_year" class="form-control">
                                <option value="">Select</option>
                                <?php
                                $currYear = date('Y');
                                $startYear = date("Y", strtotime("-8 year"));
                                for ($i = $startYear; $i <= $currYear; $i++) {
                                    $selected = '';
                                    if (@$vehicleDetails->year_of_purchase == $i) {
                                        $selected = 'selected';
                                    }

                                    echo '<option value="' . $i . '" ' . $selected . '>' . $i . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="vehicle_distance_covered">Distance Covered:</label>
                            <input type="text" class="form-control" id="vehicle_distance_covered" name="vehicle_distance_covered" value="{{ @$vehicleDetails->distance_covered }}">
                        </div>
                        <div class="form-group">
                            <label for="vehicle_color">Color:</label>
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
                            <label for="vehicle_hourly_charge">Hourly Charges:</label>
                            <input type="text" class="form-control" id="vehicle_hourly_charge" name="vehicle_hourly_charge" value="{{ @$vehicleDetails->hourly_charge }}">
                        </div>
                        <div class="form-group">
                            <label>Daywise Charges:</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="vehicle_day1_charge">Monday:</label>	
                                    <input type="text" class="form-control" id="vehicle_day1_charge" name="vehicle_day1_charge" value="{{ @$vehicleDetails->day1_charge }}">
                                    <a href="javascript:void(0);" id="copy_charge">Same charge for all days</a>
                                </div>
                                <div class="col-md-3">
                                    <label for="vehicle_day2_charge">Tuesday:</label>	
                                    <input type="text" class="form-control" id="vehicle_day2_charge" name="vehicle_day2_charge" value="{{ @$vehicleDetails->day2_charge }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="vehicle_day3_charge">Wednesday:</label>	
                                    <input type="text" class="form-control" id="vehicle_day3_charge" name="vehicle_day3_charge" value="{{ @$vehicleDetails->day3_charge }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="vehicle_day4_charge">Thursday:</label>	
                                    <input type="text" class="form-control" id="vehicle_day4_charge" name="vehicle_day4_charge" value="{{ @$vehicleDetails->day4_charge }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="vehicle_day5_charge">Friday:</label>	
                                    <input type="text" class="form-control" id="vehicle_day5_charge" name="vehicle_day5_charge" value="{{ @$vehicleDetails->day5_charge }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="vehicle_day6_charge">Saturday:</label>	
                                    <input type="text" class="form-control" id="vehicle_day6_charge" name="vehicle_day6_charge" value="{{ @$vehicleDetails->day6_charge }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="vehicle_day7_charge">Sunday:</label>	
                                    <input type="text" class="form-control" id="vehicle_day7_charge" name="vehicle_day7_charge" value="{{ @$vehicleDetails->day7_charge }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="vehicle_weekly_charge">Weekly Charges:</label>
                            <input type="text" class="form-control" id="vehicle_weekly_charge" name="vehicle_weekly_charge" value="{{ @$vehicleDetails->weekly_charge }}">
                        </div>
                        <div class="form-group">
                            <label for="vehicle_monthly_charge">Monthly Charges:</label>
                            <input type="text" class="form-control" id="vehicle_monthly_charge" name="vehicle_monthly_charge" value="{{ @$vehicleDetails->monthly_charge }}">
                        </div>
                        <div class="form-group">
                            <label for="vehicle_renting_policies">Renting Policies:</label>
                            <textarea name="vehicle_renting_policies" id="vehicle_renting_policies" class="form-control">{{ @$vehicleDetails->renting_policies }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="vehicle_images">Images (If you do not upload any image then default image will be shown):</label>
                            <input type="file" multiple="" name="vehicle_images" id="vehicle_images" class="form-control">
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
                    </form>

                </div>
            </div>
            <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{ asset('public/sites/users/js/common.js') }}"></script>

@include('admin/includes.admin-footer')
