<?php
namespace App\Http\Controllers\Auth;
use Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserMail;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Auth\Events\Registered;
use Redirect;
class RegisterController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'fname' => ['required', 'string', 'max:255'],
                    'lname' => ['required', 'string', 'max:255'],
//                    'city' => ['required', 'string', 'max:255'],
//                    'state' => ['required', 'string', 'max:255'],
//                    'country' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    //'dob' => ['required', 'string', 'max:255'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {
         //prd($data);
        return User::create([
                    'fname' => $data['fname'],
                    'lname' => $data['lname'],
                    'name' => $data['fname'] . ' ' . $data['lname'],
                    'email' => $data['email'],
					 'password' => Hash::make($data['password']),
					 'country' => @$data['country'],
                    //'address' => @$data['address'],
                    //'city' => @$data['city'],
                    //'state' => @$data['state'],
                   
                    //'dob' => @$data['dob'],
                    'role_id' => @$data['role_id'],
                   
        ]);
    }

    public function register(Request $request) {
        $postData = $request->all();
        // prd($postData);
    	  
    	  $password = $postData['password'];
        $email = $postData['email'];
        /*$isExist = is_email_exist($email);
        if ($isExist['status'] == 'exist') {
            $res['resCode'] = 1;
            $res['resMsg'] = 'This email has already been taken';
            return $res;
        }*/

        //$this->validator($request->all())->validate();
        $validator = Validator::make($request->all(), [
            'role_id' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);
        if ($validator->passes()) {
            event(new Registered($user = $this->create($request->all())));
            $this->guard()->login($user);
            $res['resCode'] = 0;
            $data = [];
            $data['name'] = $email;
            $data['message'] =$password;
            $data['id']=$user->id;
            Mail::to($email)->send(new UserMail($data));
            
            $res['resMsg'] = 'Congratulations ! you have registered successfully Please activate by a link send to your email';
            return response()->json(['resCode'=>$res['resCode'], 'resMsg' => $res['resMsg']]);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    ///////////////////////////////// SEAMO API REGISTRATION //////////////////////////////////////////

    protected function semovalidator(array $data) {
        // prd($data);
        // return Validator::make($data, [
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        // ]);
    }

    protected function seamocreate(array $data) {
        return User::create([
                    'email' => $data['email'],
                    'email_verified_at' => date('Y-m-d h:i:s'),
                    'password' => Hash::make($data['password']),
        ]);
    }

    public function seomoUserRegister(Request $request) {
        $userData = $request->all();
        $email = $userData['email'];
        $isExist = is_email_exist($email);

        // if ($isExist['status'] == 'exist') {
        //     $res['resCode'] = 1;
        //     $res['resMsg'] = 'This email has already been taken';
        //     return $res;
        // }
        // $this->semovalidator($request->all())->validate();
        // prd($isExist);
        // event(new Registered($user = $this->seamocreate($request->all())));
        // $this->guard()->login($user);
        $password = $userData['password'];
        return redirect("/seomoUserLogin?email=$email&password=$password&remember=no");
    }

}
