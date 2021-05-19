<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;

use App\User;
use App\TrustswiftlyDocverification;
use Auth,
    DB,
    Hash,
    Session;
use DataTables;
use Log;


class TrustSwiftlyController extends Controller {

    public function index() {
        $swiftUserClientToken = "";
        $baseUrl = "https://emptytruck100.trustswiftly.com";
        if (Auth::check()) {
            $userDetails = getUserDetails();
            $tsDoc = TrustswiftlyDocverification::select('createuser_data')->where('user_id',$userDetails->id)->first();
            if(!empty($tsDoc)){
                $createUserData = !empty($tsDoc) ? json_decode($tsDoc->createuser_data) : '';
                $swiftUserClientToken = isset($createUserData->token)?$createUserData->token:"";
            }else{
                $this->createTrustSwiftlyUser($userDetails);
            }

            // $this->authenticateTrustSwiftly();
            // $this->updateTrustSwiftlyUser(4);
            // $this->deleteTrustSwiftlyUser(4);
            // $this->createTrustSwiftlyUserToken(5);
        }
        return view('sites.documentVerification',['clientToken'=>$swiftUserClientToken,'baseUrl'=>$baseUrl,'userDetails'=>@$userDetails]);
    }


    public function trustWebhook(Request $request) {
        $resData = $request->all();
        $trustId = isset($resData->trust_id)?$resData->trust_id:$resData['trust_id'];
        Log::info('webhook :'.json_encode($resData));

        $TrustUser = TrustswiftlyDocverification::where('trust_id',$trustId)->first();
        if (!empty($TrustUser)) {
            $TrustUser->docverifyresponse_data = $request->all();
            $TrustUser->updated_at = date('Y-m-d H:i:s');
            $TrustUser->update();
        }else{
            return redirect('logout');
        }
    }
    
    public function authenticateTrustSwiftly(){
        $url = 'https://emptytruck100.trustswiftly.com/account/api/users';
        
        $headers = array(
            "Accept: application/json",
            "User-Agent:TrustSwiftly/1.0",
            "Content-Type: application/json",
            "Authorization: Bearer 3|anLxGRylpRNL92hlJo5QNVznVrxjvCmIGoabAXQC",
         );

           $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL, $url);
           curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      
           $response = curl_exec ($ch);
           $err = curl_error($ch);  //if you need
           curl_close ($ch);
           return $response;
    }


    public function createTrustSwiftlyUser($userDetails){
        $url = 'https://emptytruck100.trustswiftly.com/account/api/users';
        
        $headers = array(
            "Accept: application/json",
            "User-Agent:TrustSwiftly/1.0",
            "Content-Type: application/json",
            "Authorization: Bearer 3|anLxGRylpRNL92hlJo5QNVznVrxjvCmIGoabAXQC",
         );
            $data =  json_encode(['email' => $userDetails->email,"first_name"=> $userDetails->fname,"last_name"=> $userDetails->lname,"template_id"=> 1]);
           $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL, $url);
           curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
           curl_setopt($ch, CURLOPT_POST, true);
           curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


           $response = curl_exec ($ch);
           curl_close ($ch);
        //    prd($response);
           return $response;
    }

    public function updateTrustSwiftlyUser($uId){
        $url = "https://veemptytruck100.trustswiftly.com/account/api/users/$uId";
        
        $headers = array(
            "Accept: application/json",
            "User-Agent:TrustSwiftly/1.0",
            "Content-Type: application/json",
            "Authorization: Bearer 1|anNMTWFJ7bVOpQec5X80lz7doNh5KypozWUoS1v4",
         );
           $data =  json_encode(["first_name"=> "Test","last_name"=> "User","template_id"=> 3]);

           $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL, $url);
           curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
           curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
           curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

           $response = curl_exec ($ch);
           curl_close ($ch);
           prd($response);
           return $response;
    }

    public function deleteTrustSwiftlyUser($uId){
        $url = "https://veemptytruck100.trustswiftly.com/account/api/users/$uId";
        
        $headers = array(
            "Accept: application/json",
            "User-Agent:TrustSwiftly/1.0",
            "Content-Type: application/json",
            "Authorization: Bearer 1|anNMTWFJ7bVOpQec5X80lz7doNh5KypozWUoS1v4",
         );
           $data =  json_encode([]);

           $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL, $url);
           curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
           curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
           curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

           $response = curl_exec ($ch);
           curl_close ($ch);
           prd(json_decode($response));
           return $response;
    }


    public function createTrustSwiftlyUserToken($uId){
        $url = "https://emptytruck100.trustswiftly.com/account/api/users/$uId/token";
        
        $headers = array(
            "Accept: application/json",
            "User-Agent:TrustSwiftly/1.0",
            "Content-Type: application/json",
            "Authorization: Bearer 3|anLxGRylpRNL92hlJo5QNVznVrxjvCmIGoabAXQC",
         );
           $data =  json_encode([]);
           $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL, $url);
           curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
           curl_setopt($ch, CURLOPT_POST, true);
           curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


           $response = curl_exec ($ch);
           curl_close ($ch);
           pr($response);
           return $response;
    }

    public function deleteTrustSwiftlyUserToken($uId){
        $url = "https://veemptytruck100.trustswiftly.com/account/api/users/$uId/token";
        
        $headers = array(
            "Accept: application/json",
            "User-Agent:TrustSwiftly/1.0",
            "Content-Type: application/json",
            "Authorization: Bearer 1|anNMTWFJ7bVOpQec5X80lz7doNh5KypozWUoS1v4",
         );
           $data =  json_encode([]);

           $ch = curl_init();
           curl_setopt($ch, CURLOPT_URL, $url);
           curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
           curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
           curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

           $response = curl_exec ($ch);
           curl_close ($ch);
           prd(json_decode($response));
           return $response;
    }

}
?>

