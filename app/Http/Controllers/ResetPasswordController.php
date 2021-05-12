<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB; use App\User;
use Hash;

class ResetPasswordController extends Controller {

  public function getPassword($token) { 
    return view('reset', ['token' => $token]);
  }

  public function updatePassword(Request $request)
  {
    $request->validate([
      'email' => 'required|email|exists:users',
      'password' => 'required|min:6|confirmed',
      'password_confirmation' => 'required',
    ]);
    
    $updatePassword = DB::table('password_resets')
    ->where(['email' => $request->email, 'token' => $request->reset_token])
    ->first();
    
    if($updatePassword == null)
    {
      return back()->withInput()->with('error', 'Invalid token!');
    }

    $user = User::where('email', $request->email)
    ->update(['password' => Hash::make($request->password)]);
    if($user)
    {
      if(DB::table('password_resets')->where(['email'=> $request->email])->delete())
      {
        return back()->withInput()->with('success', 'Your password has been changed.');
      }
      return back()->withInput()->with('error', 'Sorry! some error occurred.');
    }
    return back()->withInput()->with('error', 'Sorry! password not updated.');
  }
  
}