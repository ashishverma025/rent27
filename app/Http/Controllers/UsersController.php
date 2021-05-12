<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use App\EnquiryDetail;
use App\ContactDetail;
use App\User;
use Auth,
    DB,
    Hash,
    Session;
use DataTables;

class UsersController extends Controller {

    public function saveEnquiry(Request $request) {
        $postData = $request->all();

        $EnquiryDetail = new EnquiryDetail();
        $EnquiryDetail->name = $postData['name'] ? $postData['name'] : $EnquiryDetail->name;
        $EnquiryDetail->email = $postData['email'] ? $postData['email'] : $EnquiryDetail->email;
        $EnquiryDetail->mobile_no = $postData['mobile_no'] ? $postData['mobile_no'] : $EnquiryDetail->mobile_no;
        $EnquiryDetail->message = $postData['message'] ? $postData['message'] : $EnquiryDetail->message;
        $EnquiryDetail->pickup_location = $postData['pickup_location'] ? $postData['pickup_location'] : $EnquiryDetail->pickup_location;
        $EnquiryDetail->pickup_date = $postData['pickup_date'] ? $postData['pickup_date'] : $EnquiryDetail->pickup_date;
        $EnquiryDetail->dropping_location = $postData['dropping_location'] ? $postData['dropping_location'] : $EnquiryDetail->dropping_location;
        $EnquiryDetail->drop_date = $postData['drop_date'] ? $postData['drop_date'] : $EnquiryDetail->drop_date;
        $EnquiryDetail->created_at = date('Y-m-d H:i:s');

        $request->session()->put('findTruck', $postData);
        $sessionData = $request->session()->get('findTruck');

//        prd($sessionData);
//        prd($sessionData);
        if ($EnquiryDetail->save()) {
            $queryString = "";
            $query = $request->query();
            if (!empty($query)) {
                $queryString = "_token=" . $query['_token'] . "&name=" . $query['name'] . "&email=" . $query['email'] . "&mobile_no=" . $query['mobile_no'] . "&message=" . $query['message'] . "&pickup_location=" . $query['pickup_location'] . "&pickup_date=" . $query['pickup_date'] . "&dropping_location=" . $query['dropping_location'] . "&drop_date=" . $query['drop_date'] . "";
            }
            return redirect("/listing/truck?$queryString");
        }
    }

    public function createUser($postData, $lastInsertId, $userId) {
        $User = new User();
        $User->name = $postData['first_name'] ? $postData['first_name'] . ' ' . $postData['surname'] : $User->name;
        $User->fname = $postData['first_name'] ? $postData['first_name'] : $User->fname;
        $User->lname = $postData['surname'] ? $postData['surname'] : $User->lname;
        $User->password = Hash::make('wippli@123');
        $User->email = $postData['email'] ? $postData['email'] : $User->email;
        $User->phone = $postData['phone'] ? $postData['phone'] : $User->phone;
        $User->address = $postData['address1'] ? $postData['address1'] : $User->address;
        $User->contact_id = $lastInsertId;
        $User->user_type = 5;
        $User->email_verified_at = date('Y-m-d H:i:s');
        $User->created_at = date('Y-m-d H:i:s');

        // prd( $postData );
        if ($User->save()) {
            return $User->id;
        } else {
            return 'error';
        }
    }

    public function editprofile(Request $request, $LcId = null) {
        if (Auth::check()) {
            if ($LcId == getUser_Detail_ByParam('id')) {
                $profileDetails = getUserDetails();
                $imgFolder = ( $profileDetails->user_type == 4 ) ? 'student' : 'tutor';
                $disabled = ( $profileDetails->verifyOtp == 'verified' ) ? 'disabled' : '';
                $dob = ( $profileDetails->dob == 'verified' ) ? explode('-', $profileDetails->dob) : '';
                $years = @$dob[0];
                $months = @$dob[1];
                $days = @$dob[2];
                $phoneValidate = !empty($profileDetails->verifyOtp) ? ( $profileDetails->verifyOtp == 'verified' ? 'validate' : 'notvalidate' ) : '';

                if (!empty($LcId)) {
                    $userType = getUser_Detail_ByParam('user_type');
                    $view = ( $userType == 4 ) ? 'sites.edit_profile' : 'sites.updateProfile';
                    return view($view, ['tutorId' => $LcId, 'active' => 'editprofile', 'imgFolder' => $imgFolder, 'disabled' => $disabled, 'phoneValidate' => $phoneValidate]);
                } else {
                    return view('error404');
                }
            } else {
                return view('error404');
            }
        }
        return redirect('/');
    }

    public function viewProfile(Request $request) {
        if (Auth::check()) {
            $profileDetails = getUserDetails();
            $imgFolder = ( $profileDetails->user_type == 4 ) ? 'student' : 'tutor';

            $userType = getUser_Detail_ByParam('user_type');
            //                    $view = ( $userType == 4 ) ? 'sites-student.userProfile' : 'sites.updateProfile';
            $view = 'sites-student.userProfile';
            return view($view, ['active' => 'userProfile', 'imgFolder' => $imgFolder, 'userDetails' => $profileDetails]);
        }
        return redirect('/');
    }

    public function changeCoverBanner(Request $request) {
        if (Auth::check()) {

            $profileDetails = getUserDetails();

            $imgFolder = 'CoverBanner';
            $userId = getUser_Detail_ByParam('id');

            $User = User::where(['id' => $userId])->first();
            //            prd( $User );
            if ($file = $request->hasFile('cover_image')) {
                $file = $request->file('cover_image');
                $User->cover_image = upload_site_images($userId, $file, $imgFolder);
                if ($User->update()) {
                    $response['resCode'] = 200;
                    $response['resMsg'] = 'Cover Image updated successfully';
                    set_flash_message('Cover Image updated successfully', 'alert-success');
                } else {
                    $response['resCode'] = 500;
                    $response['resMsg'] = 'Internal server error';
                    set_flash_message('Internal server error.', 'alert-danger');
                }
                return response()->json($response);
            }
        }
    }

    /**
     * Function to update user profile
     * @param void
     * @return array
     */
    public function updateProfile(Request $request) {
        // Get the formData
        $userDetails = $request->post();
        $response = [];
        $image = $request->file('profile_image');

        $this->validate($request, [
                //'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id . ',id',
        ]);

        if (!empty($userDetails['user_id'])) {
            // Existing record, update it
            $User = User::where(['id' => $userDetails['user_id']])->first();
            $imgFolder = ( $User->user_type == 4 ) ? 'student' : 'tutor';
            $User->name = $userDetails['fname'] . ' ' . $userDetails['lname'];
            //            $User->username = $userDetails['fname'] . '_' . $userDetails['lname'];
            $User->fname = $userDetails['fname'];
            $User->lname = $userDetails['lname'];
            $User->alternatephone = $userDetails['alternatephone'];
            $User->phone = ( $User->verifyOtp != 'verified' ) ? @$userDetails['contact'] : $User->phone;
            $User->address = $userDetails['address'];
            $User->gender = $userDetails['gender'];
            $User->dob = $userDetails['years'] . '-' . $userDetails['months'] . '-' . $userDetails['days'];
            $User->updated_at = date('Y-m-d H:i:s');
            //            pr( $request->file( 'user_image' ) );
            //            prd( $userDetails );
            if ($file = $request->hasFile('user_image')) {
                $file = $request->file('user_image');
                $User->avatar = upload_site_images($userDetails['id'], $file, $imgFolder);
            }

            if ($User->update()) {
                $response['resCode'] = 0;
                $response['resMsg'] = 'Profile updated successfully';
                set_flash_message('Profile updated successfully.', 'alert-success');
            } else {
                $response['resCode'] = 2;
                $response['resMsg'] = 'Internal server error';
                set_flash_message('Internal server error.', 'alert-danger');
            }
        }
        return response()->json($response);
    }

    public function rate_saler() {

        $user = DB::table('users')->where('id', 7)->first();
        //echo '<pre>';
        print_r($user->id);
        die;
        return view('ratesaller', compact('user'));
    }

    //GET TUTOR STUDENTS LIST POST REQUEST

    public function isEmailExist(Request $request) {
        $response = [];
        $postData = $request->post();
        $email_id = $postData['email'];
        return is_email_exist($email_id);
    }

    public function change_pwd() {
        return view('sites.change_pwd');
    }

    public function update_changed_pwd(Request $request) {
        $this->validate($request, [
            'current-password' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $request_data = $request->All();
        $current_password = Auth::User()->password;

        if (Hash::check($request_data['current-password'], $current_password)) {
            $user_id = Auth::User()->id;
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make($request_data['password']);
            $obj_user->save();
            return redirect()->back()->with('success', 'Password changed successfully!');
        } else {
            return redirect()->back()->with('error', 'Please enter correct current password');
        }
    }

    //GET TUTOR STUDENTS LIST POST REQUEST

     public function emailverify(Request $request, $userId) {
		
        $res = is_email_verified($userId);
        if (!empty($userId)) {
            //TUTOR STUDENTS MAP DATA SAVE
              
                    $user = User::where(['id' => $userId])->first();
                    $user->email_verified_at = date('Y-m-d H:i:s');
                    $user->update();
                    set_flash_message('Your e-mail is verified. You can now login', 'alert-success');
                    return redirect('/login');
             }
            return view('error404');
        }

    public function sendOtp(Request $request) {
        $postData = $request->post();

        $mobile = $postData['phone'];
        $response = response()->json(['Status' => 'Error', 'Details' => 'Please enter valid mobile number']);
        if (!empty($mobile)) {
            $api = '2e04c982-5863-11ea-9fa5-0200cd936042';
            $otp = rand(111111, 999999);
            $userId = getUser_Detail_ByParam('id');
            $user = User::where(['id' => $userId])->first();
            $user->verifyOtp = $otp;
            if ($user->verifyOtp != 'verified') {
                //                prd( $user->verifyOtp );
                $url = "https://2factor.in/API/V1/$api/SMS/+91$mobile/$otp";
                $response = json_decode(file_get_contents($url), true);
            }
            $user->update();
        }
        return $response;
    }

    public function validateOtp(Request $request) {
        $postData = $request->post();
        $response = response()->json(['Status' => 'Error', 'Details' => 'OTP Mismatch']);

        $otp = $postData['otp'];
        if (!empty($otp)) {
            $userId = getUser_Detail_ByParam('id');
            $user = User::where(['id' => $userId])->first();
            if ($user->verifyOtp == $otp) {
                $user->verifyOtp = 'verified';
                $user->update();
                //            prd( $user );
                $response = response()->json(['Status' => 'Success', 'Details' => 'OTP Matched']);
            }
        }
        return $response;
    }

}
?>

