<?php
namespace App\Http\Controllers\Auth;
use Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserMail;
use Illuminate\Http\Request;
use Response;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use App\Mail\VerifyMail;
use Illuminate\Support\Str;

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
        'role_id' => @$data['role_id'],
        'company_name' => @$data['company_name'],
        'truck_number' => @$data['truck_number'],
        'company_registration_number' => @$data['company_registration_number'],
        'verifyTocken' => $data['verifyTocken'],
        'mobile_no' => $data['mobile_no'],
      ]);
    }

    public function register(Request $request) {
        $postData = $request->all();
        $password = $postData['password'];
        $email = $postData['email'];

        $messages = [
          'email.email'=>'',
          'email.unique'=>'This Email Id has already been taken','email.required'=>'This field is required',
          'email.regex' => 'This email id is not valid.',
          'password.regex'=>'It should be minimum of 8 characters long with the combinations of 1 special char, 1 number,1 uppercase and 1 lowercase letter.',
          'password.confirmed' => '',
          'password.required'=>'This field is required',
          'password.min' => 'Atleast 8 character is required',
          'password_confirmation.required' => 'This field is required',
          'password_confirmation.same' => 'Password and confirm password must be same',
          'termscond.required'=>'Please select Terms & conditions',
          'mobile_no.required'=>'This field is required',
          'mobile_no.min'=>'',

        ];
        $validator = Validator::make($request->all(), [
            'role_id' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'termscond'=>'required',
            // 'mobile_no' => 'required|numeric|min:10',
            'email' => 'required|email|unique:users|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password' => 'required|string|min:8|regex:/^.*(?=.{3,})(?=.*[A-Z][a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#@%*.&%+-]).*$/|confirmed',
            'password_confirmation' => 'required|same:password',
            'company_name' => !empty(@$postData['company_name'])?'required':'',
            'company_registration_number' => !empty(@$postData['company_registration_number'])?'required':'',
        ],$messages);

        if ($validator->fails())
        {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
        
            ), 200);
        }

        if ($validator->passes()) {
            $requestData = $request->all();
            $requestData['verifyTocken'] = Str::random(40);
            event(new Registered($user = $this->create($requestData)));
            $user_id = $user->id;
            $email = $user->email;
            $pass_for_auth = $user->password;
      			$post = array('password' => $pass_for_auth, 'email' => $email);
      			$res['resCode'] = 0;
            $data = [];
            $data['verify_token'] = $requestData['verifyTocken'];
            $data['name']         = $user->fname." ".$user->lname;
            $data['email']        = $email;
            $data['id']           = $user->id;
            Mail::to($email)->send(new VerifyMail($data));
            $res['resMsg'] = 'Congratulations ! you have registered successfully Please activate by a link send to your email';
            return response()->json(['resCode'=>$res['resCode'], 'resMsg' => $res['resMsg']]);
        }

      }


    public function verifyEmail($email, $verify_token)
    {
      $userData = User::where('email', $email)->first();
      if($userData != NULL || !empty($userData))
      {
        if($userData->verifyTocken === $verify_token)
        {
          User::where('email', $userData->email)->update(
            ['verifyTocken' => NULL, 'status' => 1, 'email_verified_at' => date('yyyy-mm-dd h:i:s')]
          );
          Auth::login($userData);
          return "Your Email is verified successfully.<br><a href='https://www.emptytruck100.com/'>Go to website.</a>";
        }
        return "User Not Found";
      }
      else
      {
        return "User Not Found";
      }
    }

}
