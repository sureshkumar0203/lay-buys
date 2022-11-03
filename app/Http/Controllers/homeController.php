<?php
namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

use Helpers;

//This line is used for getting the input box value
use Illuminate\Http\Request;
//This line is used for database connection
use DB;
//This line is used for session
use Session;
//This line is used for url redirect
use Illuminate\Support\Facades\Redirect;

//use App\Mylibs\thumbnail_manager;
//use App\Mylibs\paypal_pro;

use Mail;

use App\Mail\Reminder;
//use App\Mail\MailBuilder;

//use Mail;
//use App\Mail\ContactMail;


class homeController extends BaseController{
	public function showHome(){
		$banner_data = DB::table('banners')->orderBy('id', 'DESC')->get();
		$latest_cat_data = DB::table('categories')->orderBy('cat_id', 'DESC')->take(6)->get();
	    
		//For using group by change strict => false in config/database.php file
		$latest_prd_data = DB::table('products')
		->join('product_photos', 'product_photos.prd_id', '=', 'products.prd_id')
		->where('products.active_status', '=', 0)
		->orderBy('products.prd_id', 'DESC')
		->groupBy('product_photos.prd_id')
		->select('products.*', 'product_photos.prd_photo')
        ->take(10)->get();
		
		//print_r($latest_prd_data);exit;

		
			
		//$latest_prd_data = DB::table('products')->orderBy('prd_id', 'DESC')->take(10)->get();
		return view('home',['banner_data' => $banner_data,'latest_cat_data' => $latest_cat_data,'latest_prd_data' => $latest_prd_data]);
	}

	public function cmsPages(){
		$slug = request()->segment(2);
		$data  = DB::table('contents')->where('slug',$slug )->first();
		return view('page',compact('data'));
	}
	
	public function viewContactUs(){
		return view('contact-us');
	}
	
	public function sendContactUsMail(Request $request){
		$full_name = trim($request->input('full_name'));	
		$user_email = trim($request->input('user_email'));	
		$subject = trim($request->input('subject'));
		$your_message = trim($request->input('your_message'));
		
		if($full_name=="" || $user_email=="" || $subject=="" || $your_message==""){
			return Redirect::to('contact-us')->with('blank', true);
		}else{
			// Admin Details
			$admin_det = Helpers::getAdminDetails();
			$admin_name = $admin_det[0]->admin_name;
			$admin_email = $admin_det[0]->alt_email;
			
			$current_year = date("Y");
			
			//Email Template Details
			$res_template = DB::table('email_template')->where('id', '=', 2)->get();
			$input = $res_template[0]->contents;
			
			$body_admin = str_replace(array('%ADMINNAME%','%NAME%','%EMAIL%','%MESSAGE%','%ADMINEMAIL%','%CURRENTYEAR%'), array($admin_name,$full_name,$user_email,$your_message,$admin_email, $current_year), $input);
			//echo $body_admin;exit;
			
			/*$content = [
			  'body'=> $body_admin,
			];
			
			$to_email = 'suresh@bletindia.com';
			$pathToFile = asset('public/banners/B_1007181531200392.jpg');
			
			$ok = Mail::send('emails.common_mail', ['content' => $content], function ($message) use($user_email,$to_email,$pathToFile) {
			  $message->from($user_email, 'Your Application');
			  $message->to($to_email, 'Suresh');
			  $message->subject('Skumar Subject');
			  $message->attach($pathToFile);
        	});
			echo $ok."hhh";exit;*/
			
			$headers = "MIME-Version: 1.0\n";
			$headers .= "Content-type: text/html; charset=UTF-8\n";
			$headers .= "From:" . $full_name . " < " . $user_email . ">\n";
			$ok = mail($admin_email, $subject, $body_admin, $headers);
				
			return Redirect::to('contact-us')->with('success', true);
		}
	}
	
	public function viewProductsCategoryWise(Request $request){
		$uri = explode('-', $request->path());
        $cat_id = array_pop($uri);
		
		//This data fetched for left section - Start
		$cat_det = DB::table('categories')
		    ->where('cat_id','=',$cat_id)
          	->select('category_name')
            ->get();
		if(count($cat_det)==0){
			return Redirect::to('home');
		}
		

		 $sub_cat_det = DB::table('categories')
			->where('categories.cat_id', '=' ,$cat_id)
			->join('sub_categories', 'categories.cat_id', '=', 'sub_categories.cat_id')
            ->get();
		//This data fetched for left section - End
			
		//echo "<pre>";print_r($sub_cat_det);exit;
			
		$per_page = 40;
		$prd_det = DB::table('products')
		->join('product_photos', 'product_photos.prd_id', '=', 'products.prd_id')
		->where('products.prd_cat_id', '=',$cat_id)
		->where('products.active_status', '=', 0)
		->orderBy('products.prd_id', 'DESC')
		->groupBy('product_photos.prd_id')
		->select('products.*', 'product_photos.prd_photo')
        ->paginate($per_page);
		
		//print_r($prd_det);exit;
		
		
		
		return view('products',['cat_det'=>$cat_det,'sub_cat_det'=> $sub_cat_det,'prd_det'=>$prd_det]);
	}
	
	public function viewProductsCategorySubcategoryWise(Request $request){
		//echo $request->path();exit;
		$uri_ary = explode('/', $request->path());
		$cat_sec= $uri_ary[1];
		$sub_cat_sec= $uri_ary[2];
		
		$uri = explode('-', $cat_sec);
        $cat_id = array_pop($uri);
		
		$uri = explode('-', $sub_cat_sec);
        $sub_cat_id = array_pop($uri);
		
		//This data fetched for left section - Start
		$cat_det = DB::table('categories')
		    ->where('cat_id','=',$cat_id)
          	->select('category_name')
            ->get();
			
		if(count($cat_det)==0){
			return Redirect::to('home');
		}

		$sub_cat_det = DB::table('categories')
			->where('categories.cat_id', '=' ,$cat_id)
			->join('sub_categories', 'categories.cat_id', '=', 'sub_categories.cat_id')
            ->get();
		//This data fetched for left section - End
			
		//echo "<pre>";print_r($sub_cat_det);exit;
		
		$per_page = 40;
		$prd_det = DB::table('products')
		->join('product_photos', 'product_photos.prd_id', '=', 'products.prd_id')
		->where('products.prd_cat_id', '=',$cat_id)
		->where('products.prd_sub_cat_id', '=',$sub_cat_id)
		->where('products.active_status', '=', 0)
		->orderBy('products.prd_id', 'DESC')
		->groupBy('product_photos.prd_id')
		->select('products.*', 'product_photos.prd_photo')
        ->paginate($per_page);
		
		
		//$prd_det = DB::table('products')->where('prd_cat_id', '=',$cat_id)->orderBy('prd_id', 'DESC')->paginate($per_page);
		
		return view('products',['cat_det'=>$cat_det,'sub_cat_det'=> $sub_cat_det,'prd_det'=>$prd_det]);
	}

	public function viewProductDetails(Request $request){
		$uri_ary = explode('/', $request->path());
	    $prd_ary= explode('-', $uri_ary[1]);
		$prd_id = array_pop($prd_ary);
		
		$prd_det = DB::table('products')->where('prd_id', '=',$prd_id)->where('active_status', '=', 0)->first();
		
		if($prd_det == "") {
			return Redirect::to('/');
		}
		
		$prd_ph_det = DB::table('product_photos')->where('prd_id', '=',$prd_id)->get();
		
		$prd_ips_det = DB::table('product_installment_periods')->where('prd_id', '=',$prd_id)->select('insta_period', DB::raw("concat(insta_period,' Installment(s)') as ip_week")) ->pluck('ip_week','insta_period')->prepend('--Select--','');
		
		
		
		$down_payment = number_format(($prd_det->product_price*$prd_det->product_dp_per)/100,2,'.','');
		
		return view('product-details',['prd_det' => $prd_det,'prd_ph_det'=>$prd_ph_det,'prd_ips_det'=>$prd_ips_det,'down_payment'=>$down_payment]);
	}
		
	public function displayTermsCondsPage(){
		$privacy_det = DB::table('contents')
					->where('id', '=' ,'2')
					->get();
		return  view('terms-conditions',['privacy_det'=>$privacy_det]);
	}
	
	public function viewUserSignUp(){
		if(Session::get('user_id')==""){
			return view('user-signup');
		}else{
			return Redirect::to('my-account');
		}
	}

	public function saveUserData(Request $request){
		$full_name = trim($request->input('full_name'));	
		$contact_no = trim($request->input('contact_no'));	
		$email = trim($request->input('email'));	
		$password = trim($request->input('password'));
		$user_password=md5($password);		
		
		$address1 = trim($request->input('address1'));	
		$address2 = trim($request->input('address2'));
		$town = trim($request->input('town',false));
		$city = trim($request->input('city',false));	
		$post_code = trim($request->input('post_code'));		
		$state = trim($request->input('state',false));	
		$country = trim($request->input('country',false));
		
		$to_date=date("Y-m-d");

		$same_for_billing = ($request->input('same_for_billing'))?trim($request->input('same_for_billing')):0;
		if($same_for_billing==1){
			$ship_full_name = trim($request->input('ship_full_name'));
			$ship_contact_no = trim($request->input('ship_contact_no'));
			$ship_address1 = trim($request->input('ship_address1'));	
			$ship_address2 = trim($request->input('ship_address2'));
			$ship_town = trim($request->input('ship_town',false));	
			$ship_city = trim($request->input('ship_city',false));	
			$ship_post_code = trim($request->input('ship_post_code'));		
			$ship_state = trim($request->input('ship_state',false));	
			$ship_country = trim($request->input('ship_country',false));		
		}else{
			$ship_full_name = trim($request->input('full_name'));
			$ship_contact_no = trim($request->input('contact_no'));
			$ship_address1 = trim($request->input('address1'));	
			$ship_address2 = trim($request->input('address2'));
			$ship_town = trim($request->input('town',false));
			$ship_city = trim($request->input('city',false));	
			$ship_post_code = trim($request->input('post_code'));		
			$ship_state = trim($request->input('state',false));	
			$ship_country = trim($request->input('country',false));	
		}
		$user_count = DB::table('user_registration')
                ->where('email', '=' ,$email)
                ->count();
				
		if($full_name=="" || $contact_no=="" || $email=="" || $password=="" || $address1=="" ||  $post_code==""){
			return Redirect::to('user-signup')->with('blank', true)->withInput();
		}else if($same_for_billing==1 && ($request->input('ship_full_name')=="" || $request->input('ship_contact_no')=="" || $request->input('ship_address1')=="" || $request->input('ship_post_code')=="")){
			return Redirect::to('user-signup')->with('ship_blank', true)->withInput();
		}else if($user_count > 0){
			return Redirect::to('user-signup')->with('email_exist', true)->withInput();
		}else{
			//echo "here";exit;
			DB::table('user_registration')->insert(array(
				'full_name' => $full_name,
				'contact_no' => $contact_no, 
				'email' => $email,
				'password' => $user_password,
				'address1' => $address1,
				'address2' => $address2,
				'town' => $town,
				'city' => $city,
				'post_code' => $post_code,
				'state' => $state,
				'country' => $country,
				'ship_full_name' => $ship_full_name,
				'ship_contact_no' => $ship_contact_no,
				'ship_address1' => $ship_address1,
				'ship_address2' => $ship_address2,
				'ship_town' => $ship_town,
				'ship_city' => $ship_city,
				'ship_post_code' => $ship_post_code,
				'ship_state' => $ship_state,
				'ship_country' => $ship_country,
				'same_for_billing' => $same_for_billing,
				
				'reg_date' => $to_date,
				'updated_date' => $to_date
				));
				
				$user_id= DB::getPdo()->lastInsertId();
				//Session::put('user_id', $user_id);
        		//Session::put('user_name', $full_name);
				

				//######################User Registration mail goes to user#################
				// Admin Details
				$admin_det = Helpers::getAdminDetails();
				$admin_name = $admin_det[0]->admin_name;
				$admin_email = $admin_det[0]->alt_email;
				$email_confirm_url	= $admin_det[0]->site_url.$email.'/confirm-email';
		
				$current_year = date("Y");
		
				# Subject
				$subject = "Lay Buys :: Login Credentials";
				
				//Email Template Details
				$res_template = DB::table('email_template')->where('id', '=', 3)->get();
				$input = $res_template[0]->contents;
		
			   
				$body_user = str_replace(array('%USERNAME%','%USEREMAIL%','%USERPASSWORD%','%CONFIRMURL%','%ADMINNAME%','%ADMINEMAIL%','%CURRENTYEAR%'), array($full_name,$email,$password,$email_confirm_url,$admin_name,$admin_email, $current_year), $input);
				//echo $body_user;exit;
				
				/*$content = [
						'title'=> 'ok',
						'subject'=> $subject,
						'body'=> $body_user,
						'email_template' => 'emails.common_mail',
						'from_email' => $admin_email];
				
				$ok=Mail::to($email)->send(new MailBuilder($content));*/
				
				$headers = "MIME-Version: 1.0\n";
				$headers .= "Content-type: text/html; charset=UTF-8\n";
				$headers .= "From:" . $admin_name . " < " . $admin_email . ">\n";
				
				$ok = mail($email, $subject, $body_user, $headers);
				//######################User Registration mail goes to user#################
				return Redirect::to('registration-completed');
		}
	
	}
	
	public function viewUserSignUpCompleted(){
		return view('registration-completed');
	}
	
	public function confiemEmailAddress(Request $request){
		$uri = explode('/', $request->path());
        $user_email = array_shift($uri);
		
		$user_count = DB::table('user_registration')
                ->where('email', '=' ,$user_email)
                ->count();
		if($user_count>0){
			DB::table('user_registration')->where('email', $user_email)->update(array('email_conf_status' => 1));
			return Redirect::to('registration-success')->with('success', true);
		}else{
			return Redirect::to('/');
		}
		
	}
	
	public function viewConfiemEmailAddress(){
		return view('registration-success');
	}
	
	public function displayLoginPage(){
		return  view('login');
	}
	
	public function checkLogin(Request $request) {
		$user_email = $request->input('login_email');	
		$user_password = $request->input('login_psw');
		$user_password_md5 = md5($user_password);	
		
        if ($user_email == "" || $user_password == "") {
           return "blank";
        }
		
        // Get records from registration table with email address
		$result = DB::table('user_registration')
                ->where('email', '=', $user_email)
                ->get();
		
		//echo count($result);exit;
		
        // If record not exist
        if(count($result) == 0) {
            return "invalid";
        }else if ($user_password_md5 != $result[0]->password){
			return "invalid";
		}else if ($result[0]->email_conf_status==0){
			return "notconfirmed";
		}else if ($result[0]->user_status==1){
			return "blocked";
		}else{
		   // Store in SESSION
		   Session::put('user_id', $result[0]->user_id);
		   Session::put('user_name', $result[0]->full_name);
		   return "success";
	  }
    }
	
	public function userLogout(){
		$user_id = Session::get('user_id');
		DB::table('master_order')->where('user_id', '=', $user_id)->where('transaction_id', '=', NULL)->delete();
		DB::table('user_installments')->where('user_id', '=', $user_id)->where('trns_id', '=', NULL)->delete();
		
		Session::flush();
		return Redirect::to('home');
	}
	
	public function userForgotPassword(Request $request){
		//Get all inputed text box values
		$user_email_fp = trim($request->input('forgot_email'));
        if ($user_email_fp == "") {
           return "fp_blank";
        }

        // Get records from registration table with email address
        $user_det = DB::table('user_registration')
                ->where('email', '=', $user_email_fp)
                ->get();
		
		
        // If record not exist
        if(count($user_det) == 0) {
            return "fp_fail";
        }else if ($user_det[0]->email_conf_status==0){
			return "fp_notconfirmed";
		}else if ($user_det[0]->user_status==1){
			return "fp_blocked";
		}else{
			$subject ="Forget Password";
			
			$user_id = $user_det[0]->user_id;
			$user_name = $user_det[0]->full_name;
			$user_email = $user_det[0]->email;
		
			$password = Helpers::createHighSecurityPassword();
			$user_password=md5($password);
			
			
			DB::table('user_registration')->where('user_id',$user_id)->update(array('password' => $user_password));
			
			// Admin Details
			$admin_det = Helpers::getAdminDetails();
			$admin_name = $admin_det[0]->admin_name;
			$admin_email = $admin_det[0]->alt_email;
				
			$current_year = date("Y");
			
			//Email Template Details
			$res_template = DB::table('email_template')->where('id', '=', 4)->get();
			$input = $res_template[0]->contents;
			
			
			$body_user = str_replace(array('%USERNAME%','%USEREMAIL%','%USERPASSWORD%','%ADMINNAME%','%ADMINEMAIL%','%CURRENTYEAR%'), array($user_name,$user_email,$password,$admin_name,$admin_email, $current_year), $input);
			//echo $body_user;exit;
			
			$headers_user  = 'MIME-Version: 1.0' . "\n";
			$headers_user .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers_user .= "From:".$admin_email."\n";
		
			mail($user_email,$subject,$body_user,$headers_user);
		    return "fp_success";

	  }

	}
	
	public function showMyAccount(){
		$user_id = Session::get('user_id');
		$order_info = DB::table('master_order')
					->where('user_id', '=' ,$user_id)
					->where('transaction_id','!=','null')
					->orderBy('order_id', 'DESC')
					->take(10)
					->get();
		
		return view('my-account')->with('order_info', $order_info);
		
	}
	
	public function orderProcess(Request $request){
		$prd_id = $request->input('prd_id');
		$prd_slug = $request->input('prd_slug');
		$ips = $request->input('ips');
		
		
		if($prd_id=="" || $ips==""){
			return Redirect::to('product-details/'.$prd_slug.'-'.$prd_id);
		}else{
		  Session::put('sel_prd_id', $prd_id);
		  Session::put('sel_ips', $ips);
		  return Redirect::to('confirm-order');
		}
	}
	
	public function showConfirmOrder(){
		$prd_id=Session::get('sel_prd_id');
		$prd_dtls = DB::table('products')
                ->where('prd_id', '=', $prd_id)
                ->first();
		$down_payment = number_format(($prd_dtls->product_price*$prd_dtls->product_dp_per)/100,2,'.','');        return view('confirm-order',['prd_dtls' => $prd_dtls,'down_payment'=> $down_payment]);
	}
	
	public function confirmOrderProcess(Request $request){
		$bill_full_name = $request->input('full_name');	
		$email = $request->input('email');	
		$bill_phone_number = $request->input('contact_no');		
		$bill_address1 = $request->input('address1');	
		$bill_address2 = $request->input('address2');
		$bill_town = $request->input('town');		
		$bill_city = $request->input('city');	
		$bill_post_code = $request->input('post_code');		
		$bill_country = $request->input('country',false);	
		$bill_state = $request->input('state',false);
		
		

		$same_for_billing = ($request->input('same_for_billing'))?$request->input('same_for_billing'):0;
		if($same_for_billing==1){
		  $ship_full_name = $request->input('ship_full_name');
		  $ship_phone_number = $request->input('ship_contact_no');		
		  $ship_address1 = $request->input('ship_address1');	
		  $ship_address2 = $request->input('ship_address2');
		  $ship_town = $request->input('ship_town');		
		  $ship_city = $request->input('ship_city');	
		  $ship_post_code = $request->input('ship_post_code');	
		  $ship_country = $request->input('ship_country',false);
		  $ship_state = $request->input('ship_state',false);		
		}else{
		  $ship_full_name = $request->input('full_name');
		  $ship_phone_number = $request->input('contact_no');		
		  $ship_address1 = $request->input('address1');	
		  $ship_address2 = $request->input('address2');
		  $ship_town = $request->input('town');
		  $ship_city = $request->input('city');	
		  $ship_post_code = $request->input('post_code');	
		  $ship_country = $request->input('country',false);
		  $ship_state = $request->input('state',false);		
		}

		if($bill_full_name=="" || $email=="" || $bill_phone_number=="" || $bill_address1==""  || $bill_post_code==""){
			return "bill_blank";
		}else if($same_for_billing==1 && ($request->input('ship_full_name')=="" || $request->input('ship_contact_no')=="" || $request->input('ship_address1')=="" || $request->input('ship_post_code')=="")
		){
			return "ship_blank";
		}else{
			$user_id = Session::get('user_id');
			$prd_id = Session::get('sel_prd_id');
		    $installment_period = Session::get('sel_ips');
			
			$to_date=date("Y-m-d");
			
			$installment_days = $installment_period * 7;
			$installment_exp_dt = date('Y-m-d', strtotime("+$installment_days days"));
			
			$prd_dtls = DB::table('products')
                ->where('prd_id', '=', $prd_id)
                ->first();
			

			$total_amount = $prd_dtls->product_price;
			$dp_per = $prd_dtls->product_dp_per;
			$down_payment = number_format(($total_amount*$dp_per)/100,2,'.','');
			
			
			DB::table('master_order')->insert(array(
					'user_id' => $user_id,
					'bill_full_name' => $bill_full_name,
					'email' => $email,
					'bill_phone_number' => $bill_phone_number,
					'bill_address1' => $bill_address1,
					'bill_address2' => $bill_address2,
					'bill_town' => $bill_town,
					'bill_city' => $bill_city,
					'bill_post_code' => $bill_post_code,
					'bill_country' => $bill_country,
					'bill_state' => $bill_state,
					
					'ship_full_name' => $ship_full_name,
					'ship_phone_number' => $ship_phone_number,
					'ship_address1' => $ship_address1,
					'ship_address2' => $ship_address2,
					'ship_town' => $ship_town,
					'ship_city' => $ship_city,
					'ship_post_code' => $ship_post_code,
					'ship_country' => $ship_country,
					'ship_state' => $ship_state,
					
					'order_prd_id' => $prd_id,
					'total_amount' => $total_amount,
					'dp_per'  => $dp_per,
					'dp_amount'  => $down_payment,
					'installment_period'  => $installment_period,
					'order_date'=>$to_date,
					'installment_exp_dt'  => $installment_exp_dt,
					'payment_status'=>'Unpaid',
					'order_status'=>'Not yet shipped',
					));
			$order_id= DB::getPdo()->lastInsertId();
			Session::put('order_id', $order_id);
			
			//Unset session value
			Session::forget('sel_prd_id');
			Session::forget('sel_ips');
			
			//return view('dp-paypal');
			return Redirect::to('dp-paypal');
			
		}

	}
	
	public function showDownPaymentPaypal(){
		return view('dp-paypal');
	}
	
	public function updateDownPaymentTransactionDetails(){
		/*$fp=fopen("ipnresult.txt","w");
		foreach($_POST as $key => $value){
			fwrite($fp,$key.'===='.$value."\n");
		}*/
		
		$custom=$_POST['custom'];
		$txn_id=$_POST['txn_id'];
		
		/*$custom=1;
		$txn_id="TXN21312OK";*/
		
		$order_info = DB::table('master_order')
					->where('order_id', '=' ,$custom)
					->first();
		
		$user_name=$order_info->bill_full_name;
		$user_email=$order_info->email;				
					
					
		//Update Paypal Transaction ID
		DB::table('master_order')->where('order_id', $custom)->update(array('transaction_id' => $txn_id,'payment_status' => 'Paid'));
		
		
		//######################New ORDER mail goes to Admin#################
		// Admin Details
		$admin_det = Helpers::getAdminDetails();
		$admin_name = $admin_det[0]->admin_name;
		$admin_email = $admin_det[0]->email;
		$admin_alt_email = $admin_det[0]->alt_email;
		

		$current_year = date("Y");

		# Subject
		$subject = "Lay Buys :: New order placed";
		
		//Email Template Details
		$res_template = DB::table('email_template')->where('id', '=', 6)->get();
		$input = $res_template[0]->contents;

	   
		$body_admin = str_replace(array('%ADMINNAME%','%USERNAME%','%ORDERID%','%USEREMAIL%','%CURRENTYEAR%'), array($admin_name,$user_name,$custom,$user_email, $current_year), $input);
		//echo $body_admin;//exit;
		
		$headers  = 'MIME-Version: 1.0' . "\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= "From:".$user_email."\n";
		
		$ok = mail($admin_alt_email, $subject, $body_admin, $headers);
		
		//######################New ORDER mail goes to USER#################
		
		# Subject
		$subject_user = "Lay Buys :: Thank you for your order";
		
		//Email Template Details
		$res_template = DB::table('email_template')->where('id', '=', 10)->get();
		$input = $res_template[0]->contents;

	   
		$body_user = str_replace(array('%USERNAME%','%ORDERID%','%ADMINNAME%','%ADMINEMAIL%','%CURRENTYEAR%'), array($user_name,$custom,$admin_name,$admin_alt_email, $current_year), $input);
		//echo $body_user;exit;
		
		$headers_user  = 'MIME-Version: 1.0' . "\n";
		$headers_user .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers_user .= "From:".$admin_alt_email."\n";
		
		$ok = mail($user_email, $subject_user, $body_user, $headers_user);
		
		Session::forget('order_id');
		 
	
	}
	
	public function showDownPaymentThankYou(){
		return view('dp-thank-you');
	}
	
	public function showDownPaymentFailed(){
		return view('dp-payment-failed');
	}
	
	public function showDownPaymentOrderDetail($id){
		$user_id = Session::get('user_id');
		
		$user_dtls = DB::table('user_registration')
					->select('paypal_email_user')
					->where('user_id', '=' ,$user_id)
					->first();					
		
		//Fetch master order information from master order table
		$order_info = DB::table('master_order')
					->where('user_id', '=' ,$user_id)
					->where('order_id', '=' ,$id)
					->first();
		
		
		//Weekly pay approximately calculation			
		$total_amount = $order_info->total_amount;
		$dp_amount = $order_info->dp_amount;
		$installment_period =  $order_info->installment_period;
		
		$remaining_amount =  $total_amount-$dp_amount;
		
		//echo $prd_price."--".$dp_week_calc."--".$paid_amount;exit;
		$weekly_paid = number_format($remaining_amount / $installment_period,'2','.','');
		
		
					
		$prd_dtls = DB::table('products')
		->join('product_photos', 'product_photos.prd_id', '=', 'products.prd_id')
		->where('products.prd_id', '=',$order_info->order_prd_id)
		->orderBy('products.prd_id', 'DESC')
		->groupBy('product_photos.prd_id')
		->select('products.*', 'product_photos.prd_photo')
        ->get();
					
		$insta_dtls = DB::table('user_installments')
					->where('user_id', '=' ,$user_id)
					->where('ord_id', '=' ,$id)
					->where('trns_id', '!=' ,null)
					->where('intsa_status', '=' ,'Paid')
					->orderBy('insta_id', '=' ,'DESC')
					->get();
					
		//print_r($insta_dtls);exit;
		$total_installment = $insta_dtls->sum('insta_amt');
		
		$total_paid_still_now = $order_info->dp_amount+$total_installment;
		$due = $order_info->total_amount - $total_paid_still_now;
		
		//Returning Amount
		$payment_det = DB::table('payment_settings')
				->where('id', '=', 1)
				->first();
		$processing_fee = number_format($payment_det->processing_cost,'2','.','');
		$returning_amount = number_format(($total_paid_still_now -$processing_fee),'2','.','');


					
		if($order_info!=''){
			return view('order-details', compact('order_info','insta_dtls','total_installment','due','prd_dtls','user_dtls','weekly_paid','total_paid_still_now','processing_fee','returning_amount'));
		}else{
			return Redirect::to('my-account');
		}
		
	}
	
	public function installmentProcess(Request $request){
		$prd_id = $request->input('prd_id');	
		$ord_id = $request->input('ord_id');	
		$insta_amt = $request->input('insta_amt');		
		
		//echo $prd_id."--".$ord_id."--".$insta_amt;exit;
		
		if($prd_id=="" || $ord_id=="" || $insta_amt==""){
			return Redirect::to('my-account');
		}else{
			$user_id = Session::get('user_id');
			$insta_date=date("Y-m-d");
			
			DB::table('user_installments')->insert(array(
					'user_id' => $user_id,
					'prd_id' => $prd_id,
					'ord_id' => $ord_id,
					'insta_amt' => $insta_amt,
					'intsa_status' => 'Unpaid',
					'insta_date'=>$insta_date
					));
			$installment_id= DB::getPdo()->lastInsertId();
			Session::put('installment_id', $installment_id);
			return Redirect::to('installment-paypal');
			
		}

	}
	
	public function showInstallmentPaypal(){
		return view('installment-paypal');
	}
	
	public function showInstallmentThankYou(){
		return view('installment-thank-you');
	}
	
	public function showInstallmentFailed(){
		return view('installment-failed');
	}
	
	public function updateInstallmentTransactionDetails(){	
		/*$fp=fopen("inst_ipnresult.txt","w");
		foreach($_POST as $key => $value){
			fwrite($fp,$key.'===='.$value."\n");
		}*/
		
		$custom=$_POST['custom'];
		$txn_id=$_POST['txn_id'];
		
		//$custom = 3;
		//$txn_id="TXN567OKL";
		
		$ins_dtls = DB::table('user_installments')
					->select('ord_id')
					->where('insta_id', '=' ,$custom)
					->first();
		$order_id = $ins_dtls->ord_id;	
				
		$order_info = DB::table('master_order')
					->where('order_id', '=' ,$order_id)
					->first();
		
		$user_name=$order_info->bill_full_name;
		$user_email=$order_info->email;

		//Update Paypal Transaction ID
		DB::table('user_installments')->where('insta_id', $custom)->update(array('trns_id' => $txn_id,'intsa_status' => 'Paid'));
		
		//######################New ORDER mail goes to Admin#################
		// Admin Details
		$admin_det = Helpers::getAdminDetails();
		$admin_name = $admin_det[0]->admin_name;
		$admin_email = $admin_det[0]->email;
		$admin_alt_email = $admin_det[0]->alt_email;
		

		$current_year = date("Y");

		# Subject
		$subject = "Lay Buys :: New installment paid";
		
		//Email Template Details
		$res_template = DB::table('email_template')->where('id', '=', 7)->get();
		$input = $res_template[0]->contents;

	   
		$body_admin = str_replace(array('%ADMINNAME%','%USERNAME%','%ORDERID%','%USEREMAIL%','%CURRENTYEAR%'), array($admin_name,$user_name,$order_id,$user_email, $current_year), $input);
		//echo $body_admin;exit;
		
		$headers = "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=UTF-8\n";
		$headers .= "From:" . $user_name . " < " . $user_email . ">\n";
		
		$ok = mail($admin_alt_email, $subject, $body_admin, $headers);
		
		Session::forget('installment_id');
	}
	
	public function viewProfileSettings(){
		$user_id = Session::get('user_id');
		$data = DB::table('user_registration')->where('user_id','=',$user_id)->get();
		return view('profile-settings')->with('data', $data);
	}

	public function updateProfileSettings(Request $request){
		$full_name = $request->input('full_name');	
		$contact_no = $request->input('contact_no');	
		
		
		$address1 = $request->input('address1');	
		$address2 = $request->input('address2');
		$town = $request->input('town');	
		$city = $request->input('city');	
		$post_code = $request->input('post_code');		
		$state = $request->input('state',false);	
		$country = $request->input('country',false);
		
		
		$paypal_email_user = $request->input('paypal_email_user');	

		$to_date=date("Y-m-d");

		$same_for_billing = ($request->input('same_for_billing'))?trim($request->input('same_for_billing')):0;
		if($same_for_billing==1){
			$ship_full_name = $request->input('ship_full_name');
			$ship_contact_no = $request->input('ship_contact_no');
			$ship_address1 = $request->input('ship_address1');	
			$ship_address2 = $request->input('ship_address2');
			$ship_town = $request->input('ship_town');		
			$ship_city = $request->input('ship_city');	
			$ship_post_code = $request->input('ship_post_code');		
			$ship_state = $request->input('ship_state');	
			$ship_country = $request->input('ship_country');		
		}else{
			$ship_full_name = $request->input('full_name');
			$ship_contact_no = $request->input('contact_no');
			$ship_address1 = $request->input('address1');	
			$ship_address2 = $request->input('address2');
			$ship_town = $request->input('town');		
			$ship_city = $request->input('city');	
			$ship_post_code = $request->input('post_code');		
			$ship_state = $request->input('state');	
			$ship_country = $request->input('country');	
		}

		$reference_id = Session::get('user_id');
		if($full_name=="" || $contact_no==""  || $address1=="" || $post_code==""){
			return Redirect::to('profile-settings')->with('blank', true);
		}else if($same_for_billing==1 && ($request->input('ship_full_name')=="" || $request->input('ship_contact_no')=="" || $request->input('ship_address1')=="" || $request->input('ship_post_code')=="")){
			return Redirect::to('profile-settings')->with('ship_blank', true);
		}else{
			//echo "here";exit;
			DB::table('user_registration')->where('user_id','=',$reference_id)->update(array(
				'full_name' => $full_name,
				'contact_no' => $contact_no, 
				'address1' => $address1,
				'address2' => $address2,
				'town' => $town,
				'city' => $city,
				'post_code' => $post_code,
				'state' => $state,
				'country' => $country,
				'paypal_email_user' => $paypal_email_user,
				'ship_full_name' => $ship_full_name,
				'ship_contact_no' => $ship_contact_no,
				'ship_address1' => $ship_address1,
				'ship_address2' => $ship_address2,
				'ship_town' => $ship_town,
				'ship_city' => $ship_city,
				'ship_post_code' => $ship_post_code,
				'ship_state' => $ship_state,
				'ship_country' => $ship_country,
				'same_for_billing' => $same_for_billing,
				'updated_date' => $to_date
				));
			return Redirect::to('profile-settings')->with('success', true);
		}
	    
	}
	
	public function viewChangePassword(){
		return view('change-password');
	}
	
	public function saveChangePassword(Request $request){
		$old_psw = $request->input('old_psw');
		$decrypt_old_psw = md5($old_psw);

		$new_psw = $request->input('new_psw');
		$conf_psw = $request->input('conf_psw');
  
		if ($old_psw == "" || $new_psw == "" || $conf_psw == "") {
			return Redirect::to('change-password')->with('blank', true);
		}
  
		if ($new_psw != $conf_psw) {
			return Redirect::to('change-password')->with('conf_not_match', true);
		}
  		
  		$user_id = Session::get('user_id');
		$is_password_exist = DB::table('user_registration')
				->select('password')
				->where('user_id', '=', $user_id)
				->get();
		$db_password = $is_password_exist[0]->password;
  
		if ($db_password != $decrypt_old_psw) {
			return Redirect::to('change-password')->with('not_match', true);
		}
  		
  		//echo $new_psw."---".$buyer_id;exit;

		$encrypted_password = md5($new_psw);
  
		DB::table('user_registration')->where('user_id', '=', $user_id)->update(array('password' => $encrypted_password));
  
		return Redirect::to('change-password')->with('success', true);

	}
	
	public function cancelOrder($id) {
		$user_id = Session::get('user_id');
		$cancel_date = date('Y-m-d');
		DB::table('master_order')->where('user_id', '=', $user_id)->where('order_id', '=', $id)->update(array('cancel_status' => 1,'cancel_date'=>$cancel_date));
		
		//######################CNNCEL ORDER mail goes to Admin#################
		
		$order_info = DB::table('master_order')
					->where('order_id', '=' ,$id)
					->first();
		
		$user_name=$order_info->bill_full_name;
		$user_email=$order_info->email;	
		
		
		// Admin Details
		$admin_det = Helpers::getAdminDetails();
		$admin_name = $admin_det[0]->admin_name;
		$admin_email = $admin_det[0]->email;
		$admin_alt_email = $admin_det[0]->alt_email;
		

		$current_year = date("Y");

		# Subject
		$subject = "Lay Buys :: Order canceled by the user";
		
		//Email Template Details
		$res_template = DB::table('email_template')->where('id', '=', 8)->get();
		$input = $res_template[0]->contents;

	   
		$body_admin = str_replace(array('%ADMINNAME%','%USERNAME%','%ORDERID%','%USEREMAIL%','%CURRENTYEAR%'), array($admin_name,$user_name,$id,$user_email, $current_year), $input);
	    //echo $body_admin;exit;
		
		$headers = "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=UTF-8\n";
		$headers .= "From:" . $user_name . " < " . $user_email . ">\n";
		
		$ok = mail($admin_alt_email, $subject, $body_admin, $headers);
		
		
		return Redirect::to('order-details-'.$id)->with('success', true);
	}
	
	public function calculateWeeklyPayment(Request $request) {
		$prd_price = $request->input('prd_price');
		$dp_week_calc = $request->input('dp_week_calc');
		$inst_week = $request->input('inst_week');
		
		$paid_amount =  $prd_price-$dp_week_calc;
		
		//echo $prd_price."--".$dp_week_calc."--".$paid_amount;exit;
		$weekly_paid = number_format($paid_amount / $inst_week,'2','.','');
		return $weekly_paid;

    }
	
	
}