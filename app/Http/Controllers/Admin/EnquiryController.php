<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\EnquiryDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use DB;
use Redirect;
use Hash;
use DataTables;

class EnquiryController extends Controller {

    /**
     * List all the registered user on admin Panel
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.enquirylist');
    }

    /**
     * Fetch all the users from database table.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchEnquiry(Request $request, $type = null) {
        $input = $request->all();
        $start = !empty($input['iDisplayStart']) ? $input['iDisplayStart'] : '';
        // Offset
        $length = !empty($input['iDisplayLength']) ? $input['iDisplayLength'] : '';
        // Limit
        $sSearch = !empty($input['sSearch']) ? $input['sSearch'] : '';
        // Search string
        $col = !empty($input['iSortCol_0']) ? $input['iSortCol_0'] : 0;
        // Column number for sorting
        $sortType = !empty($input['sSortDir_0']) ? $input['sSortDir_0'] : '';
        $where = '';

        // Datatable column number to table column name mapping
        $arr = array(
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'mobile_no',
            4 => 'message',
            5 => 'created_at',
        );

        $sortBy = $arr[$col];
        // Get the records after applying the datatable filters
        $Enquiry = EnquiryDetail::where('name', 'like', '%' . $sSearch . '%')
                ->where('id', '!=', 1);

        $Enquiry = $Enquiry->orderBy($sortBy, $sortType)
                ->limit($length)
                ->offset($start)
                ->get();

        $iTotal = EnquiryDetail::where('name', 'like', '%' . $sSearch . '%');

        $iTotal = $iTotal->count();
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k = 0;
        if (count($Enquiry) > 0) {
            foreach ($Enquiry as $enquiry) {
                $response['aaData'][$k] = [$k + 1, $enquiry->name, $enquiry->email, $enquiry->mobile_no, $enquiry->message, $enquiry->pickup_location, $enquiry->pickup_date, $enquiry->dropping_location, $enquiry->drop_date, $enquiry->status, $enquiry->created_at];
                $k++;
            }
        }
        return response()->json($response);
    }

}
