<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use DB;
use Redirect;
use Hash;
use DataTables;

class UserController extends Controller {

    /**
     * List all the registered user on admin Panel
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($type = null) {
        if (Auth::check()) {
            return view('dashboard.user_list', ['type' => $type]);
        }
        return redirect('dashboard/login');
    }

    /**
     * Fetch all the users from database table.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetchUsers(Request $request, $type = null) {
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
            //2 => 't1.username',
            2 => 'email',
            3 => 'mobile_no',
            4 => 'gender',
            5 => 'created_at',
        );

        $role_id = ( $type == 'student' ) ? 4 : 2;

        $sortBy = $arr[$col];
        // Get the records after applying the datatable filters
        $users = User::where('name', 'like', '%' . $sSearch . '%')
                ->where('id', '!=', 1);
        if (!empty($type)) {
            $users = $users->where('role_id', $role_id);
        }
        $users = $users->orderBy($sortBy, $sortType)
                ->limit($length)
                ->offset($start)
                ->get();

        $iTotal = User::where('name', 'like', '%' . $sSearch . '%');
        if (!empty($type)) {
            $iTotal = $iTotal->where('role_id', $role_id);
        }
        $iTotal = $iTotal->count();
        $response = array(
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iTotal,
            'aaData' => array()
        );

        $k = 0;
        if (count($users) > 0) {
            foreach ($users as $user) {
                $type = ( $user->role_id == 2 ) ? 'User' : 'User';
                $imgFolder = ( $user->role_id == 2 ) ? 'user' : 'users';
                $img = !empty($user->avatar) ? "public/sites/images/$imgFolder/$user->id/$user->avatar" : 'public/sites/images/dummy.jpg';
                $email_verified_at = !empty($user->email_verified_at) ? "<span style='color:green'>Verified</span>" : "<span style='color:red'>Not Verified</span>";
                $Role = getRoleNameById($user->role_id);
                $src = '<img src="' . url($img) . '"  height="50" width="50"> ';
                $action = '<a href="user/edit/' . $user->id . '" '
                        . 'class="delete hidden-xs hidden-sm" title="Edit">'
                        . '<i class="fa fa-edit text-warning"></i></a> &nbsp;'
                        . ' <a href="user/destroy/' . $user->id . '"'
                        . ' class="delete hidden-xs hidden-sm" title="Delete"'
                        . 'onclick=\'return confirm( "Are you sure you want to delete this subscription?" )\'>'
                        . '<i class="fa fa-trash text-danger"></i></a>';

                $response['aaData'][$k] = [$k + 1, $src, $user->name, $user->email, $user->mobile_no, $Role, $user->gender, $email_verified_at, $user->created_at, $action];
                $k++;
            }
        }
        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request) {
        if (Auth::check()) {
            /*if(!checkIfUserSubscribed(Auth::user()->id))
            {
                return redirect('subscription');
            }*/
            $id = getUser_Detail_ByParam('id');
            if ($request->isMethod('get')) {
//            prd($userDetails);
                return view('dashboard.adduser', ['userData' => getUserDetailsById($id), 'id' => $id]);
            }
            if (!empty($_POST)) {
                $response = [];
                $userDetails = $request->all();
                $this->validate($request, [
                        //'email' => 'required|string|email|max:255|unique:users,email,' . Auth::user()->id . ',id',
                ]);
                $User = User::where(['id' => $id])->first();

                $User->name = $userDetails['fname'] ? $userDetails['fname'] . ' ' . $userDetails['lname'] : $User->name;
                $User->fname = $userDetails['fname'] ? $userDetails['fname'] : $User->fname;
                $User->lname = $userDetails['lname'] ? $userDetails['lname'] : $User->lname;
                $User->email = $userDetails['email'] ? $userDetails['email'] : $User->email;
                $User->mobile_no = $userDetails['phone'] ? $userDetails['phone'] : $User->mobile_no;
                $User->address = $userDetails['address'] ? $userDetails['address'] : $User->address;
                $User->gender = $userDetails['gender'] ? $userDetails['gender'] : $User->gender;
                $User->company_name = $userDetails['company_name'] ? $userDetails['company_name'] : $User->company_name;
                $User->company_registration_number = $userDetails['company_registration_number'] ? $userDetails['company_registration_number'] : $User->company_registration_number;
                $User->truck_number = $userDetails['truck_number'] ? $userDetails['truck_number'] : $User->truck_number;
                //$User->dob = $userDetails['years'] ? $userDetails['years'] . '-' . $userDetails['months'] . '-' . $userDetails['days'] : $User->dob;
                $User->website_url = @$userDetails['website_url'] ? @$userDetails['website_url'] : $User->website_url;

                if ($file = $request->hasFile('user_image')) {
                    $file = $request->file('user_image');
                    $User->avatar = upload_site_images($userDetails['user_id'], $file, 'users');
                }
//            prd($User);
                $User->updated_at = date('Y-m-d H:i:s');
                if ($User->save()) {
                    set_flash_message('User updated successfully', 'alert-success');
                    return redirect("/profile");
                }
            }

            return view('dashboard.adduser', ['userData' => getUserDetailsById($id), 'id' => $id]);
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            $user = User::findOrFail($id);
            $destinationPath = public_path('/images/users');
            if (file_exists($destinationPath . '/' . $user->avatar)) {
                @unlink($destinationPath . '/' . $user->avatar);
            }
            $user->delete();
            return Redirect::back()->with('success', 'User Deleted Successfully');
        } catch (Exception $ex) {
            return Redirect::back()->with('error', 'Some error occur!! Please try again.');
        }
    }

    //Fetch Student List Datables Ajax Request

    public function fetchesUsers(Request $request) {

        $usersQuery = [];
        $usersQuery = User::query();
        $usersQuery->select('id', 'fname', 'lname', 'avatar', 'email', 'address', 'phone', 'gender')->where('role_id', 2);
        $users = $usersQuery->select('*');
        return DataTables::of($users)->make(true);
    }

}
