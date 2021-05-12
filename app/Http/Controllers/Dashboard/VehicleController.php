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
use App\Vehicle;
use App\VehicleType;
use App\Company;
use Validator;
use Mail;

class VehicleController extends Controller {

    /**
     * Function to return user vehicle page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function index() {

        return view('admin/vehicle/vehicleList');
    }

    /**
     * Function to fetch the vehicle listing
     * @param void
     * @return array
     */
    public function fetchVehicle(Request $request) {
        $start = $request->input('iDisplayStart');      // Offset
        $length = $request->input('iDisplayLength');     // Limit
        $sSearch = $request->input('sSearch');            // Search string
        $col = $request->input('iSortCol_0');         // Column number for sorting
        $sortType = $request->input('sSortDir_0');         // Sort type
        // Datatable column number to table column name mapping
        $arr = array(
            0 => 'id',
            1 => 'vehicle_name',
            2 => 'company_name'
        );

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        $vehicle = Vehicle::where('vehicle_name', 'like', '%' . $sSearch . '%')
                ->orWhere('vehicle_name', 'like', '%' . $sSearch . '%')
                ->orderBy($sortBy, 'DESC')
                ->limit($length)
                ->offset($start)
                ->get();

        $iTotal = Vehicle::where('vehicle_name', 'like', '%' . $sSearch . '%')->orWhere('vehicle_name', 'like', '%' . $sSearch . '%')->count();

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k = 0;
        if (count($vehicle) > 0) {
            foreach ($vehicle as $vehic) {
                $companyName = 'NA';
                if ($vehic->company) {
                    $companyName = $vehic->company->company_name;
                }
                $vehicleType = 'NA';
                if ($vehic->vehicleType) {
                    $vehicleType = $vehic->vehicleType->vehicle_type;
                }

                $action = '<a href="addVehicle/' . $vehic->id . '" '
                        . 'class="delete hidden-xs hidden-sm" title="Edit">'
                        . '<i class="fa fa-edit text-warning"></i></a> &nbsp;'
                        . ' <a href="deleteVehicle/' . $vehic->id . '"'
                        . ' class="delete hidden-xs hidden-sm" title="Delete"'
                        . 'onclick=\'return confirm( "Are you sure you want to delete this company?" )\'>'
                        . '<i class="fa fa-trash text-danger"></i></a>';
                $response['aaData'][$k] = array(
                    0 => $vehic->id,
                    1 => $vehic->vehicle_name,
                    2 => $companyName,
                    3 => $vehicleType,
                    4 => $action
                );
                $k++;
            }
        }

        return response()->json($response);
    }

    /**
     * Function to save vehicle details
     * @param void
     * @return array
     */
    public function saveVehicle(Request $request, $vId = null) {
        if ($request->isMethod('get')) {
            $VehicleDetails = "";
            $button = 'Add';
            if (!empty($vId)) {
                $button = 'Update';
                $VehicleDetails = Vehicle::where(['id' => $vId])->first();
//                prd($VehicleDetails);
            }
            // Get Company details
            $companies = Company::get();
            // Get vehicle types list
            $vehicleTypes = VehicleType::get();
            return view('admin.vehicle.addVehicle', ['companies' => $companies, 'vehicleTypes' => $vehicleTypes, 'VehicleDetails' => $VehicleDetails, 'button' => $button]);
        }
        /* ADD/EDIT Vehicle */
        if ($request->isMethod('post')) {
            $postData = $request->all();
            $cId = ($request->input('savebtn') == 'Update') ? $vId : '';
            $VehicleDetails = ($request->input('savebtn') == 'Add') ? new Vehicle() : Vehicle::where(['id' => $vId])->first();


//            prd($postData);
            $VehicleDetails->vehicle_name = !empty($postData['vehicle_name']) ? $postData['vehicle_name'] : $VehicleDetails->vehicle_name;
            $VehicleDetails->company_id = !empty($postData['company_id']) ? $postData['company_id'] : $VehicleDetails->company_id;
            $VehicleDetails->vehicle_type_id = !empty($postData['vehicle_type_id']) ? $postData['vehicle_type_id'] : $VehicleDetails->vehicle_type_id;

            $vehicleImage = $request->file('vehicle_image');
            if (!empty($vehicleImage)) {
                $logoFileName = upload_admin_images($vehicleImage, 'vehicle');
                if (!empty($logoFileName)) {
                    $VehicleDetails->vehicle_image = $logoFileName;
                }
            }

            if (($request->input('savebtn') == 'Add')) {
                $VehicleDetails->created_at = date('Y-m-d H:i:s');
                $VehicleDetails->save();
                set_flash_message('Vehicle Added Successfully.', 'alert-success');
            } else {
                $VehicleDetails->updated_at = date('Y-m-d H:i:s');
                $VehicleDetails->update();
                set_flash_message('Vehicle Updated successfully', 'alert-success');
            }
            return redirect('admin/vehicles');
        }
    }

    /**
     * Function to fetch the selected Vehicle details
     * @param void
     * @return array
     */
    public function getVehicleDetails(Request $request) {
        $vehicleId = $request->input('vehicleId');
        $vehicleDetails = Vehicle::find($vehicleId);
        return response()->json($vehicleDetails);
    }

    /**
     * Function to delete Vehicle
     * @param void
     * @return array
     */
    public function deleteVehicle(Request $request, $vehicleId) {
        $vehicle = Vehicle::find($vehicleId);
        if ($vehicle->delete()) {
            $response['resCode'] = 0;
            $response['resMsg'] = 'vehicle deleted successfully';
        } else {
            $response['resCode'] = 2;
            $response['resMsg'] = 'Internal server error';
        }
        return redirect('admin/vehicles');
    }

}
