<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Redis;
use App\User;
use Auth,
    Session,
    DB;
use App\Testimonial;
use App\Advertisement;
use App\Blog;
use App\Faq;
use App\Role;
use App\Truck;
use App\VehicleType;
use App\Review;
use App\Plan;
use App\Complaint;
use App\DealerVehicle;
use App\Getquote;
use App\TrustswiftlyDocverification;
use Redirect;
class WelcomeController extends Controller {

    public function __construct() {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function landing_index() {
        $testimonialDetails = Testimonial::where('status', 'Active')->get();
        $advertisementDetails = Advertisement::where('status', 'Active')->orderBy('id', 'DESC')->limit(2)->get();
        $blogDetails = Blog::where('status', 'Active')->orderBy('id', 'DESC')->limit(2)->get();
        $faqDetails = Faq::where('status', 'Active')->orderBy('id', 'DESC')->get();

        if (Auth::check()) {
            // $this->swiftDocValidation();
        }
        return view('sites.index', [
            'testimonialDetails' => $testimonialDetails,
            'blogDetails' => $blogDetails,
            'faqDetails' => $faqDetails,
            'advertisementDetails' => $advertisementDetails
        ]);
    }

    public function listingTruck(Request $request) {
        $postData = $request->all();
        if (Auth::check()) {
            if (Auth::check()) {
                // $this->swiftDocValidation();
            }
        }
        if(isset($postData['from'])){
            if($postData['from'] == 'login'){
                return redirect('/listing/truck');	
            }
        }
        $truckList = $filterData = applyFilterTrucks($postData);
        $truckSizeList = DealerVehicle::select('size')->where('status', '1')->groupBy('size')->get();
        //        pr($truckList);
        $vehicleType = VehicleType::get();
        return view('sites.listing_truck', [
            'postData' => $postData,
            'truckList' => $truckList,
            'vehicleType' => $vehicleType,
            'queryString' => $postData,
            'truckSizeList' => $truckSizeList
        ]);
    }

    public function truckForSale(Request $request) {
        if(isset($postData['from'])){
            if($postData['from'] == 'login'){
                return redirect('/listing/truck');  
            }   
        }
        $queryString = $request->query();

        $truckList = DealerVehicle::where('status', '1');
        $truckList = DealerVehicle::where('status', '1');
        if (isset($queryString['type_of_truck'])) {
            $truckList = $truckList->where('vehicle_type_id', $queryString['type_of_truck']);
        }
        if (isset($queryString['type_of_truck'])) {
            $truckList = $truckList->orWhere('source_address', 'like', $queryString['from']);
        }
        if (isset($queryString['destination_address'])) {
            $truckList = $truckList->orWhere('destination_address', 'like', $queryString['to']);
        }
        if (isset($queryString['leaving'])) {
            $truckList = $truckList->orWhere('leaving', 'like', $queryString['leaving']);
        }
        if (isset($queryString['to_comming'])) {
            $truckList = $truckList->orWhere('to_comming', 'like', $queryString['to_comming']);
        }
        if (isset($queryString['size'])) {
            $truckList = $truckList->orWhere('size', 'like', $queryString['size']);
        }
        $truckList = DealerVehicle::where('type', '1');
        $truckList = $truckList->get();

        $truckSizeList = DealerVehicle::select('size')->where('status', '1')->groupBy('size')->get();
//        pr($truckList);
        $vehicleType = VehicleType::get();
        return view('sites.listing_truck', [
            //'postData' => $postData,
            'truckList' => $truckList,
            'vehicleType' => $vehicleType,
            'queryString' => $queryString,
            'truckSizeList' => $truckSizeList
        ]);
    }

    public function truckForRental(Request $request) {
        if(isset($postData['from'])){
            if($postData['from'] == 'login'){
                return redirect('/listing/truck');  
            }   
        }
        $queryString = $request->query();

        $truckList = DealerVehicle::where('status', '1');
        $truckList = DealerVehicle::where('status', '1');
        if (isset($queryString['type_of_truck'])) {
            $truckList = $truckList->where('vehicle_type_id', $queryString['type_of_truck']);
        }
        if (isset($queryString['type_of_truck'])) {
            $truckList = $truckList->orWhere('source_address', 'like', $queryString['from']);
        }
        if (isset($queryString['destination_address'])) {
            $truckList = $truckList->orWhere('destination_address', 'like', $queryString['to']);
        }
        if (isset($queryString['leaving'])) {
            $truckList = $truckList->orWhere('leaving', 'like', $queryString['leaving']);
        }
        if (isset($queryString['to_comming'])) {
            $truckList = $truckList->orWhere('to_comming', 'like', $queryString['to_comming']);
        }
        if (isset($queryString['size'])) {
            $truckList = $truckList->orWhere('size', 'like', $queryString['size']);
        }
        $truckList = DealerVehicle::where('type', '0');
        $truckList = $truckList->get();

        $truckSizeList = DealerVehicle::select('size')->where('status', '1')->groupBy('size')->get();
//        pr($truckList);
        $vehicleType = VehicleType::get();
        return view('sites.listing_truck', [
            //'postData' => $postData,
            'truckList' => $truckList,
            'vehicleType' => $vehicleType,
            'queryString' => $queryString,
            'truckSizeList' => $truckSizeList
        ]);
    }

    public function buy_truck(Request $request) {
        $postData = $request->all();

        $queryString = $request->query();

        $truckList = DealerVehicle::where(['status'=>'1','type'=>1]);
        if (isset($queryString['type_of_truck'])) {
            $truckList = $truckList->where('vehicle_type_id', $queryString['type_of_truck']);
        }
        if (isset($queryString['type_of_truck'])) {
            $truckList = $truckList->orWhere('source_address', 'like', $queryString['from']);
        }
        if (isset($queryString['destination_address'])) {
            $truckList = $truckList->orWhere('destination_address', 'like', $queryString['to']);
        }
        if (isset($queryString['leaving'])) {
            $truckList = $truckList->orWhere('leaving', 'like', $queryString['leaving']);
        }
        if (isset($queryString['to_comming'])) {
            $truckList = $truckList->orWhere('to_comming', 'like', $queryString['to_comming']);
        }
        if (isset($queryString['size'])) {
            $truckList = $truckList->orWhere('size', 'like', $queryString['size']);
        }
        $truckList = $truckList->orderBy('id','DESC')->get();

        $truckSizeList = DealerVehicle::select('size')->where('status', '1')->where('type', '1')->groupBy('size')->get();
       //pr($truckList);
        $vehicleType = VehicleType::get();
        return view('sites.buy_truck', [
            'postData' => $postData,
            'truckList' => $truckList,
            'vehicleType' => $vehicleType,
            'queryString' => $queryString,
            'truckSizeList' => $truckSizeList
        ]);
    }

    public function rent_truck(Request $request) {
        // $id = Auth::User()->id;
        // Get User checkIfUserSubscribed
        // if(checkIfUserSubscribed($id) == false)
        // {
        //     $plans = Plan::where('id',7)->get();
        //     return view('sites.rentSubscription',['plans'=>$plans]);
        // }
        $postData = $request->all();
        $queryString = $request->query();

        $truckList = DealerVehicle::where(['status'=>'1','type'=>0]);
        if (isset($queryString['type_of_truck'])) {
            $truckList = $truckList->where('vehicle_type_id', $queryString['type_of_truck']);
        }
        if (isset($queryString['type_of_truck'])) {
            $truckList = $truckList->orWhere('source_address', 'like', $queryString['from']);
        }
        if (isset($queryString['destination_address'])) {
            $truckList = $truckList->orWhere('destination_address', 'like', $queryString['to']);
        }
        if (isset($queryString['leaving'])) {
            $truckList = $truckList->orWhere('leaving', 'like', $queryString['leaving']);
        }
        if (isset($queryString['to_comming'])) {
            $truckList = $truckList->orWhere('to_comming', 'like', $queryString['to_comming']);
        }
        if (isset($queryString['size'])) {
            $truckList = $truckList->orWhere('size', 'like', $queryString['size']);
        }
        $truckList = $truckList->orderBy('id','DESC')->get();

        $truckSizeList = DealerVehicle::select('size')->where('status', '1')->groupBy('size')->get();

        $vehicleType = VehicleType::get();
        return view('sites.rent_truck', [
            'postData' => $postData,
            'truckList' => $truckList,
            'vehicleType' => $vehicleType,
            'queryString' => $queryString,
            'truckSizeList' => $truckSizeList
        ]);
    }


    public function sell_truck(Request $request) {
        $postData = $request->all();

        $queryString = $request->query();

        $truckList = DealerVehicle::where('status', '1');
        if (isset($queryString['type_of_truck'])) {
            $truckList = $truckList->where('vehicle_type_id', $queryString['type_of_truck']);
        }
        if (isset($queryString['type_of_truck'])) {
            $truckList = $truckList->orWhere('source_address', 'like', $queryString['from']);
        }
        if (isset($queryString['destination_address'])) {
            $truckList = $truckList->orWhere('destination_address', 'like', $queryString['to']);
        }
        if (isset($queryString['leaving'])) {
            $truckList = $truckList->orWhere('leaving', 'like', $queryString['leaving']);
        }
        if (isset($queryString['to_comming'])) {
            $truckList = $truckList->orWhere('to_comming', 'like', $queryString['to_comming']);
        }
        if (isset($queryString['size'])) {
            $truckList = $truckList->orWhere('size', 'like', $queryString['size']);
        }
        $truckList = $truckList->get();

        $truckSizeList = DealerVehicle::select('size')->where('status', '1')->groupBy('size')->get();

        $vehicleType = VehicleType::get();
        return view('sites.sell_truck', [
            'postData' => $postData,
            'truckList' => $truckList,
            'vehicleType' => $vehicleType,
            'queryString' => $queryString,
            'truckSizeList' => $truckSizeList
        ]);
    }
    public function advertise_truck(Request $request) {
        $postData = $request->all();

        $queryString = $request->query();

        $truckList = DealerVehicle::where('status', '1');
        if (isset($queryString['type_of_truck'])) {
            $truckList = $truckList->where('vehicle_type_id', $queryString['type_of_truck']);
        }
        if (isset($queryString['type_of_truck'])) {
            $truckList = $truckList->orWhere('source_address', 'like', $queryString['from']);
        }
        if (isset($queryString['destination_address'])) {
            $truckList = $truckList->orWhere('destination_address', 'like', $queryString['to']);
        }
        if (isset($queryString['leaving'])) {
            $truckList = $truckList->orWhere('leaving', 'like', $queryString['leaving']);
        }
        if (isset($queryString['to_comming'])) {
            $truckList = $truckList->orWhere('to_comming', 'like', $queryString['to_comming']);
        }
        if (isset($queryString['size'])) {
            $truckList = $truckList->orWhere('size', 'like', $queryString['size']);
        }
        $truckList = $truckList->get();

        $truckSizeList = DealerVehicle::select('size')->where('status', '1')->groupBy('size')->get();
        $vehicleType = VehicleType::get();
        return view('sites.advertise_truck', [
            'postData' => $postData,
            'truckList' => $truckList,
            'vehicleType' => $vehicleType,
            'queryString' => $queryString,
            'truckSizeList' => $truckSizeList
        ]);
    }
    public function detailTruck(Request $request, $dv_id) {
        if (empty($dv_id)) {
            return redirect('listing/truck');
        }
        $truckList = DealerVehicle::where('status', '1')->limit(5)->get();
        $truckDetails = DealerVehicle::select('u.id as user_id','u.fname','u.lname','u.name','u.avatar','u.mobile_no','v.vehicle_name', 'dealer_vehicles.*')
                ->leftJoin('users as u', 'u.id', 'dealer_vehicles.dealer_id')
                ->leftJoin('vehicles as v', 'v.id', 'dealer_vehicles.id')
                ->where('dealer_vehicles.id', $dv_id)
                ->first();
        $reviewList = Review::select('reviews.*', 'u.name', 'u.avatar')
                ->leftJoin('users as u', 'u.id', 'reviews.user_id')
                ->where('truck_id', $dv_id)
                ->get();
        $complaintList = Complaint::select('complaints.*', 'u.name', 'u.avatar')
                ->leftJoin('users as u', 'u.id', 'complaints.user_id')
                ->where('truck_id', $dv_id)
                ->get();
        return view('sites.detail_truck', [
            'truckDetails' => $truckDetails,
            'reviewList' => $reviewList,
            'complaintList' => $complaintList,
            'truck_id' => $dv_id,
            'truckList' => $truckList
        ]);
    }
    public function quotes(Request $request) {
        $messages = [
            'name.required'=>'This field is required',
            'email.required'=>'This field is required',
            'mobile_no.required'=>'This field is required',
            'message.required'=>'This field is required',
            'pickup_location.required'=>'This field is required',
            'dropping_location.required'=>'This field is required',
            'quote_image.image'=>'Please select only jpeg,png,jpg image',
          ];
         $request->validate([ 
            'name' => 'required', 
            'email' => 'required',
            'mobile_no' => 'required',
            'message' => 'required',
            'pickup_location' => 'required',
            'dropping_location' => 'required',
            'quote_image' => 'image|mimes:jpeg,png,jpg|max:2048',
         ],$messages);

         $getQuotes = new Getquote();
         $getQuotes->Name = $request->input('name');
         $getQuotes->Email = $request->input('email');
         $getQuotes->Mobile = $request->input('mobile_no');
         $getQuotes->Message = $request->input('message');
         $getQuotes->PickingUpLocation = $request->input('pickup_location');
         $getQuotes->Dropping_Off_Location = $request->input('dropping_location');
         $getQuotes->PickingUpDate= $request->input('pickup_date');
         $getQuotes->DroppingOffDate = $request->input('drop_date');
         
         $quoteImage = $request->file('quote_image');
         if (!empty($quoteImage)) {
             $logoFileName = upload_admin_images($quoteImage, 'quotesImage');
             if (!empty($logoFileName)) {
                 $getQuotes->quote_image = $logoFileName;
             }
         }
        //  prd($getQuotes);
         if($getQuotes->save()){
            $QuotemailData = ['name'=>$request->Name,'message'=>$request->Message,'image'=>$getQuotes->quote_image];
            Mail::to('ashishkumar2@virtualemployee.com')->send(new SendMail($QuotemailData));
         }

        return redirect()->back()->with('message', 'Quote added succesfully!');
     }


    public function customerDashboard() {
        if (Auth::check()) {
            $user_type = getUser_Detail_ByParam('user_type');
            if ($user_type != 'Gold') {
                return redirect('/subscription');
            }
            return view('dashboard.dealer.dealerVehicleList', []);
        }
        return redirect('/');
    }

    public function driverDashboard() {
        if (Auth::check()) {
            $user_type = getUser_Detail_ByParam('user_type');
            if ($user_type != 'Gold') {
                return redirect('/subscription');
            }
            return view('sites.driverDashboard', []);
        }
        return redirect('/');
    }

    public function editProfile(Request $request, $id = null) {
        if (Auth::check()) {
            $user_type = getUser_Detail_ByParam('user_type');

            if ($user_type != 'Gold') {
                return redirect('/subscription');
            }
            if ($request->isMethod('get')) {
                $userDetails = getUserDetails();
                return view('sites.editProfile', ['userDetails' => $userDetails]);
            }

            if ($request->isMethod('post')) {
                $postData = $request->all();
                //prd($postData);
                $User = !empty($id) ? User::where(['id' => $id])->first() : '';
                $User->name = $postData['name'] ? $postData['name'] : $User->name;
                $User->dob = $postData['dob'] ? $postData['dob'] : $User->dob;
                $User->gender = $postData['gender'] ? $postData['gender'] : $User->gender;
                $User->address = $postData['address'] ? $postData['address'] : $User->address;
                $User->mobile_no = $postData['mobile_no'] ? $postData['mobile_no'] : $User->mobile_no;
                $User->save();
                return redirect('/editProfile');
            }
        }
        return redirect('/');
    }

    public function thankyou(Request $request) {
        $sessionData = $request->session()->get('quotesData');
        return view('sites.thankyou');
    }

    public function subscription(Request $request) {
        if(Auth::guest() == false)
        {
            if(checkIfUserSubscribed(Auth::user()->id))
            {
                return redirect('profile');
            }
            $sessionData = $request->session()->get('quotesData');
            $users = DB::select('select * from plans');
            return view('sites.subscription',['users'=>$users]);
        }
        return redirect('/');
    }
    public function create(Request $request){
        $name = $request->input('name');
        $email = $request->input('email');
        $sub = $request->input('sub');
        $message = $request->input('message');
        $data=array('name'=>$name,"email"=>$email ,"Subject"=>$sub ,"message"=>$message);
        DB::table('contactus')->insert($data);
        $this->validate($request, [
            'name'     =>  'required',
            'email'  =>  'required|email',
            'message' =>  'required'
            ]);

                $data = array(
                    'name'      =>  $request->name,
                    'message'   =>   $request->message
                );

            Mail::to('enquiry@emptytruck100.com')->send(new SendMail($data));
        return redirect()->back()->with('success', 'Thank you for contacting us');  
        //return redirect()->back()->with('message', 'Thank you for contacting us.');
	}
    public function aboutus() {
        return view('sites.aboutUs');
    }
    public function get_quotes() {
        return view('sites.quotes');
    }

    public function contactus() {
        return view('sites.contactUs');
    }

    public function privacyPolicy() {
        return view('sites.privacyPolicy');
    }
   public function donate() {
        return view('sites.donate');
    }
    public function Services() {
        return view('sites.Services');
    }

    public function Faq($faq_id) {
        $faqDetails = Faq::where('status', 'Active')->where('id', $faq_id)->orderBy('id', 'DESC')->first();
        return view('sites.faq', [
            'faqDetails' => $faqDetails,
        ]);
    }

    public function Blogs($blog_id) {
        $blogDetails = Blog::where('status', 'Active')->where('id', $blog_id)->orderBy('id', 'DESC')->first();
        $allBlogs = Blog::where('status', 'Active')->orderBy('id', 'DESC')->limit(5)->get();

        return view('sites.blogs', [
            'blogDetails' => $blogDetails,
            'allBlogs' => $allBlogs
        ]);
    }
     public function pay_after_loading() {
        return view('sites.pay_after_loading');
    }
    public function get_verified() {
        return view('sites.get_verified');
    } 
    public function saleSubscription() {
                    $plans = Plan::where('id',7)->get();
            return view('sites.rentSubscription',['plans'=>$plans]);
    }
}
