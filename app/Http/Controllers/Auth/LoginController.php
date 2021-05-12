<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Response;
use App\User;
use Socialite;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Mail\VerifyMail;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = '/home';
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
	  public function handleProviderCallback(Request $request)
    {
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (Exception $e) {
            return redirect('auth/facebook');
        }
        
        $authUser = $this->findOrCreateUser($user);
        
        Auth::login($authUser, true);
        if (Session::has('role_id_click')) {
            User::where('email', $user->email)->update(['role_id' => Session::get('role_id_click')]);
        }

        return redirect()->route('home');
    }
    public function __construct() {
        $this->middleware('guest')->except('logout');
    }
  public function redirectToTwitter() {
        return Socialite::driver('twitter')->redirect();
    }
    /**
     * Show the login form.
     * 
     * 
     * @return \Illuminate\Http\Response
     */
       public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
	   public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function showLoginForm() {
        return view('auth.login', [
            'title' => 'User Login',
            'loginRoute' => 'login',
            'forgotPasswordRoute' => 'password.request',
        ]);
    }

    protected function username() {
        return 'email';
    }

    public function signIn(Request $request) {
        $credentials = $request->only($this->username(), 'password', 'role_id');
        $messages = array('email.regex' => 'Your email id is not valid.','password.required'=>"This field is required");

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'password' =>  ['required', 'string'],            
        ],$messages);

        if ($validator->fails())
        {
            return Response::json(array(
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ), 200);
        }
        $postData = $request->all();
        $userData = User::select('id', 'name', 'user_type','email_verified_at')->where(['email' => $postData['email']])->first();

        if(empty(@$userData->email_verified_at)){
            // prd($userData);
            return Response::json(array(
                'success' => false,
                'goldUser' => '',
                'message' => 'Please first verified your email',
            ), 200);
        }

        $authSuccess = Auth::attempt($credentials, $request->has('remember'));
        if ($authSuccess) {
            $request->session()->regenerate();
            $goldUser = $userData->user_type == 'Gold' ? TRUE : FALSE;
            set_flash_message('You have login successfully', 'alert-success');
            return response(['success' => true, 'goldUser' => $goldUser, 'message' => 'You have login successfully.']);
        }

        return response([
            'success' => false,
            'message' => 'These credentials do not match our records.'
        ]);
    }

    //////////////////////////////////////////// SEMO LOGIN API //////////////////////////////////////////////////////////
  public function handleTwitterCallback() {
        try {
            $user = Socialite::driver('twitter')->user();
            $finduser = User::where('twitter_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect('/home');
            } else {
                $newUser = User::create(['name' => $user->name, 'email' => $user->email, 'twitter_id' => $user->id]);
                Auth::login($newUser);
                return redirect()->back();
            }
        }
        catch(Exception $e) {
            return redirect('auth/twitter');
        }
    }
    	 public function handleGoogleCallback()
    {
        try {
  
            $user = Socialite::driver('google')->user();
   
            $finduser = User::where('google_id', $user->id)->first();
   
            if($finduser){
   
                Auth::login($finduser);
  
                 return redirect('/home');
   
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id'=> $user->id
                ]);
  
                Auth::login($newUser);
   
                return redirect()->back();
            }
  
        } catch (Exception $e) {
            return redirect('auth/google');
        }
    }
    public function seomoUserLogin(Request $request) {
        if (!empty($request->all())) {
            $data = $request->all();

            if (isset($data['pId']) && isset($data['email']) && !empty($data['pId'])) {
                if (empty(@$data['password'])) {
                    $data['password'] = 12345678;
                }
                // prd($data);
                $paperId = $data['pId'];
                $isUserExist = is_email_exist($data['email']);
                if ($isUserExist['status'] == 'exist') {
                    // prd($isUserExist);

                    $credentials = ['email' => $data['email'], 'password' => $data['password']];
                    $authSuccess = Auth::attempt($credentials, $request->has('remember'));
                    if ($authSuccess) {
                        $request->session()->regenerate();
                        if (!empty($paperId)) {
                            return redirect("/onlinePractice/$paperId");
                        } else {
                            return redirect("/onlinePractice");
                        }
                    }
                } else {
                    $user = new User;
                    $user->email = $email = $data['email'];
                    $user->password = Hash::make($data['password']);
                    $user->email_verified_at = date('Y-m-d h:i:s');
                    $user->save();
                    $pwd = $data['password'];
                    // prd($data);
                    return redirect("/seomoUserLogin?email=$email&password=$pwd&remember=no&pId=$paperId");
                }
            } else {
                return response([
                    'success' => false,
                    'message' => 'These credentials do not match our records.'
                ]);
            }
        }
    }
 private function findOrCreateUser($facebookUser)
    {
        $authUser = User::where('email', $facebookUser->email)->first();

        if ($authUser){
            return $authUser;
        }

        return User::create([
            'name' => $facebookUser->name,
            'email' => $facebookUser->email,
            'facebook_id' => $facebookUser->id,
            'avatar' => $facebookUser->avatar
        ]);
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect('/')->with('status', 'User has been logged out!');
    }

}
