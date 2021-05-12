<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use App\User;
use App\DealerVehicle;
use App\VehicleType;
use App\Truck;
use App\VehicleFuelType;
use App\VehicleSubType;
use App\Dealer;
use App\Company;
use Validator;
use Mail;

class DealerController extends Controller {

    /**
     * Function to return user dealer page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function index() {

        return view('dashboard/dealer/dealerList');
    }

    /**
     * Function to fetch the dealer listing
     * @param void
     * @return array
     */
    public function fetchDealer(Request $request) {
        $start = $request->get('iDisplayStart');      // Offset
        $length = $request->get('iDisplayLength');     // Limit
        $sSearch = $request->get('sSearch');            // Search string
        $col = $request->get('iSortCol_0');         // Column number for sorting
        $sortType = $request->get('sSortDir_0');         // Sort type
        $dealerType = $request->get('dealer_type');         // Dealer Type
        // Datatable column number to table column name mapping
        $arr = array(
            0 => 'id',
            1 => 'dealer_name',
            2 => 'dealer_type',
            3 => 'created_at'
        );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Dealer type check
        $dealerTypeCondition = [1, 2];
        if ($dealerType == 1) {
            $dealerTypeCondition = [1];
        } else if ($dealerType == 2) {
            $dealerTypeCondition = [2];
        }

        // Get the records after applying the datatable filters
        $dealers = Dealer::whereIn('dealer_type', $dealerTypeCondition)
                ->where('dealer_name', 'like', '%' . $sSearch . '%')
                ->orderBy($sortBy, 'DESC')
                ->limit($length)
                ->offset($start)
                ->get();

        $iTotal = Dealer::whereIn('dealer_type', $dealerTypeCondition)
                ->where('dealer_name', 'like', '%' . $sSearch . '%')
                ->count();

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k = 0;
        if (count($dealers) > 0) {
            foreach ($dealers as $dealer) {
                if (@$dealer->user->status == 0) {
                    $status = 'Inactive';
                } else if (@$dealer->user->status == 1) {
                    $status = 'Active';
                } else if (@$dealer->user->status == 2) {
                    $status = 'On Hold';
                }

                $button = ( @$dealer->user->status ) ? '<a class="dealer_approval" data-val="2" id="' . $dealer->id . '" title="Hold"><i class="fa fa-ban"></i></a>' : '<a class="dealer_approval" data-val="1" id="' . $dealer->id . '" title="Approve"><i class="fa fa-check"></i></a>';
                $action = '<a href="addDealer/' . $dealer->id . '" '
                        . 'class="delete hidden-xs hidden-sm" title="Edit">'
                        . '<i class="fa fa-edit text-warning"></i></a> &nbsp;'
                        . ' <a href="deleteDealer/' . $dealer->id . '"'
                        . ' class="delete hidden-xs hidden-sm" title="Delete"'
                        . 'onclick=\'return confirm( "Are you sure you want to delete this company?" )\'>'
                        . '<i class="fa fa-trash text-danger"></i></a>';
                $response['aaData'][$k] = array(
                    0 => $dealer->id,
                    1 => '<a href="' . url('/dealervehicles?id=') . $dealer->user_id . '">' . ucwords(strtolower($dealer->dealer_name)) . '</a>',
                    2 => ( $dealer->dealer_type == 1 ) ? 'Individual' : 'Company',
                    3 => $dealer->created_at->format('d-M-Y'),
                    4 => ( $dealer->agreement_completed ) ? '<a target="_blank" href="' . asset('storage/' . str_replace('public/', '', $dealer->agreement_file_path)) . '">View</a>' : 'NA',
                    5 => $status,
                    6 => $button,
                    7 => $action
                );
                $k++;
            }
        }

        return response()->json($response);
    }

    /**
     * Function to save dealer details
     * @param void
     * @return array
     */
    public function saveDealer(Request $request, $dId = null) {
        if ($request->isMethod('get')) {
            $DealerDetails = "";
            $button = 'Add';

            $TruckDetails = "";

            $vehicleType = VehicleType::get();
            if (!empty($dId)) {
                $button = 'Update';


                $DealerDetails = DB::table('dealers as d')->select('u.mobile_no', 'u.email', 'u.name', 'd.*')
                                ->leftJoin('users as u', 'u.id', 'd.user_id')
                                ->where('d.id', $dId)->first();
//                $DealerDetails = Dealer::where(['id' => $dId])->first();
//                prd($DealerDetails);
            }

            return view('dashboard.dealer.addDealer', ['vehicleType' => $vehicleType, 'TruckDetails' => $TruckDetails, 'dealerDetails' => $DealerDetails, 'button' => $button]);
        }

        /* ADD/EDIT Dealer */
        if ($request->isMethod('post')) {
            $postData = $request->all();
            $cId = ($request->input('savebtn') == 'Update') ? $dId : '';
            $DealerDetails = ($request->input('savebtn') == 'Add') ? new Dealer() : Dealer::where(['id' => $dId])->first();

            $DealerDetails->dealer_name = !empty($postData['person_name']) ? $postData['person_name'] : $DealerDetails->person_name;
            $DealerDetails->company_name = !empty($postData['company_name']) ? $postData['company_name'] : $DealerDetails->company_name;
            $DealerDetails->contact_no = !empty($postData['mobile_no']) ? $postData['mobile_no'] : $DealerDetails->mobile_no;
            $DealerDetails->dealer_type = !empty($postData['company_name']) ? 2 : 1;

//            prd($postData);


            if (($request->input('savebtn') == 'Add')) {
                $DealerDetails->created_at = date('Y-m-d H:i:s');

                $user = new User();
                $user->name = $postData['person_name'];
                $user->email = $postData['email_id'];
                $user->mobile_no = $postData['mobile_no'];
                $user->role_id = 2;
                $user->password = \Hash::make($postData['password']);
                $user->status = '0';
                $user->created_at = date('Y-m-d H:i:s');
                if ($user->save()) {
                    $DealerDetails->user_id = $user->id;
                    $DealerDetails->save();
                }
                set_flash_message('Dealer Added Successfully.', 'alert-success');
            } else {
                $DealerDetails->updated_at = date('Y-m-d H:i:s');
                $DealerDetails->update();
                set_flash_message('Dealer Updated successfully', 'alert-success');
            }
            return redirect('dealers');
        }
    }

    /**
     * Function to fetch the selected Dealer details
     * @param void
     * @return array
     */
    public function getDealerDetails(Request $request) {
        $dealerId = $request->input('dealerId');
        $dealerDetails = Dealer::find($dealerId);
        return response()->json($dealerDetails);
    }

    /**
     * Function to delete Dealer
     * @param void
     * @return array
     */
    public function deleteDealer(Request $request, $dealerId) {
        $dealer = Dealer::find($dealerId);
        if ($dealer->delete()) {
            $response['resCode'] = 0;
            $response['resMsg'] = 'dealer deleted successfully';
        } else {
            $response['resCode'] = 2;
            $response['resMsg'] = 'Internal server error';
        }
        return redirect('/dealers');
    }

    /**
     * Function to return dealers vehicles listing view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function dealerVehicles(Request $request) {

        $id = Auth::User()->id;

        // Get User checkIfUserSubscribed
        // if(checkIfUserSubscribed($id) == false)
        // {
        //     return redirect('/subscription');
        // }

        // Get the dealerid (if available)
        $dealerId = $request->get('id', '');
        // Get the dealer details
        $dealerDetails = [];
        if ($dealerId != '') {
            
        }
        return view('dashboard.dealer.dealerVehicleList', ['dealerId' => $dealerId, 'dealerDetails' => $dealerDetails]);
    }

    /**
     * Function to fetch dealers listing
     * @param void
     * @return array
     */
    public function fetchVehicles(Request $request) {
        $dealerId = getUser_Detail_ByParam('id');           // dealerid
        $start = $request->get('iDisplayStart');      // Offset
        $length = $request->get('iDisplayLength');     // Limit
        $sSearch = $request->get('sSearch');            // Search string
        $col = $request->get('iSortCol_0');         // Column number for sorting
        $sortType = $request->get('sSortDir_0');         // Sort type
        $dealerType = $request->get('dealer_type');        // Dealer Type
        // Datatable column number to table column name mapping
        $arr = array(
            0 => 't1.id',
            1 => 't2.name',
            2 => 't3.vehicle_name'
        );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        DB::connection()->enableQueryLog();

        $vehicles = DB::table('dealer_vehicles as t1')
                ->leftJoin('users as t2', 't1.dealer_id', '=', 't2.id')
                ->leftJoin('vehicles as t3', 't1.vehicle_id', '=', 't3.id')
//                ->when($dealerId, function ($query, $dealerId) {
//                    return $query->where('t1.dealer_id', $dealerId);
//                })
                ->where('t1.dealer_id', $dealerId)
                // ->orWhere('name', 'like', '%' . $sSearch . '%')
                ->select('t1.*', 't2.name', 't3.vehicle_name')
                ->get();

//        prd($vehicles);

        $iTotal = DB::table('dealer_vehicles as t1')
                ->join('users as t2', 't1.dealer_id', '=', 't2.id')
                ->join('vehicles as t3', 't1.vehicle_id', '=', 't3.id')
                ->when($dealerId, function ($query, $dealerId) {
                    return $query->where('t1.dealer_id', $dealerId);
                })
                ->where('name', 'like', '%' . $sSearch . '%')
                // ->orWhere('name', 'like', '%' . $sSearch . '%')
                ->select('t1.id')
                ->count();

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );
//prd($vehicles);
        $k = 0;
        if (count($vehicles) > 0) {
            foreach ($vehicles as $vehicle) {
                if ($vehicle->status == '0') {
                    $status = 'Inactive';
                } else if ($vehicle->status == '1') {
                    $status = 'Active';
                } else if ($vehicle->status == '2') {
                    $status = 'On Hold';
                }

                $viewDetailBtn = '<a href="' . url('dashboard/vehicle/' . $vehicle->id) . '" title="View Details"><i class="fa fa-eye text-danger" style="font-size:18px;"></i></a>';

                $pauseBtn = '<a href="javascript:void(0);" title="Pause Vehicle" data-action="1" id="' . $vehicle->id . '" class="vehicle_action"><i class="fa fa-ban text-danger" style="font-size:16px;"></i></a> | ';
                if ($vehicle->is_paused == '1') {
                    $pauseBtn = '<a href="javascript:void(0);" title="Resume Vehicle" data-action="0" id="' . $vehicle->id . '" class="vehicle_action"><i class="fa fa-play text-warning" style="font-size:16px;"></i></a> | ';
                }

                $action = '<a href="editDealerVehicle/' . $vehicle->id . '" '
                        . 'class="delete hidden-xs hidden-sm" title="Edit">'
                        . '<i class="fa fa-edit text-warning"></i></a> &nbsp;'
                        . ' <a href="deleteDealerVehicle/' . $vehicle->id . '"'
                        . ' class="delete hidden-xs hidden-sm" title="Delete"'
                        . 'onclick=\'return confirm( "Are you sure you want to delete this dealer-vehicle?" )\'>'
                        . '<i class="fa fa-trash text-danger"></i></a>';
                $truckImage = !empty($vehicle->truck_logo) ? asset('storage/uploads/truck') . '/' . $vehicle->truck_logo : asset('storage/images') . '/not-available.jpg';

                $response['aaData'][$k] = [
                    $k + 1,
                    ucwords(strtolower($vehicle->name)),
                    ucwords(strtolower($vehicle->vehicle_name)),
                    $vehicle->distance_covered,
                    "<img src='$truckImage' height='50' width='50'>",
                    $vehicle->truck_name,
                    $vehicle->source_address,
                    $vehicle->destination_address,
                    $status,
                    $pauseBtn . $action
                ];
                $k++;
            }
        }

        return response()->json($response);
    }

    public function addDealerVehicle(Request $request, $dvid = null) {
        if (!Auth::check()) {
            set_flash_message('Please login with Company/Driver to access this page!', 'alert-danger');
            return redirect("advertise-truck");
        }
        // $id = Auth::User()->id;
        // Get User checkIfUserSubscribed
        // if(checkIfUserSubscribed($id) == false)
        // {
        //     return redirect('/subscription');
        // }

        $userId = $did = getUser_Detail_ByParam('id');
    
        if ($request->isMethod('get')) {
            $DealerDetails = "";
            $button = 'Add';

            $DealerDetails = "";
            $vehicleTypes = VehicleType::get();
            $vehicleFuelTypes = VehicleFuelType::get();
            $vehicles = \App\Vehicle::get();
            return view('dashboard.dealer.addDealerVehicle', [
                'did' => $did,
                'dealerDetails' => [],
                'button' => $button,
                'vehicleTypes' => $vehicleTypes,
                'vehicleFuelTypes' => $vehicleFuelTypes,
                'vehicleDetails' => [],
                'vehicles' => $vehicles
            ]);
        }

        if ($request->isMethod('post')) {
            $postData = $request->all();

           // $DealerDetails = empty($dvid) ? new DealerVehicle() : DealerVehicle::where(['id' => $dvid])->first();
           $DealerDetails = new DealerVehicle();
//            prd($DealerDetails);

            $DealerDetails->dealer_id = !empty($userId) ? $userId : $DealerDetails->dealer_id;
            $DealerDetails->vehicle_type_id = !empty($postData['vehicle_category']) ? $postData['vehicle_category'] : $DealerDetails->vehicle_type_id;
            $DealerDetails->fuel_type_id = !empty($postData['vehicle_fuel_type']) ? $postData['vehicle_fuel_type'] : $DealerDetails->fuel_type_id;
            $DealerDetails->vehicle_id = !empty($postData['vehicle_name']) ? $postData['vehicle_name'] : $DealerDetails->vehicle_name;
            $DealerDetails->registration_number = !empty($postData['vehicle_reg_no']) ? $postData['vehicle_reg_no'] : $DealerDetails->registration_number;
            $DealerDetails->distance_covered = !empty($postData['vehicle_distance_covered']) ? $postData['vehicle_distance_covered'] : $DealerDetails->distance_covered;
            $DealerDetails->color = !empty($postData['vehicle_color']) ? $postData['vehicle_color'] : $DealerDetails->vehicle_color;
            $DealerDetails->air_condition = !empty($postData['vehicle_air_condition']) ? $postData['vehicle_air_condition'] : $DealerDetails->air_condition;
            $DealerDetails->renting_policies = !empty($postData['vehicle_renting_policies']) ? $postData['vehicle_renting_policies'] : $DealerDetails->renting_policies;
            $DealerDetails->status = 1;

            $DealerDetails->axle_config = !empty($postData['axle_config']) ? $postData['axle_config'] : $DealerDetails->axle_config;
            $DealerDetails->gross_vehicle_weight = !empty($postData['gross_vehicle_weight']) ? $postData['gross_vehicle_weight'] : $DealerDetails->gross_vehicle_weight;
            $DealerDetails->engine_size = !empty($postData['engine_size']) ? $postData['engine_size'] : $DealerDetails->engine_size;
            $DealerDetails->transmission = !empty($postData['transmission']) ? $postData['transmission'] : $DealerDetails->transmission;
            $DealerDetails->brake_horse_power = !empty($postData['brake_horse_power']) ? $postData['brake_horse_power'] : $DealerDetails->brake_horse_power;
            $DealerDetails->interior_condition = !empty($postData['interior_condition']) ? $postData['interior_condition'] : $DealerDetails->interior_condition;
            $DealerDetails->tyre_condition = !empty($postData['tyre_condition']) ? $postData['tyre_condition'] : $DealerDetails->tyre_condition;
            $DealerDetails->driver_position = !empty($postData['driver_position']) ? $postData['driver_position'] : $DealerDetails->driver_position;
            $DealerDetails->number_of_seats = !empty($postData['number_of_seats']) ? $postData['number_of_seats'] : $DealerDetails->number_of_seats;
            $DealerDetails->condition = !empty($postData['condition']) ? $postData['condition'] : $DealerDetails->condition;

            $DealerDetails->year_of_purchase = !empty($postData['vehicle_purchase_year']) ? $postData['vehicle_purchase_year'] : $DealerDetails->year_of_purchase;
            $DealerDetails->comment = !empty($postData['comment']) ? $postData['comment'] : $DealerDetails->comment;

            //TRUCK DETAILS
            $DealerDetails->truck_name = !empty($postData['truck_name']) ? $postData['truck_name'] : $DealerDetails->truck_name;
            $DealerDetails->source_address = !empty($postData['source_address']) ? $postData['source_address'] : $DealerDetails->source_address;
            $DealerDetails->destination_address = !empty($postData['destination_address']) ? $postData['destination_address'] : $DealerDetails->destination_address;
            $DealerDetails->weight = !empty($postData['weight']) ? $postData['weight'] : $DealerDetails->weight;
            $DealerDetails->year = !empty($postData['year']) ? $postData['year'] : $DealerDetails->year;
            $DealerDetails->description = !empty($postData['description']) ? $postData['description'] : $DealerDetails->description;
            $DealerDetails->size = !empty($postData['size']) ? $postData['size'] : $DealerDetails->size;
            $DealerDetails->leaving = !empty($postData['leaving']) ? $postData['leaving'] : $DealerDetails->leaving;
            $DealerDetails->to_comming = !empty($postData['to_comming']) ? $postData['to_comming'] : $DealerDetails->to_comming;
            $DealerDetails->pickup_date = !empty($postData['drop_date']) ? $postData['drop_date'] : date('Y-m-d');
            $duration = '30 days';
            $DealerDetails->drop_date = !empty($postData['drop_date']) ? $postData['drop_date'] : createDate(date('Y-m-d'), "+" . $duration, 'Y-m-d');

            $truckLogo = $request->file('truck_logo');
            if (!empty($truckLogo)) {
                $logoFileName = upload_admin_images($truckLogo, 'truck');
                if (!empty($logoFileName)) {
                    $DealerDetails->truck_logo = $logoFileName;
                }
            }
            //TRUCK DETAILS END
//            prd($postData);
            $vehicleImage = $request->file('vehicle_images');
            if (!empty($vehicleImage)) {
                $logoFileName = upload_admin_images($vehicleImage, 'dealervehicle');
                if (!empty($logoFileName)) {
                    $DealerDetails->vehicle_images = $logoFileName;
                }
            }

            $DealerDetails->created_at = date('Y-m-d H:i:s');
            $DealerDetails->save();
            set_flash_message('Dealer Vehicle Added Successfully.', 'alert-success');

            $DealerDetails->updated_at = date('Y-m-d H:i:s');
            $DealerDetails->update();
            set_flash_message('Dealer Vehicle Updated successfully', 'alert-success');
              $user_type = getUser_Detail_ByParam('user_type');
            if ($user_type != 'Gold') {
                return redirect('/subscription');
            }
            else
            {
                  return redirect("dealervehicles");
            }
          
        }
    }

    public function addDealerVehicleSell(Request $request, $dvid = null) {
        if (!Auth::check()) {
            set_flash_message('Please login with Company/Driver to access this page!', 'alert-danger');
            return redirect("advertise-truck");
        }

        // $id = Auth::User()->id;
        // Get User checkIfUserSubscribed
        // if(checkIfUserSubscribed($id) == false)
        // {
        //     return redirect('/subscription');
        // }

        $userId = $did = getUser_Detail_ByParam('id');
    
        if ($request->isMethod('get')) {
            $DealerDetails = "";
            $button = 'Add';

            $DealerDetails = "";
            $vehicleTypes = VehicleType::get();
            $vehicleFuelTypes = VehicleFuelType::get();
            $vehicles = \App\Vehicle::get();
            return view('dashboard.dealer.addDealerVehicleSell', [
                'did' => $did,
                'dealerDetails' => [],
                'button' => $button,
                'vehicleTypes' => $vehicleTypes,
                'vehicleFuelTypes' => $vehicleFuelTypes,
                'vehicleDetails' => [],
                'vehicles' => $vehicles
            ]);
        }

        if ($request->isMethod('post')) {
            $postData = $request->all();

           // $DealerDetails = empty($dvid) ? new DealerVehicle() : DealerVehicle::where(['id' => $dvid])->first();
           $DealerDetails = new DealerVehicle();
//            prd($DealerDetails);

            $DealerDetails->dealer_id = !empty($userId) ? $userId : $DealerDetails->dealer_id;
            $DealerDetails->vehicle_type_id = !empty($postData['vehicle_category']) ? $postData['vehicle_category'] : $DealerDetails->vehicle_type_id;
            $DealerDetails->fuel_type_id = !empty($postData['vehicle_fuel_type']) ? $postData['vehicle_fuel_type'] : $DealerDetails->fuel_type_id;
            $DealerDetails->vehicle_id = !empty($postData['vehicle_name']) ? $postData['vehicle_name'] : $DealerDetails->vehicle_name;
            $DealerDetails->registration_number = !empty($postData['vehicle_reg_no']) ? $postData['vehicle_reg_no'] : $DealerDetails->registration_number;
            $DealerDetails->distance_covered = !empty($postData['vehicle_distance_covered']) ? $postData['vehicle_distance_covered'] : $DealerDetails->distance_covered;
            $DealerDetails->color = !empty($postData['vehicle_color']) ? $postData['vehicle_color'] : $DealerDetails->vehicle_color;
            $DealerDetails->air_condition = !empty($postData['vehicle_air_condition']) ? $postData['vehicle_air_condition'] : $DealerDetails->air_condition;
            $DealerDetails->renting_policies = !empty($postData['vehicle_renting_policies']) ? $postData['vehicle_renting_policies'] : $DealerDetails->renting_policies;
            $DealerDetails->status = 1;

            $DealerDetails->axle_config = !empty($postData['axle_config']) ? $postData['axle_config'] : $DealerDetails->axle_config;
            $DealerDetails->gross_vehicle_weight = !empty($postData['gross_vehicle_weight']) ? $postData['gross_vehicle_weight'] : $DealerDetails->gross_vehicle_weight;
            $DealerDetails->engine_size = !empty($postData['engine_size']) ? $postData['engine_size'] : $DealerDetails->engine_size;
            $DealerDetails->transmission = !empty($postData['transmission']) ? $postData['transmission'] : $DealerDetails->transmission;
            $DealerDetails->brake_horse_power = !empty($postData['brake_horse_power']) ? $postData['brake_horse_power'] : $DealerDetails->brake_horse_power;
            $DealerDetails->interior_condition = !empty($postData['interior_condition']) ? $postData['interior_condition'] : $DealerDetails->interior_condition;
            $DealerDetails->tyre_condition = !empty($postData['tyre_condition']) ? $postData['tyre_condition'] : $DealerDetails->tyre_condition;
            $DealerDetails->driver_position = !empty($postData['driver_position']) ? $postData['driver_position'] : $DealerDetails->driver_position;
            $DealerDetails->number_of_seats = !empty($postData['number_of_seats']) ? $postData['number_of_seats'] : $DealerDetails->number_of_seats;
            $DealerDetails->condition = !empty($postData['condition']) ? $postData['condition'] : $DealerDetails->condition;

            $DealerDetails->year_of_purchase = !empty($postData['vehicle_purchase_year']) ? $postData['vehicle_purchase_year'] : $DealerDetails->year_of_purchase;
            $DealerDetails->comment = !empty($postData['comment']) ? $postData['comment'] : $DealerDetails->comment;

            //TRUCK DETAILS
            $DealerDetails->truck_name = !empty($postData['truck_name']) ? $postData['truck_name'] : $DealerDetails->truck_name;
            $DealerDetails->source_address = !empty($postData['source_address']) ? $postData['source_address'] : $DealerDetails->source_address;
            $DealerDetails->destination_address = !empty($postData['destination_address']) ? $postData['destination_address'] : $DealerDetails->destination_address;
            $DealerDetails->weight = !empty($postData['weight']) ? $postData['weight'] : $DealerDetails->weight;
            $DealerDetails->year = !empty($postData['year']) ? $postData['year'] : $DealerDetails->year;
            $DealerDetails->description = !empty($postData['description']) ? $postData['description'] : $DealerDetails->description;
            $DealerDetails->size = !empty($postData['size']) ? $postData['size'] : $DealerDetails->size;
            $DealerDetails->leaving = !empty($postData['leaving']) ? $postData['leaving'] : $DealerDetails->leaving;
            $DealerDetails->to_comming = !empty($postData['to_comming']) ? $postData['to_comming'] : $DealerDetails->to_comming;
            $DealerDetails->pickup_date = !empty($postData['drop_date']) ? $postData['drop_date'] : date('Y-m-d');
            $duration = '30 days';
            $DealerDetails->drop_date = !empty($postData['drop_date']) ? $postData['drop_date'] : createDate(date('Y-m-d'), "+" . $duration, 'Y-m-d');

            $truckLogo = $request->file('truck_logo');
            if (!empty($truckLogo)) {
                $logoFileName = upload_admin_images($truckLogo, 'truck');
                if (!empty($logoFileName)) {
                    $DealerDetails->truck_logo = $logoFileName;
                }
            }
            //TRUCK DETAILS END
//            prd($postData);
            $vehicleImage = $request->file('vehicle_images');
            if (!empty($vehicleImage)) {
                $logoFileName = upload_admin_images($vehicleImage, 'dealervehicle');
                if (!empty($logoFileName)) {
                    $DealerDetails->vehicle_images = $logoFileName;
                }
            }

            $DealerDetails->created_at = date('Y-m-d H:i:s');
            $DealerDetails->save();
            set_flash_message('Dealer Vehicle Added Successfully.', 'alert-success');

            $DealerDetails->updated_at = date('Y-m-d H:i:s');
            $DealerDetails->update();
            set_flash_message('Dealer Vehicle Updated successfully', 'alert-success');
              $user_type = getUser_Detail_ByParam('user_type');
            if ($user_type != 'Gold') {
                return redirect('/subscription');
            }
            else
            {
                  return redirect("dealervehicles");
            }
          
        }
    }

    public function editDealerVehicle(Request $request, $dvid = null) {
//        prd($request->segments(1));
        if ($request->isMethod('get')) {
            $DealerDetails = "";
            $vehicleTypes = VehicleType::get();
            $vehicleFuelTypes = VehicleFuelType::get();
            $vehicleDetails = DealerVehicle::where('id', $dvid)->first();
            $vehicles = \App\Vehicle::get();

            $button = 'Update';
            $DealerDetails = DB::table('dealer_vehicles as dv')->select('d.dealer_name', 'd.company_name', 'd.user_id', 'dv.*')
                            ->leftJoin('dealers as d', 'd.id', 'dv.dealer_id')
                            ->where('dv.dealer_id', $vehicleDetails->dealer_id)->first();
            $method = $request->segments(1);
            return view('dashboard.dealer.addDealerVehicle', [
                'dvid' => $dvid,
                'did' => $vehicleDetails->dealer_id,
                'dealerDetails' => $DealerDetails,
                'button' => $button,
                'vehicleTypes' => $vehicleTypes,
                'vehicleFuelTypes' => $vehicleFuelTypes,
                'vehicleDetails' => $vehicleDetails,
                'vehicles' => $vehicles,
                'method' => $method[1]
            ]);
        }

        if ($request->isMethod('post')) {
            $postData = $request->all();

            $DealerDetails = DealerVehicle::where(['id' => $dvid])->first();
//            prd($DealerDetails);

            $DealerDetails->dealer_id = !empty($userId) ? $userId : $DealerDetails->dealer_id;
            $DealerDetails->vehicle_type_id = !empty($postData['vehicle_category']) ? $postData['vehicle_category'] : $DealerDetails->vehicle_type_id;
            $DealerDetails->fuel_type_id = !empty($postData['vehicle_fuel_type']) ? $postData['vehicle_fuel_type'] : $DealerDetails->fuel_type_id;
            $DealerDetails->vehicle_id = !empty($postData['vehicle_name']) ? $postData['vehicle_name'] : $DealerDetails->vehicle_name;
            $DealerDetails->registration_number = !empty($postData['vehicle_reg_no']) ? $postData['vehicle_reg_no'] : $DealerDetails->registration_number;
            $DealerDetails->distance_covered = !empty($postData['vehicle_distance_covered']) ? $postData['vehicle_distance_covered'] : $DealerDetails->distance_covered;
            $DealerDetails->color = !empty($postData['vehicle_color']) ? $postData['vehicle_color'] : $DealerDetails->vehicle_color;
            $DealerDetails->air_condition = !empty($postData['vehicle_air_condition']) ? $postData['vehicle_air_condition'] : $DealerDetails->air_condition;
            $DealerDetails->renting_policies = !empty($postData['vehicle_renting_policies']) ? $postData['vehicle_renting_policies'] : $DealerDetails->renting_policies;
            $DealerDetails->status = 1;

            $DealerDetails->axle_config = !empty($postData['axle_config']) ? $postData['axle_config'] : $DealerDetails->axle_config;
            $DealerDetails->gross_vehicle_weight = !empty($postData['gross_vehicle_weight']) ? $postData['gross_vehicle_weight'] : $DealerDetails->gross_vehicle_weight;
            $DealerDetails->engine_size = !empty($postData['engine_size']) ? $postData['engine_size'] : $DealerDetails->engine_size;
            $DealerDetails->transmission = !empty($postData['transmission']) ? $postData['transmission'] : $DealerDetails->transmission;
            $DealerDetails->brake_horse_power = !empty($postData['brake_horse_power']) ? $postData['brake_horse_power'] : $DealerDetails->brake_horse_power;
            $DealerDetails->interior_condition = !empty($postData['interior_condition']) ? $postData['interior_condition'] : $DealerDetails->interior_condition;
            $DealerDetails->tyre_condition = !empty($postData['tyre_condition']) ? $postData['tyre_condition'] : $DealerDetails->tyre_condition;
            $DealerDetails->driver_position = !empty($postData['driver_position']) ? $postData['driver_position'] : $DealerDetails->driver_position;
            $DealerDetails->number_of_seats = !empty($postData['number_of_seats']) ? $postData['number_of_seats'] : $DealerDetails->number_of_seats;
            $DealerDetails->condition = !empty($postData['condition']) ? $postData['condition'] : $DealerDetails->condition;

            $DealerDetails->year_of_purchase = !empty($postData['vehicle_purchase_year']) ? $postData['vehicle_purchase_year'] : $DealerDetails->year_of_purchase;
            $DealerDetails->comment = !empty($postData['comment']) ? $postData['comment'] : $DealerDetails->comment;

            //TRUCK DETAILS
            $DealerDetails->truck_name = !empty($postData['truck_name']) ? $postData['truck_name'] : $DealerDetails->truck_name;
            $DealerDetails->source_address = !empty($postData['source_address']) ? $postData['source_address'] : $DealerDetails->source_address;
            $DealerDetails->destination_address = !empty($postData['destination_address']) ? $postData['destination_address'] : $DealerDetails->destination_address;
            $DealerDetails->weight = !empty($postData['weight']) ? $postData['weight'] : $DealerDetails->weight;
            $DealerDetails->year = !empty($postData['year']) ? $postData['year'] : $DealerDetails->year;
            $DealerDetails->description = !empty($postData['description']) ? $postData['description'] : $DealerDetails->description;
            $DealerDetails->size = !empty($postData['size']) ? $postData['size'] : $DealerDetails->size;
            $DealerDetails->leaving = !empty($postData['leaving']) ? $postData['leaving'] : $DealerDetails->leaving;
            $DealerDetails->to_comming = !empty($postData['to_comming']) ? $postData['to_comming'] : $DealerDetails->to_comming;
            $DealerDetails->type = !empty($postData['type']) ? $postData['type'] : 1;
            $DealerDetails->pickup_date = !empty($postData['pickup_date']) ? $postData['pickup_date'] : date('Y-m-d');
            $duration = '30 days';
            $DealerDetails->drop_date = !empty($postData['drop_date']) ? $postData['drop_date'] : createDate(date('Y-m-d'), "+" . $duration, 'Y-m-d');

            $truckLogo = $request->file('truck_logo');
            if (!empty($truckLogo)) {
                $logoFileName = upload_admin_images($truckLogo, 'truck');
                if (!empty($logoFileName)) {
                    $DealerDetails->truck_logo = $logoFileName;
                }
            }
            //TRUCK DETAILS END
//            prd($postData);
            $vehicleImage = $request->file('vehicle_images');
            if (!empty($vehicleImage)) {
                $logoFileName = upload_admin_images($vehicleImage, 'dealervehicle');
                if (!empty($logoFileName)) {
                    $DealerDetails->vehicle_images = $logoFileName;
                }
            }

            $DealerDetails->updated_at = date('Y-m-d H:i:s');
            $DealerDetails->update();

            set_flash_message('Dealer Vehicle Updated successfully', 'alert-success');
            $user_type = getUser_Detail_ByParam('user_type');
            if ($user_type != 'Gold') {
                return redirect('/subscription');
            }
            else
            {
                return redirect("editDealerVehicle/".$dvid);
            }
        }
    }

    public function deleteDealerVehicle(Request $request, $dvId) {
        $DealerVehicle = DealerVehicle::find($dvId);
        if ($DealerVehicle->delete()) {
            set_flash_message('Dealer Vehicle Deleted successfully', 'alert-success');
        }
        return redirect("dealervehicles?id=$dvId");
    }

}
