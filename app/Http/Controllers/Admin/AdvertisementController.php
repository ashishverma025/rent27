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
use App\Advertise;
use Validator;
use Mail;

class AdvertiseController extends Controller {

    /**
     * Function to return user advertise page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin/advertise/advertiseList');
    }

    /**
     * Function to fetch the advertise listing
     * @param void
     * @return array
     */
    public function fetchAdvertise(Request $request) {
        $start = $request->input('iDisplayStart');      // Offset
        $length = $request->input('iDisplayLength');     // Limit
        $sSearch = $request->input('sSearch');            // Search string
        $col = $request->input('iSortCol_0');         // Column number for sorting
        $sortType = $request->input('sSortDir_0');         // Sort type
        // Datatable column number to table column name mapping
        $arr = ['id', 'advertise_name'];

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        $advertise = Advertise::where('advertise_name', 'like', '%' . $sSearch . '%')
                ->orWhere('advertise_name', 'like', '%' . $sSearch . '%')
                ->orderBy($sortBy, 'DESC')
                ->limit($length)
                ->offset($start)
                ->get();

        $iTotal = Advertise::where('advertise_name', 'like', '%' . $sSearch . '%')->orWhere('advertise_name', 'like', '%' . $sSearch . '%')->count();

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k = 0;
        if (count($advertise) > 0) {
            foreach ($advertise as $comp) {
                $action = '<a href="addAdvertise/' . $comp->id . '" '
                        . 'class="delete hidden-xs hidden-sm" title="Edit">'
                        . '<i class="fa fa-edit text-warning"></i></a> &nbsp;'
                        . ' <a href="deleteAdvertise/' . $comp->id . '"'
                        . ' class="delete hidden-xs hidden-sm" title="Delete"'
                        . 'onclick=\'return confirm( "Are you sure you want to delete this advertise?" )\'>'
                        . '<i class="fa fa-trash text-danger"></i></a>';
                $response['aaData'][$k] = [$comp->id, $comp->advertise_name, $action];
                $k++;
            }
        }

        return response()->json($response);
    }

    /**
     * Function to save advertise details
     * @param void
     * @return array
     */
    public function saveAdvertise(Request $request, $cId = null) {
        if ($request->isMethod('get')) {
            $AdvertiseDetails = "";
            $button = 'Add';
            if (!empty($cId)) {
                $button = 'Update';
                $AdvertiseDetails = Advertise::where(['id' => $cId])->first();
            }
//                        prd($AdvertiseDetails);

            return view('admin.advertise.addAdvertise', ['AdvertiseDetails' => $AdvertiseDetails, 'button' => $button]);
        }
        /* ADD/EDIT COMPANY */
        if ($request->isMethod('post')) {
            $postData = $request->all();
            $cId = ($request->input('savebtn') == 'Update') ? $cId : '';
            $AdvertiseDetails = ($request->input('savebtn') == 'Add') ? new Advertise() : Advertise::where(['id' => $cId])->first();

            $AdvertiseDetails->advertise_name = !empty($postData['advertise_name']) ? $postData['advertise_name'] : $AdvertiseDetails->advertise_name;
            $AdvertiseDetails->description = !empty($postData['description']) ? $postData['description'] : $AdvertiseDetails->description;
            $AdvertiseDetails->url = !empty($postData['url']) ? $postData['url'] : $AdvertiseDetails->url;

            $advertiseLogo = $request->file('advertise_image');
            if (!empty($advertiseLogo)) {
                $logoFileName = upload_admin_images($advertiseLogo, 'advertise');
                if (!empty($logoFileName)) {
                    $AdvertiseDetails->advertise_image = $logoFileName;
                }
            }

            if (($request->input('savebtn') == 'Add')) {
                $AdvertiseDetails->created_at = date('Y-m-d H:i:s');
                $AdvertiseDetails->save();
                set_flash_message('Advertise Added Successfully.', 'alert-success');
            } else {
                $AdvertiseDetails->updated_at = date('Y-m-d H:i:s');
                $AdvertiseDetails->update();
                set_flash_message('Advertise Updated successfully', 'alert-success');
            }
            return redirect('admin/companies');
        }
    }

    /**
     * Function to fetch the selected Advertise details
     * @param void
     * @return array
     */
    public function getAdvertiseDetails(Request $request) {
        $advertiseId = $request->input('advertiseId');
        $advertiseDetails = Advertise::find($advertiseId);
        return response()->json($advertiseDetails);
    }

    /**
     * Function to delete Advertise
     * @param void
     * @return array
     */
    public function deleteAdvertise(Request $request, $advertiseId) {
        $advertise = Advertise::find($advertiseId);
        if ($advertise->delete()) {
            $response['resCode'] = 0;
            $response['resMsg'] = 'advertise deleted successfully';
        } else {
            $response['resCode'] = 2;
            $response['resMsg'] = 'Internal server error';
        }
        return redirect('admin/companies');
    }

}
