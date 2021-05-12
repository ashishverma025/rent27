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
use App\Truck;
use Validator;
use App\VehicleType;

use Mail;

class TruckController extends Controller {

    /**
     * Function to return user truck page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin/truck/truckList');
    }

    /**
     * Function to fetch the truck listing
     * @param void
     * @return array
     */
    public function fetchTruck(Request $request) {
        $start = $request->input('iDisplayStart');      // Offset
        $length = $request->input('iDisplayLength');     // Limit
        $sSearch = $request->input('sSearch');            // Search string
        $col = $request->input('iSortCol_0');         // Column number for sorting
        $sortType = $request->input('sSortDir_0');         // Sort type
        // Datatable column number to table column name mapping
        $arr = ['id', 'truck_name'];

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        $truck = Truck::where('truck_name', 'like', '%' . $sSearch . '%')
                ->orWhere('truck_name', 'like', '%' . $sSearch . '%')
                ->orderBy($sortBy, 'DESC')
                ->limit($length)
                ->offset($start)
                ->get();

        $iTotal = Truck::where('truck_name', 'like', '%' . $sSearch . '%')->orWhere('truck_name', 'like', '%' . $sSearch . '%')->count();

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k = 0;
        if (count($truck) > 0) {
            foreach ($truck as $truk) {
                $truckImage = !empty($truk->truck_logo) ? asset('storage/uploads/truck') . '/' . $truk->truck_logo : asset('storage/images') . '/not-available.jpg';
                $action = '<a href="addTruck/' . $truk->id . '" '
                        . 'class="delete hidden-xs hidden-sm" title="Edit">'
                        . '<i class="fa fa-edit text-warning"></i></a> &nbsp;'
                        . ' <a href="deleteTruck/' . $truk->id . '"'
                        . ' class="delete hidden-xs hidden-sm" title="Delete"'
                        . 'onclick=\'return confirm( "Are you sure you want to delete this truck?" )\'>'
                        . '<i class="fa fa-trash text-danger"></i></a>';
                $response['aaData'][$k] = [$k + 1, "<img src='$truckImage' height='50' width='50'>", $truk->truck_name, $truk->source_address, $truk->destination_address, $action];
                $k++;
            }
        }

        return response()->json($response);
    }

    /**
     * Function to save truck details
     * @param void
     * @return array
     */
    public function saveTruck(Request $request, $cId = null) {
        if ($request->isMethod('get')) {
            $TruckDetails = "";
            $button = 'Add';
            if (!empty($cId)) {
                $button = 'Update';
                $TruckDetails = Truck::where(['id' => $cId])->first();
            }
            $vehicleType = VehicleType::get();
            return view('admin.truck.addTruck', ['TruckDetails' => $TruckDetails, 'button' => $button, 'vehicleType' => $vehicleType]);
        }
        /* ADD/EDIT COMPANY */
        if ($request->isMethod('post')) {

            $postData = $request->all();
//            prd($postData);
            $cId = ($request->input('savebtn') == 'Update') ? $cId : '';
            $TruckDetails = ($request->input('savebtn') == 'Add') ? new Truck() : Truck::where(['id' => $cId])->first();

            $TruckDetails->truck_name = !empty($postData['truck_name']) ? $postData['truck_name'] : $TruckDetails->truck_name;
            $TruckDetails->source_address = !empty($postData['source_address']) ? $postData['source_address'] : $TruckDetails->source_address;
            $TruckDetails->destination_address = !empty($postData['destination_address']) ? $postData['destination_address'] : $TruckDetails->destination_address;
            $TruckDetails->weight = !empty($postData['weight']) ? $postData['weight'] : $TruckDetails->weight;
            $TruckDetails->year = !empty($postData['year']) ? $postData['year'] : $TruckDetails->year;
            $TruckDetails->description = !empty($postData['description']) ? $postData['description'] : $TruckDetails->description;
            $TruckDetails->truck_type = !empty($postData['truck_type']) ? $postData['truck_type'] : $TruckDetails->truck_type;
            $TruckDetails->size = !empty($postData['size']) ? $postData['size'] : $TruckDetails->size;
            $TruckDetails->leaving = !empty($postData['leaving']) ? $postData['leaving'] : $TruckDetails->leaving;
            $TruckDetails->to_comming = !empty($postData['to_comming']) ? $postData['to_comming'] : $TruckDetails->to_comming;

            $truckLogo = $request->file('truck_logo');
            if (!empty($truckLogo)) {
                $logoFileName = upload_admin_images($truckLogo, 'truck');
                if (!empty($logoFileName)) {
                    $TruckDetails->truck_logo = $logoFileName;
                }
            }

            if (($request->input('savebtn') == 'Add')) {
                $TruckDetails->created_at = date('Y-m-d H:i:s');
                $TruckDetails->save();
                set_flash_message('Truck Added Successfully.', 'alert-success');
            } else {
                $TruckDetails->updated_at = date('Y-m-d H:i:s');
                $TruckDetails->update();
                set_flash_message('Truck Updated successfully', 'alert-success');
            }
            return redirect('admin/trucks');
        }
    }

    /**
     * Function to fetch the selected Truck details
     * @param void
     * @return array
     */
    public function getTruckDetails(Request $request) {
        $truckId = $request->input('truckId');
        $truckDetails = Truck::find($truckId);
        return response()->json($truckDetails);
    }

    /**
     * Function to delete Truck
     * @param void
     * @return array
     */
    public function deleteTruck(Request $request, $truckId) {
        $truck = Truck::find($truckId);
        if ($truck->delete()) {
            $response['resCode'] = 0;
            $response['resMsg'] = 'truck deleted successfully';
        } else {
            $response['resCode'] = 2;
            $response['resMsg'] = 'Internal server error';
        }
        return redirect('admin/trucks');
    }

}
