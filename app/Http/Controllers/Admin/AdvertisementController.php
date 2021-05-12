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
use App\Advertisement;
use Validator;
use Mail;

class AdvertisementController extends Controller {

    /**
     * Function to return user advertise page
     * @param void
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin/advertisement/advertisementList');
    }

    /**
     * Function to fetch the advertise listing
     * @param void
     * @return array
     */
    public function fetchAdvertisement(Request $request) {
        $start = $request->input('iDisplayStart');      // Offset
        $length = $request->input('iDisplayLength');     // Limit
        $sSearch = $request->input('sSearch');            // Search string
        $col = $request->input('iSortCol_0');         // Column number for sorting
        $sortType = $request->input('sSortDir_0');         // Sort type
        // Datatable column number to table column name mapping
        $arr = ['id', 'title'];

        // Map the sorting column index to the column name
        $sortBy = $arr[$col];

        // Get the records after applying the datatable filters
        $advertise = Advertisement::where('title', 'like', '%' . $sSearch . '%')
                ->orWhere('title', 'like', '%' . $sSearch . '%')
                ->orderBy($sortBy, 'DESC')
                ->limit($length)
                ->offset($start)
                ->get();

        $iTotal = Advertisement::where('title', 'like', '%' . $sSearch . '%')->orWhere('title', 'like', '%' . $sSearch . '%')->count();

        // Create the datatable response array
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k = 0;
        if (count($advertise) > 0) {
            foreach ($advertise as $blg) {
                $advertiseImage = !empty($blg->advertise_image) ? asset('storage/uploads/advr').'/'.$blg->advertise_image : asset('storage/images') . '/not-available.jpg';
                $action = '<a href="addAdvertisement/' . $blg->id . '" '
                        . 'class="delete hidden-xs hidden-sm" title="Edit">'
                        . '<i class="fa fa-edit text-warning"></i></a> &nbsp;'
                        . ' <a href="deleteAdvertisement/' . $blg->id . '"'
                        . ' class="delete hidden-xs hidden-sm" title="Delete"'
                        . 'onclick=\'return confirm( "Are you sure you want to delete this advertise?" )\'>'
                        . '<i class="fa fa-trash text-danger"></i></a>';
                $response['aaData'][$k] = [$k+1, "<img src='$advertiseImage' height='50' width='50'>", $blg->title,$blg->url,$blg->description,$blg->status, $action];
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
    public function saveAdvertisement(Request $request, $cId = null) {
        if ($request->isMethod('get')) {
            $AdvertisementDetails = "";
            $button = 'Add';
            if (!empty($cId)) {
                $button = 'Update';
                $AdvertisementDetails = Advertisement::where(['id' => $cId])->first();
            }

            return view('admin.advertisement.addAdvertisement', ['AdvertisementDetails' => $AdvertisementDetails, 'button' => $button]);
        }
        /* ADD/EDIT COMPANY */
        if ($request->isMethod('post')) {

            $postData = $request->all();
//            prd($postData);
            $cId = ($request->input('savebtn') == 'Update') ? $cId : '';
            $AdvertisementDetails = ($request->input('savebtn') == 'Add') ? new Advertisement() : Advertisement::where(['id' => $cId])->first();

            $AdvertisementDetails->title = !empty($postData['title']) ? $postData['title'] : $AdvertisementDetails->title;
            $AdvertisementDetails->url = !empty($postData['url']) ? $postData['url'] : $AdvertisementDetails->url;
            $AdvertisementDetails->description = !empty($postData['description']) ? $postData['description'] : $AdvertisementDetails->description;
            $AdvertisementDetails->status = !empty($postData['status']) ? $postData['status'] : $AdvertisementDetails->status;

            $advertiseLogo = $request->file('advertise_image');
            if (!empty($advertiseLogo)) {
                $logoFileName = upload_admin_images($advertiseLogo, 'advr');
                if (!empty($logoFileName)) {
                    $AdvertisementDetails->advertise_image = $logoFileName;
                }
            }

            if (($request->input('savebtn') == 'Add')) {
                $AdvertisementDetails->created_at = date('Y-m-d H:i:s');
                $AdvertisementDetails->save();
                set_flash_message('Advertisement Added Successfully.', 'alert-success');
            } else {
                $AdvertisementDetails->updated_at = date('Y-m-d H:i:s');
                $AdvertisementDetails->update();
                set_flash_message('Advertisement Updated successfully', 'alert-success');
            }
            return redirect('admin/advertisements');
        }
    }

    /**
     * Function to fetch the selected Advertisement details
     * @param void
     * @return array
     */
    public function getAdvertisementDetails(Request $request) {
        $advertiseId = $request->input('advertiseId');
        $advertiseDetails = Advertisement::find($advertiseId);
        return response()->json($advertiseDetails);
    }

    /**
     * Function to delete Advertisement
     * @param void
     * @return array
     */
    public function deleteAdvertisement(Request $request, $advertiseId) {
        $advertise = Advertisement::find($advertiseId);
        if ($advertise->delete()) {
            $response['resCode'] = 0;
            $response['resMsg'] = 'advertise deleted successfully';
        } else {
            $response['resCode'] = 2;
            $response['resMsg'] = 'Internal server error';
        }
        return redirect('admin/advertisements');
    }

}
