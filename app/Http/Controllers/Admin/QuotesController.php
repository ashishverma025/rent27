<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Getquote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use DB;
use Redirect;
use Hash;
use DataTables;

class QuotesController extends Controller {

    /**
     * List all the registered user on admin Panel
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.quotelist');
    }

    /**
     * Fetch all the users from database table.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchQuotes(Request $request, $type = null) {
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
            1 => 'Name',
            2 => 'Email',
            3 => 'Mobile',
            4 => 'Message',
            5 => 'PickingUpLocation',
            6 => 'Dropping_Off_Location',
            7 => 'PickingUpDate',
            8 => 'DroppingOffDate',
            9 => 'created_at',
        );

        $sortBy = $arr[$col];
        // Get the records after applying the datatable filters
        $Quote = Getquote::where('Name', 'like', '%' . $sSearch . '%')
                ->where('id', '!=', 1);

        $Quote = $Quote->orderBy($sortBy, $sortType)
                ->limit($length)
                ->offset($start)
                ->get();

        $iTotal = Getquote::where('Name', 'like', '%' . $sSearch . '%');

        $iTotal = $iTotal->count();
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k = 0;
        if (count($Quote) > 0) {
            foreach ($Quote as $Quote) {
                $img = !empty($Quote->quote_image) ? "storage/uploads/quotesImage/$Quote->quote_image" : 'public/sites/images/dummy.jpg';
                $src = '<a href="'.url($img).'" target="_blank"><img src="' . url($img) . '"  height="50" width="50"></a>';
                $response['aaData'][$k] = [$k + 1, $Quote->Name, $Quote->Email, $src , $Quote->Mobile, $Quote->Message, $Quote->PickingUpLocation, $Quote->Dropping_Off_Location, $Quote->PickingUpDate, $Quote->DroppingOffDate, $Quote->Status, $Quote->created_at];
                $k++;
            }
        }
        return response()->json($response);
    }

}
