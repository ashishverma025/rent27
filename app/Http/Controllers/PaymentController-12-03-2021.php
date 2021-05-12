<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth,
    DB;
use App\NewWippli;
use App\BusinessDetail;
use App\Role;

class PaymentController extends Controller {

    public function __construct() {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function saveTransaction(Request $request) {
        $postData = $request->all();
        prd($postData);
        $userDetails = getUserDetails();
        if ($request->isMethod('post')) {
            $sId = $postData['sId'];
            $transDetails = $postData['details'];
            $amount = $postData['amt'];

            if (!empty($transDetails)) {
                $currency = $postData['cur'];

                $Payment = new Payment();
                $Payment->user_id = $userDetails['id'];
                $Payment->subscription_id = $sId;
                $Payment->transaction_id = $transDetails['id'];
                $Payment->amount = $amount;
                $Payment->currency = $currency;
                $Payment->payment_status = $transDetails['status'];
                $Payment->transaction_time = $transDetails['create_time'];
                $Payment->created_at = date('Y-m-d H:i:s');
                $Payment->save();
            }

            if (!empty($sId)) {
                $subscribers = Subscriber::where(['user_id' => $userDetails['id']])->first();

                $plans = Subscription::where(['id' => $sId])->first();
                if (!empty($plans)) {
                    //BEFORE ADD NEW SUBSCRIBER INACTIVE ALL EXISTING SUBSCRIPTION
                    $duration = '7 days';
                    if (!empty($subscribers)) {
                        DB::table('subscribers')
                                ->where(['user_id' => $userDetails['id']])
                                ->update(['status' => 'inactive']);
                        $duration = $plans['duration'];
                    }
                    $directPaymentId = "";
                    if (empty($transDetails)) {
                        $directPaymentId = $this->directPayment($request, $postData, $userDetails);
                    }
                    $subscribers = new Subscriber();
                    $subscribers->subscription_id = $sId;
                    $subscribers->directpayment_id = !empty($directPaymentId) ? $directPaymentId : "";
                    $subscribers->transaction_id = @$transDetails['id'];
                    $subscribers->payment_id = @$Payment->id;
                    $subscribers->user_id = $userDetails['id'];
                    $subscribers->amount = $amount;
                    $subscribers->payment_status = @$transDetails['status'] ? @$transDetails['status'] : (!empty($directPaymentId) ? 'success' : "failed");
                    $subscribers->start_date = date('Y-m-d');
                    $subscribers->end_date = createDate(date('Y-m-d'), "+" . $duration, 'Y-m-d');
                    $subscribers->created_at = date('Y-m-d H:i:s');
//                        set_flash_message('Congratulation! you have subscribe successfully', 'alert-success');
                    $subscribers->save();
                }
                return 'success';
            }
        }
    }

}
