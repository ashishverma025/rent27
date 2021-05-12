<?php 
namespace App\Http\Controllers; 
use Illuminate\Http\Request; 
use DB; 
use Carbon\Carbon; 
use Mail;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function getEmail()
    {
        return view('customauth.passwords.email');
    }
    
    public function postEmail(Request $request)
    {
        // Setup the validator
        $rules = array('email' => 'required|email|exists:users');
        $validator = Validator::make($request->all(), $rules);
        
        // Validate the input and return correct response
        if ($validator->fails())
        {
            return response()->json(['error'=>$validator->errors()->all()], 200);
        }
        
        $token = $this->quickRandom(64);
        
        $insertedData = DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);
        
        if($insertedData)
        {
            Mail::send('Verifyemail', ['token' => $token], function($message) use($request){
                $message->from('uaugh177@gmail.com', 'EMPTYTRUCK');
                $message->to($request->email);
                $message->subject('Reset Password Notification');
            });
            if (Mail::failures()) {
                return response()->json([
                    'status'  => 'error',
                    'message' => 'Some error occurred in sending Mail.'
                ]);
            }
            return response()->json([
                'status'  => 'success',
                'message' => 'Email verification link has been successfully sent to your mail address.'
            ]);
        }
        return response()->json([
            'status'  => 'error',
            'message' => 'Some error occurred in Reset Password.'
        ]);
    }
    
    public static function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }

}