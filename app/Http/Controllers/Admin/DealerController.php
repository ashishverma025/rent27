<?php

namespace App\Http\Controllers\Admin;

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
use App\VehicleFuelType;
use App\VehicleSubType;
use App\Dealer;
use App\Company;
use Validator;
// use Mail;
use App\Mail\VerifyMail;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserMail;


class DealerController extends Controller {

    /**
     * Function to return user dealer page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function index() {

        return view('admin/dealer/dealerList');
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
            1 => 'name',
            2 => 'role_id',
            3 => 'email',
            4 => 'status',
            5 => 'created_at',
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
        // $dealers = Dealer::select('u.name','u.role_id','dealers.*')
        //         ->leftJoin('users as u','dealers.user_id','u.id')
        //         ->whereIn('users.role_id', $dealerTypeCondition)
        //         ->where('dealer_name', 'like', '%' . $sSearch . '%')
        //         ->orderBy($sortBy, 'DESC')
        //         ->limit($length)
        //         ->offset($start)
        //         ->get();

        $dealers = User::whereIn('role_id', $dealerTypeCondition)
                ->where('name', 'like', '%' . $sSearch . '%')
                ->orderBy($sortBy, 'DESC')
                ->limit($length)
                ->offset($start)
                ->get();

        $iTotal = User::whereIn('role_id', $dealerTypeCondition)
                ->where('name', 'like', '%' . $sSearch . '%')
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
                // prd($dealer);

                if (@$dealer->status == 0) {
                    $status = 'Inactive';
                } else if (@$dealer->status == 1) {
                    $status = 'Active';
                } else if (@$dealer->status == 2) {
                    $status = 'On Hold';
                }
                $uname = $dealer->fname?ucwords(strtolower($dealer->fname.' '.$dealer->lname)):ucwords(strtolower($dealer->name));
                $button = ( @$dealer->status ) ? '<a class="dealer_approval" data-val="2" id="' . $dealer->id . '" title="Hold"><i class="fa fa-ban"></i></a>' : '<a class="dealer_approval" data-val="1" id="' . $dealer->id . '" title="Approve"><i class="fa fa-check"></i></a>';
                $action = '<a href="addDealer/' . $dealer->id . '" '
                        . 'class="delete hidden-xs hidden-sm" title="Edit">'
                        . '<i class="fa fa-edit text-warning"></i></a> &nbsp;'
                        . ' <a href="deleteDealer/' . $dealer->id . '"'
                        . ' class="delete hidden-xs hidden-sm" title="Delete"'
                        . 'onclick=\'return confirm( "Are you sure you want to delete this company?" )\'>'
                        . '<i class="fa fa-trash text-danger"></i></a>';
                $response['aaData'][$k] = [
                    $k,
                    '<a href="' . url('/admin/dealervehicles?id=') . $dealer->id . '">' . $uname . '</a>',
                    ($dealer->role_id == 2 ) ? 'Driver' : 'Company',
                    $dealer->created_at->format('d-M-Y'),
                    //( $dealer->agreement_completed ) ? '<a target="_blank" href="' . asset('storage/' . str_replace('public/', '', $dealer->agreement_file_path)) . '">View</a>' : 'NA',
                    ( $dealer->email ) ?$dealer->email  : 'NA',
                    $status,
                    $button,
                    $action
                ];
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
            if (!empty($dId)) {
                $button = 'Update';
                $DealerDetails = DB::table('dealers as d')->select('u.mobile_no', 'u.email', 'u.name', 'd.*')
                                ->leftJoin('users as u', 'u.id', 'd.user_id')
                                ->where('d.id', $dId)->first();
//                $DealerDetails = Dealer::where(['id' => $dId])->first();
//                prd($DealerDetails);
            }

            return view('admin.dealer.addDealer', ['dealerDetails' => $DealerDetails, 'button' => $button]);
        }

        /* ADD/EDIT Dealer */
        if ($request->isMethod('post')) {
            $postData = $request->all();
            $DealerDetails = ($request->input('savebtn') == 'Add') ? new Dealer() : Dealer::where(['id' => $dId])->first();

            $DealerDetails->dealer_name = !empty($postData['person_name']) ? $postData['person_name'] : $DealerDetails->person_name;
            $DealerDetails->company_name = !empty($postData['company_name']) ? $postData['company_name'] : $DealerDetails->company_name;
            $DealerDetails->contact_no = !empty($postData['mobile_no']) ? $postData['mobile_no'] : $DealerDetails->mobile_no;
            $DealerDetails->dealer_type = !empty($postData['company_name']) ? 2 : 1;

        //    prd($postData);


            if (($request->input('savebtn') == 'Add')) {
                $DealerDetails->created_at = date('Y-m-d H:i:s');

                $user = new User();
                $user->name = $postData['person_name'];
                $user->email = $postData['email_id'];
                $user->mobile_no = $postData['mobile_no'];
                $user->role_id = 2;
                $user->password = \Hash::make($postData['password']);
                $user->status = '0';
                $user->email_verified_at = null;
                $user->verifyTocken = @$postData['_token'];

                $user->created_at = date('Y-m-d H:i:s');
                if ($user->save()) {

                    $data = [];
                    $data['verify_token'] =  @$postData['_token'];
                    $data['name']         = $postData['person_name'];
                    $data['email']        = $postData['email_id'];
                    $data['id']           = $user->id;
                    Mail::to($postData['email_id'])->send(new VerifyMail($data));

                    $DealerDetails->user_id = $user->id;
                    $DealerDetails->save();
                }
                set_flash_message('Dealer Added Successfully.', 'alert-success');
            } else {
                $DealerDetails->updated_at = date('Y-m-d H:i:s');
                $DealerDetails->update();
                set_flash_message('Dealer Updated successfully', 'alert-success');
            }
            return redirect('admin/dealers');
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
    public function deleteDealer(Request $request, $userId) {
        $user = User::find($userId);
        if ($user) {
            if ($user->delete()) {
                $dealer = Dealer::where('user_id', $userId)->first();

                $dealer?$dealer->delete():'';
                $dealerVehicle = DealerVehicle::where('dealer_id', $userId)->first();
                $dealerVehicle->delete();

                $response['resCode'] = 0;
                $response['resMsg'] = 'dealer deleted successfully';
            } else {
                $response['resCode'] = 2;
                $response['resMsg'] = 'Internal server error';
            }
        }
        return redirect('/admin/dealers');
    }

    /**
     * Function to return dealers vehicles listing view
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function dealerVehicles(Request $request) {
        // Get the dealerid (if available)
        $dealerId = $request->get('id', '');

        // Get the dealer details
        $dealerDetails = [];
        if ($dealerId != '') {
            
        }

        return view('admin.dealer.dealerVehicleList', ['dealerId' => $dealerId, 'dealerDetails' => $dealerDetails]);
    }

    /**
     * Function to fetch dealers listing
     * @param void
     * @return array
     */
    public function fetchVehicles(Request $request) {
        $dealerId = $request->get('id');           // dealerid
        $start = $request->get('iDisplayStart');      // Offset
        $length = $request->get('iDisplayLength');     // Limit
        $sSearch = $request->get('sSearch');            // Search string
        $col = $request->get('iSortCol_0');         // Column number for sorting
        $sortType = $request->get('sSortDir_0');         // Sort type
        $dealerType = $request->get('dealer_type');        // Dealer Type
        // Datatable column number to table column name mapping
       
        $arr = ['t1.id','t2.name', 't3.vehicle_name','t3.truck_name','t3.price_for_sale', ];

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
                ->select('t1.*', 't2.name','t2.id as uId', 't3.vehicle_name')
                ->get();

    //    prd($vehicles);

        $iTotal = DB::table('dealer_vehicles as t1')->select('t2.id as uId','t1.*')
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

                $viewDetailBtn = '<a href="' . url('admin/vehicle/' . $vehicle->id) . '" title="View Details"><i class="fa fa-eye text-danger" style="font-size:18px;"></i></a>';

                $pauseBtn = '<a href="javascript:void(0);" title="Pause Vehicle" data-action="1" id="' . $vehicle->id . '" class="vehicle_action"><i class="fa fa-ban text-danger" style="font-size:16px;"></i></a> | ';
                if ($vehicle->is_paused == '1') {
                    $pauseBtn = '<a href="javascript:void(0);" title="Resume Vehicle" data-action="0" id="' . $vehicle->id . '" class="vehicle_action"><i class="fa fa-play text-warning" style="font-size:16px;"></i></a> | ';
                }

                $action = '<a href="editDealerVehicle/' . $vehicle->id . '/'. $vehicle->uId.'" '
                        . 'class="delete hidden-xs hidden-sm" title="Edit">'
                        . '<i class="fa fa-edit text-warning"></i></a> &nbsp;'
                        . ' <a href="deleteDealerVehicle/' . $vehicle->id . '"'
                        . ' class="delete hidden-xs hidden-sm" title="Delete"'
                        . 'onclick=\'return confirm( "Are you sure you want to delete this dealer-vehicle?" )\'>'
                        . '<i class="fa fa-trash text-danger"></i></a>';
                
                $type = $vehicle->type == 0 ? 'Truck For Rent': 'Truck For Sale';
                       
                $response['aaData'][$k] = [
                    $vehicle->id,
                    ucwords(strtolower($vehicle->name)),
                    $vehicle->truck_name ,
                    $type,
                    $vehicle->price_for_sale,
                    ucwords(strtolower($vehicle->vehicle_name)),
                    $vehicle->source_address,
                    $vehicle->destination_address,
                    @$status,
                    $pauseBtn . $action
                ];
                $k++;
            }
        }

        return response()->json($response);
    }

    public function addDealerVehicle(Request $request, $did = null,$uid = null) {
        if ($request->isMethod('get')) {
            $DealerDetails = "";

            if (!empty($did)) {
                $vehicleTypes = VehicleType::get();
                $vehicleFuelTypes = VehicleFuelType::get();
                $vehicleDetails = DealerVehicle::where('id', $did)->first();
                $vehicles = \App\Vehicle::get();

                $DealerDetails = DB::table('dealer_vehicles as dv')
                                ->select('d.dealer_name', 'd.company_name', 'd.user_id', 'dv.*')
                                ->leftJoin('dealers as d', 'd.id', 'dv.dealer_id')
                                ->where('dv.dealer_id', $did)->first();
//                $DealerDetails = Dealer::where(['id' => $dId])->first();
            //    prd($vehicleDetails);
            }
            $method = $request->segments(1);
            $button = empty($uid)?'Add Truck For ':'Update Truck For ';

            return view( 'admin.dealer.addDealerVehicle' , [
                'did' => $did,
                'uid' => $uid,
                'dealerDetails' => $DealerDetails,
                'button' => $button,
                'vehicleTypes' => $vehicleTypes,
                'vehicleFuelTypes' => $vehicleFuelTypes,
                'vehicleDetails' => $vehicleDetails?$vehicleDetails:[],
                'vehicles' => $vehicles,
                'method' => $method[1]
            ]);
        }



        if ($request->isMethod('post')) {
            $postData = $request->all();
            $DealerDetails = empty($uid) ? new DealerVehicle() : DealerVehicle::where(['id' => $did])->first();
            // prd($DealerDetails);
            $DealerDetails->price_for_sale = !empty($postData['price_for_sale']) ? $postData['price_for_sale'] : $DealerDetails->price_for_sale;
            $DealerDetails->vehicle_type_id = !empty($postData['vehicle_category']) ? $postData['vehicle_category'] : $DealerDetails->vehicle_type_id;
            $DealerDetails->fuel_type_id = !empty($postData['vehicle_fuel_type']) ? $postData['vehicle_fuel_type'] : $DealerDetails->fuel_type_id;
            $DealerDetails->vehicle_id = !empty($postData['vehicle_id']) ? $postData['vehicle_id'] : $DealerDetails->vehicle_id;
            $DealerDetails->registration_number = !empty($postData['vehicle_reg_no']) ? $postData['vehicle_reg_no'] : $DealerDetails->registration_number;
            $DealerDetails->distance_covered = !empty($postData['vehicle_distance_covered']) ? $postData['vehicle_distance_covered'] : $DealerDetails->distance_covered;
            $DealerDetails->color = !empty($postData['vehicle_color']) ? $postData['vehicle_color'] : $DealerDetails->vehicle_color;
            $DealerDetails->renting_policies = !empty($postData['vehicle_renting_policies']) ? $postData['vehicle_renting_policies'] : $DealerDetails->renting_policies;
            $DealerDetails->mileage = !empty($postData['mileage']) ? $postData['mileage'] : $DealerDetails->mileage;
            $DealerDetails->axle_config = !empty($postData['axle_config']) ? $postData['axle_config'] : $DealerDetails->axle_config;
            $DealerDetails->gross_vehicle_weight = !empty($postData['gross_vehicle_weight']) ? $postData['gross_vehicle_weight'] : $DealerDetails->gross_vehicle_weight;
            $DealerDetails->weight = !empty($postData['weight']) ? $postData['weight'] : $DealerDetails->weight;
            $DealerDetails->transmission = !empty($postData['transmission']) ? $postData['transmission'] : $DealerDetails->transmission;
            $DealerDetails->comment = !empty($postData['comment']) ? $postData['comment'] : $DealerDetails->comment;
            //TRUCK DETAILS
            $DealerDetails->truck_name = !empty($postData['truck_name']) ? $postData['truck_name'] : $DealerDetails->truck_name;
            $DealerDetails->source_address = !empty($postData['source_address']) ? $postData['source_address'] : $DealerDetails->source_address;
            $DealerDetails->destination_address = !empty($postData['destination_address']) ? $postData['destination_address'] : $DealerDetails->destination_address;
            $DealerDetails->description = !empty($postData['description']) ? $postData['description'] : $DealerDetails->description;
            $DealerDetails->size = !empty($postData['size']) ? $postData['size'] : $DealerDetails->size;
            $DealerDetails->pickup_date = !empty($postData['drop_date']) ? $postData['drop_date'] : date('Y-m-d');
            $duration = '30 days';
            $DealerDetails->drop_date = !empty($postData['drop_date']) ? $postData['drop_date'] : createDate(date('Y-m-d'), "+" . $duration, 'Y-m-d');
            $DealerDetails->type = !empty($postData['types']) ? $postData['types'] : $DealerDetails->type;
            $DealerDetails->status =  !empty($postData['status']) ? $postData['status'] : $DealerDetails->status;

            // prd($postData);

            $truckLogo = $request->file('truck_logo');
            if (!empty($truckLogo)) {
                $logoFileName = upload_admin_images($truckLogo, 'truck');
                if (!empty($logoFileName)) {
                    $DealerDetails->truck_logo = $logoFileName;
                }
            }
            if(empty($uid)){
                $DealerDetails->created_at = date('Y-m-d H:i:s');
                $DealerDetails->dealer_id = !empty($did) ? $did : $DealerDetails->dealer_id;
            }else{
                $DealerDetails->updated_at = date('Y-m-d H:i:s');
            }


            $DealerDetails->save();
            set_flash_message('Dealer Vehicle Added Successfully.', 'alert-success');

            return redirect('admin/dealers');
        }
    }

    public function deleteDealerVehicle(Request $request, $dvId) {
        $DealerVehicle = DealerVehicle::find($dvId);
        if ($DealerVehicle->delete()) {
            set_flash_message('Dealer Vehicle Deleted successfully', 'alert-success');
        }
        return redirect("admin/dealervehicles?id=$dvId");
    }

}
