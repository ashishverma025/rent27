<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use App\EnquiryDetail;
use App\ContactDetail;
use App\Review;
use App\Complaint;
use App\User;
use Auth,
    DB,
    Hash,
    Session;
use DataTables;

class AjaxController extends Controller {

    public function saveReview(Request $request) {
        $postData = $request->all();
        $user_id = getUser_Detail_ByParam('id');
        $ReviewDetail = new Review();
        $ReviewDetail->user_id = $user_id ? $user_id : $ReviewDetail->user_id;
        $ReviewDetail->truck_id = $postData['truck_id'] ? $postData['truck_id'] : $ReviewDetail->truck_id;
        $ReviewDetail->name = $postData['name'] ? $postData['name'] : $ReviewDetail->name;
        $ReviewDetail->email = $postData['email'] ? $postData['email'] : $ReviewDetail->email;
        $ReviewDetail->description = $postData['description'] ? $postData['description'] : $ReviewDetail->description;
        $ReviewDetail->rating = $postData['rating'] ? $postData['rating'] : $ReviewDetail->rating;
        $ReviewDetail->created_at = date('Y-m-d H:i:s');

        if ($ReviewDetail->save()) {
            return 'success';
        }
    }

    public function saveComplaint(Request $request) {
        $postData = $request->all();
        $user_id = getUser_Detail_ByParam('id');
        $ComplaintDetail = new Complaint();
        $ComplaintDetail->user_id = $user_id ? $user_id : $ComplaintDetail->user_id;
        $ComplaintDetail->truck_id = $postData['truck_id'] ? $postData['truck_id'] : $ComplaintDetail->truck_id;
        $ComplaintDetail->title = $postData['title'] ? $postData['title'] : $ComplaintDetail->title;
        $ComplaintDetail->description = $postData['description'] ? $postData['description'] : $ComplaintDetail->description;
        $ComplaintDetail->created_at = date('Y-m-d H:i:s');

        if ($ComplaintDetail->save()) {
            return 'success';
        }
    }

}
?>

