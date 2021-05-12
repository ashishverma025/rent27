<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Getquote;
use Carbon\Carbon;

class SendEmailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $allGetQuote = "";
        // where order_date > now() - interval 24 hour
        $Getquote = Getquote::where('created_at', '>=', Carbon::now()->subDay())->get()->toArray();
        if (!empty($Getquote)) {
            foreach ($Getquote as $key => $quotes) {
                $allGetQuote .= $quotes['Message'].', ';
            }
        }
        // prd($allGetQuote);

        $allEmail = [];
        $allDrivers = User::select('users.id','users.email')
                    ->join('user_subscriptions as us','us.user_id','users.id')
                    ->where('users.status','1')
                    ->where('users.role_id','!=','3')->where('users.role_id','!=','4')
                    ->get()->toArray();
        if (!empty($allDrivers)) {
            foreach ($allDrivers as $key => $value) {
                $allEmail[$value['id']] = $value['email'];
            }
        }
        // prd($allEmail);
      $data = [];
      $data['username'] = 'All';
      $data['msg'] = $allGetQuote;
      $data['url'] = url('/');
      $data['message'] = '24 hours Quotes records';
      $emails = $allEmail;
      echo "Quotes mail has been successfully send to all drivers and companies on following mail id's <h3>".implode(', ',$allEmail)." </h3>";

    //   $sendMailStatus = sendMail($data, 'EmptyTruck100 ', $emails, 'EmptyTruck100 users quotes. ', "support@emptytruck100.com", 'sendQuotesToDriver');
    }
}
