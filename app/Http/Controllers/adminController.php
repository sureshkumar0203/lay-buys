<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
//This line is used for getting the input box value
use Illuminate\Http\Request;
//This line is used for database connection
use DB;
//This line is used for session
use Session;
//This line is used for url redirect
use Illuminate\Support\Facades\Redirect;
use Helpers;
use Image;
use Response;
use Excel;

use Mail;
use App\Mail\MailBuilder;



use App\Mylibs\thumbnail_manager;

class adminController extends BaseController {
	public function viewLogin(){
		if(Session::get('admin_id')==""){
			return view('admin.login');
		}else{
			return Redirect::to('administrator/dashboard');
		}
	}
	
	//Admin Login
	public function adminLogin(Request $request){
		//echo base64_encode(base64_encode('Suresh#1983'));exit;

	  $email = $request->input('email');
	  $user_password = $request->input('password');
	  //echo $email;echo $user_password;exit;
	  
	  if ($email == "" || $user_password == "") {
	  	return Redirect::to('administrator')->with('blank', true);
	  }
	  
	  // Get records from core table with email address
	  $result = DB::table('core')
	  ->where('email', '=', $email)
	  ->get();
	  
	  // If record not exist
	  if (count($result) == 0) {
		  return Redirect::to('administrator')->with('invalid', true);
	  }
	  
	  // Decrypt the password from the database
	  $db_password = base64_decode(base64_decode($result[0]->password));
	  
	  // If password does not macth in db_password
	  if ($user_password != $db_password) {
		  return Redirect::to('administrator')->with('invalid', true);
	  }
	  
	  // Store in SESSION
	  Session::put('admin_id', $result[0]->id);
	  Session::put('admin_name', $result[0]->admin_name);
	  return Redirect::to('administrator/dashboard');
	}
  
	//Admin Logout
	public function logout() {
	  Session::flush();
	  Session::forget('admin_id');
	  Session::forget('admin_name');
	  return Redirect::to('administrator');
	}
	
	//Admin Password Recovery
	public function adminPswRecovery(Request $request) {
	  $forgot_email = $request->input('forgot_email');
	
	  if ($forgot_email == "") {
		  return Redirect::to('administrator/forgot-psw-admin')->with('blank', true);
	  }
	  
	   // Get records from core table with email address
	  $result = DB::table('core')
	  ->where('email', '=', $forgot_email)
	  ->get();
	  
	  // If record not exist
	  if (count($result) == 0) {
		  return Redirect::to('administrator/forgot-psw-admin')->with('invalid', true);
	  }
	
	  // Get admin details
	  $admin_det = Helpers::getAdminDetails();
	 
	  
	  // Admin Details
	  $db_password = base64_decode(base64_decode($admin_det[0]->password));
	  $admin_name = $admin_det[0]->admin_name;
	  $admin_email = $admin_det[0]->alt_email;
	  $site_url = $admin_det[0]->site_url;
	
	  $current_year = date("Y");
	  
	  $res_template = Helpers::getTemplateDetails(1);
	  //print_r($res_template);exit;
	  $input = $res_template[0]->contents;
	  
	  # Subject
	  $subject = "Lay Buys :: Password";
	
	  //echo $admin_email;exit;
	  $body = str_replace(array('%ADMINNAME%', '%ADMINEMAIL%', '%ADMINPASSWORD%', '%FROMEMAIL%', '%CURRENTYEAR%'), array($admin_name, $forgot_email, $db_password, $admin_email, $current_year), $input);
	  echo $body;exit;
	  
	  $headers  = 'MIME-Version: 1.0' . "\n";
	  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	  $headers .= "From:".$admin_email."\n";
	  $ok = mail($forgot_email, $subject, $body, $headers);
		  
	  return Redirect::to('administrator/forgot-psw-admin')->with('success', true);
			
			
	  /*$content = [
			  'subject'=> $subject,
			  'body'=> $body,
			  'email_template' => 'emails.common_mail',
			  'from_email' => $admin_email
			  ];
	  try{
         Mail::to($forgot_email)->send(new MailBuilder($content));
		 return Redirect::to('administrator/forgot-psw-admin')->with('success', true);
	  }
	  catch(\Exception $e){
		  $error_mesg = $e->getMessage();
		  return Redirect::to('administrator/forgot-psw-admin')->with('failed', 'Mail sending failed.');
	  }*/
	}
	
	// My Account start
	public function viewAdminAccount() {
		$data = Helpers::getAdminDetails();
		return view('admin.my-account')->with('data', $data);
	}
	
	public function updateAdminDetails(Request $request) {
		$admin_name = $request->input('admin_name');
		$email = $request->input('email');
		$alt_email = $request->input('alt_email');
		$contact_no = $request->input('contact_no');
		$fax_no = $request->input('fax_no',false);
		$mobile_no = $request->input('mobile_no');
		$address = $request->input('address');
  		
		$facebook_url = $request->input('facebook_url', false);
		$twitter_url = $request->input('twitter_url', false);
		$linkedin_url = $request->input('linkedin_url');
  
		if ($admin_name == "" || $email == "") {
			return Redirect::to('administrator/my-account')->with('blank', true);
		}
  
		DB::table('core')
				->where('id', '>', 0)
				->update(['admin_name' => $admin_name,
					'email' => $email,
					'alt_email' => $alt_email,
					'contact_no' => $contact_no,
					'fax_no'  => $fax_no,
					'mobile_no'  => $mobile_no,
					'facebook_url' => $facebook_url,
					'twitter_url' => $twitter_url,
					'linkedin_url' => $linkedin_url,
					'address' => $address]);
		return Redirect::to('administrator/my-account')->with('success', true);
	}
	// My Account end
	
	
	//Change password Start
	public function viewChangePassword() {
		return view('admin.change-password-admin');
	}
  
	public function changeAdminPsw(Request $request) {
		$old_password = $request->input('old_password');
		$new_password = $request->input('new_password');
		$conf_password = $request->input('conf_password');
  
		if ($old_password == "" || $new_password == "" || $conf_password == "") {
			return Redirect::to('administrator/change-password-admin')->with('blank', true);
		}
  
		if ($new_password != $conf_password) {
			return Redirect::to('administrator/change-password-admin')->with('conf_not_match', true);
		}
  
		$is_password_exist = DB::table('core')
				->select('password')
				->where('id', '>', 0)
				->get();
				
				
		$decrypted_db_password = base64_decode(base64_decode($is_password_exist[0]->password));
  
		if ($decrypted_db_password != $old_password) {
			return Redirect::to('administrator/change-password-admin')->with('not_match', true);
		}
  
		$encrypted_password = base64_encode(base64_encode($new_password));
  
		DB::table('core')->where('id', '>', 0)->update(array('password' => $encrypted_password));
  
		return Redirect::to('administrator/change-password-admin')->with('success', true);
	}
	//Change password end
	
	
	//Manage Seo start
	public function viewManageSeo() {
		$data = Helpers::getSeoDetails();
		return view('admin.manage-seo')->with('data', $data);
	}
  
	public function updateSeoDetails(Request $request) {
		$meta_title = $request->input('meta_title');
		$meta_keyword = $request->input('meta_keyword');
		$meta_descr = $request->input('meta_descr');
  
		if ($meta_title == "" || $meta_keyword == "" || $meta_descr == "") {
			return Redirect::to('administrator/manage-seo')->with('blank', true);
		}
  
		DB::table('seo')
				->where('id', '>', 0)
				->update(
						array('meta_title' => $meta_title,
							'meta_keyword' => $meta_keyword,
							'meta_descr' => $meta_descr,
		));
		return Redirect::to('administrator/manage-seo')->with('success', true);
	}
	//Manage Seo end
	
	
	public function viewManagePayment() {
		//$data = DB::table('payment_settings')->get();
		$data = Helpers::getPaymentDetails();
		return view('admin.payment-setting')->with('data', $data);
	}
	
	public function updatePaymentSetting(Request $request) {
		$paypal_environment = $request->input('paypal_environment');
		$paypal_email = $request->input('paypal_email');
		$processing_cost = $request->input('processing_cost');
  
		if ($paypal_environment == "" || $paypal_email == "") {
			return Redirect::to('administrator/payment-setting')->with('blank', true);
		}
  
		DB::table('payment_settings')
				->where('id', '>', 0)
				->update(['paypal_environment' => $paypal_environment,
					'paypal_email' => $paypal_email,
					'processing_cost' => $processing_cost
					]);
		return Redirect::to('administrator/payment-setting')->with('success', true);
	}
	
	
	
	//View manage content page start
	
	public function viewManageContents() {
	  $data = DB::table('contents')->orderBy('id')->get();
	  return view('admin.manage-contents')->with('data', $data);
	}

	public function viewAddContent(){
		return view('admin.add-content');
	}

	public function saveContent(Request $request) {
		$page_title = $request->input('page_title');
		$slug = str_slug($page_title, '-');
	    $content = $request->input('content');
	    $meta_title = $request->input('meta_title');
	    $meta_descr = $request->input('meta_descr');
	    $meta_keyword = $request->input('meta_keyword');
	    $created_date = date('Y-d-m');
	    if ($page_title == "" || $content == "") {
		  return Redirect::to('administrator/add-content')->withInput()->with('blank', true);
		  }
		  DB::table('contents')->insert(array('page_title' => $page_title,
		  	  'slug' => $slug,
			  'content' => $content,
			  'meta_title' => $meta_title,
			  'meta_descr' => $meta_descr,
			  'meta_keyword' => $meta_keyword,
			  'created_date' => $created_date));
		  return Redirect::to('administrator/add-content')->with('success', true);
	}
	
	public function viewEditContent($reference_id) {
	  $data = DB::table('contents')->where('id', '=', $reference_id)->get();
	  return view('admin.edit-content')->with('data', $data);
	}
	
	public function updateContent(Request $request) {
	  $reference_id = $request->input('reference_id');
	  $page_title = $request->input('page_title');
	  $slug = str_slug($page_title, '-');
	  $content = $request->input('content');
	  $meta_title = $request->input('meta_title');
	  $meta_descr = $request->input('meta_descr');
	  $meta_keyword = $request->input('meta_keyword');
	
	  if ($page_title == "" || $content == "") {
		  return Redirect::to('administrator/edit-content/' . $reference_id . '/edit')->with('blank', true);
	  }
	  DB::table('contents')->where('id', '=', $reference_id)->update(array('page_title' => $page_title, 'slug' => $slug, 'content' => $content, 'meta_title' => $meta_title, 'meta_descr' => $meta_descr, 'meta_keyword' => $meta_keyword));
	  return Redirect::to('administrator/edit-content/' . $reference_id . '/edit')->with('success', true);
	}

	public function deleteContents($id) {
		if($id == '1') {
			return Redirect::to('administrator/manage-contents')->with('no_delete', true);
		}
        DB::table('contents')->where('id', '=', $id)->delete();
        return Redirect::to('administrator/manage-contents');
	}
	
	//Banner page coding starts here
	
	public function viewManageBanners() {
	  $data = DB::table('banners')->orderBy('id', 'DESC')->get();
	  return view('admin.manage-banners')->with('data', $data);
	}
	
	public function viewAddBanner() {
	  return view('admin.add-banner');
	}
	
	public function saveBannerData(Request $request) {
	  if ($request->file('upload_banner') == "") {
		  return Redirect::to('administrator/add-banner/')->with('blank', true);
	  }
	  $ext = strtolower($request->file('upload_banner')->getClientOriginalExtension());
	
	
	  // File Upload here
	  if ($request->file('upload_banner')->getClientOriginalName() != "" && $ext == "png" || $ext == "jpg" || $ext == "jpeg") {
		  $banner_image = 'B_' . date('dmy') . time() . '.' . $request->file('upload_banner')->getClientOriginalExtension();
		  $request->file('upload_banner')->move(public_path() . '/banners/', $banner_image);
	
		  $created_date = date("Y-m-d");
		  DB::table('banners')->insert(array('banner_photo' => $banner_image,
			  'created_date' => $created_date,
			  'updated_date' => $created_date));
		  return Redirect::to('administrator/add-banner')->with('success', true);
	  } else {
		  return Redirect::to('administrator/add-banner/')->with('invformat', true);
	  }
	}
	
	public function viewEditBanner($reference_id) {
	  $data = DB::table('banners')->where('id', '=', $reference_id)->get();
	  return view('admin.edit-banner')->with('data', $data);
	}
	
	public function updateBanner(Request $request) {
	  $reference_id = $request->input('reference_id');
	  $updated_date = date("Y-m-d");
	
	  if ($request->file('upload_banner') != "") {
		  $ext = strtolower($request->file('upload_banner')->getClientOriginalExtension());
		  // File Upload here
		  if ($ext == "png" || $ext == "jpg" || $ext == "jpeg") {
			  //Unlink code starts here
			  $data = DB::table('banners')->where('id', '=', $reference_id)->get();
			  if ($data[0]->banner_photo != '') {
				  $unlink_path = "public/banners/" . $data[0]->banner_photo;
				  unlink($unlink_path);
			  }
			  //Unlink code ends here	
	
			  $banner_image = 'B_' . date('dmy') . time() . '.' . $request->file('upload_banner')->getClientOriginalExtension();
			  $request->file('upload_banner')->move(public_path() . '/banners/', $banner_image);
			  DB::table('banners')->where('id', '=', $reference_id)->update(array('banner_photo' => $banner_image, 'updated_date' => $updated_date));
			  return Redirect::to('administrator/edit-banner/' . $reference_id . '/edit')->with('success', true);
		  }
	  } else {
		  return Redirect::to('administrator/edit-banner/' . $reference_id . '/edit')->with('success', true);
	  }
	}
	
	public function deleteBanner($id) {
	  $data = DB::table('banners')->where('id', '=', $id)->get();
	  //Unlink code starts here
	  $data = DB::table('banners')
			  ->where('id', '=', $id)
			  ->get();
	  if ($data[0]->banner_photo != '') {
		  $unlink_path = "public/banners/" . $data[0]->banner_photo;
		  unlink($unlink_path);
	  }
	  //Unlink code ends here	
	  DB::table('banners')->where('id', '=', $id)->delete();
	  return Redirect::to('administrator/manage-banners');
	}
	//Banner page coding ends here
	
	
	
	//Manage Category 
	public function viewManageCategory() {
	   $data = DB::table('categories')->orderBy('cat_id', 'DESC')->get();
	   return view('admin.manage-category')->with('data', $data);
	}
	
	public function viewAddCategory() {
	   return view('admin.add-category');
	}
	
	public function saveCategoryData(Request $request){
	  $category_name = $request->input('category_name');
	  $category_slug = str_slug($category_name, '-');
	  
	  if ($category_name=="" || $request->file('category_icon') == "" || $request->file('category_photo') == "") {
		return Redirect::to('administrator/add-category/')->with('blank', true);
	  }
	  
	  // Category icon upload 
	  $ext_cat_icon = strtolower($request->file('category_icon')->getClientOriginalExtension());
	  if ($request->file('category_icon')->getClientOriginalName() != "" && $ext_cat_icon == "png" || $ext_cat_icon == "jpg" || $ext_cat_icon == "jpeg") {
		  $ci_image = 'CI_' . date('dmy') . time() . '.' . $request->file('category_icon')->getClientOriginalExtension();
		  $request->file('category_icon')->move(public_path() . '/category-icon/', $ci_image);
	  }
	  
	  // Category photo upload 
	  $ext = strtolower($request->file('category_photo')->getClientOriginalExtension());
	  if ($request->file('category_photo') != "" && $ext != "png" && $ext != "jpg" && $ext != "jpeg") {
		return Redirect::to('administrator/add-category')->with('invformat', true);
	  }
	  
	  //Duplicate checked
	  $count = DB::table('categories')
			  ->where('category_name', '=', $category_name)
			  ->count();
	  if($count == 0 && $request->file('category_photo') != "" && ($ext == "png" || $ext == "jpg" || $ext == "jpeg")){
		  //Laravel photo cropping
		  $category_image = 'C_'.date('dmy').time().'.'.$request->file('category_photo')->getClientOriginalExtension();
	
		  //Thumb Photo Uploading
		  $thumb_img = Image::make($request->file('category_photo')->getRealPath())->resize(370, 240);
		  $thumb_img->save(public_path() . '/category-photo/thumb/' . $category_image, 80);
	
		  //Upload Original Image Script
		  //$request->file('category_photo')->move(public_path() . '/category-photo/', $blog_image);
		  
		  $created_date = date("Y-m-d");
		  DB::table('categories')->insert(array('category_name' => $category_name,
		  	  'category_slug' => $category_slug,
		  	  'category_icon' => $ci_image,
			  'category_photo' => $category_image,
			  'created_date' => $created_date,
			  'updated_date' => $created_date));
		  $cat_id = DB::getPdo()->lastInsertId();
		  
		 return Redirect::to('administrator/add-category')->with('success', true);
	  }else{
		  return Redirect::to('administrator/add-category/')->with('exist', true);
	  }
	}
	
	public function viewEditCategory($reference_id) {
	  $data = DB::table('categories')->where('cat_id', '=', $reference_id)->get();
	  //$spe_data = DB::table('category_specification')->where('cat_id', '=', $reference_id)->get();
	  return view('admin.edit-category')->with('data', $data);
	}
	
	public function updateCategory(Request $request) {
	  $reference_id = $request->input('reference_id');
	  $category_name = $request->input('category_name');
	  $category_slug = str_slug($category_name, '-');
	  
	  if ($category_name=="" || $reference_id == "") {
		return Redirect::to('administrator/edit-category/' . $reference_id . '/edit')->with('blank', true);
	  }
	  
	  //Duplicate checked
	  $count = DB::table('categories')
			->where('category_name', '=', $category_name)
			->where('cat_id', '<>', $reference_id)
			->count();
	  if($count>0){
		  return Redirect::to('administrator/edit-category/' . $reference_id . '/edit')->with('exist', true);
	  }
	  
	  $data = DB::table('categories')->where('cat_id', '=', $reference_id)->get();
	  if($request->file('category_icon') != ""){
		  // Category icon update 
		  $ext_cat_icon = strtolower($request->file('category_icon')->getClientOriginalExtension());
		  if ($request->file('category_icon')->getClientOriginalName() != "" && $ext_cat_icon == "png" || $ext_cat_icon == "jpg" || $ext_cat_icon == "jpeg") {
			  //Unlink code starts here
			  if ($data[0]->category_icon != '') {
				  $unlink_path_thumb = "public/category-icon/" . $data[0]->category_icon;
				  unlink($unlink_path_thumb);
			  }
			  //Unlink code ends here
			  
			  $ci_image = 'CI_' . date('dmy') . time() . '.' . $request->file('category_icon')->getClientOriginalExtension();
			  $request->file('category_icon')->move(public_path() . '/category-icon/', $ci_image);
			   DB::table('categories')->where('cat_id', '=', $reference_id)->update(array('category_icon' => $ci_image));
		  }
	  }
	  
	  
	  if($request->file('category_photo') != ""){
		  $ext = strtolower($request->file('category_photo')->getClientOriginalExtension());
		  if($request->file('category_photo') != "" && $ext != "png" && $ext != "jpg" && $ext != "jpeg") {
			  return Redirect::to('administrator/edit-category/' . $reference_id . '/edit')->with('invformat', true);
		  }else{
			  //Unlink code starts here
			  if ($data[0]->category_photo != '') {
				  $unlink_path_thumb = "public/category-photo/thumb/" . $data[0]->category_photo;
				  unlink($unlink_path_thumb);
			  }
			  //Unlink code ends here
			  //Laravel photo cropping
			  $category_image = 'N_' . date('dmy') . time() . '.' . $request->file('category_photo')->getClientOriginalExtension();
	
			  //Thumb Photo Uploading
			  $thumb_img = Image::make($request->file('category_photo')->getRealPath())->resize(370, 240);
	
			  $thumb_img->save(public_path() . '/category-photo/thumb/' . $category_image, 80);
	
			  DB::table('categories')->where('cat_id', '=', $reference_id)->update(array('category_photo' => $category_image));
		  
		  }
	  }
	  DB::table('categories')->where('cat_id', '=', $reference_id)->update(array('category_name' => $category_name,'category_slug' => $category_slug));
	  return Redirect::to('administrator/edit-category/' . $reference_id . '/edit')->with('success', true);
	}
	
	public function deleteCategory($id) {
	  //Unlink code starts here
	  $cat_data = DB::table('categories')->where('cat_id', '=', $id)->get();
	  
	  if ($cat_data[0]->category_icon != '') {
		  $unlink_path_icon = "public/category-icon/" . $cat_data[0]->category_icon;
		  unlink($unlink_path_icon);
	  }
	  
	  if ($cat_data[0]->category_photo != '') {
		  $unlink_path_thumb = "public/category-photo/thumb/" . $cat_data[0]->category_photo;
		  unlink($unlink_path_thumb);
	  }
	  DB::table('categories')->where('cat_id', '=', $id)->delete();
	  return Redirect::to('administrator/manage-category');
	}
	
	//Manage Subcategory
	public function viewManageSubcategory(){
	   $data = DB::table('sub_categories')->join('categories', 'sub_categories.cat_id', '=', 'categories.cat_id')->orderBy('sub_categories.sub_cat_id', 'DESC')->get();
	   return view('admin.manage-subcategory')->with('data', $data);
	}
	
	public function viewAddSubcategory() {
		$data = DB::table('categories')->orderBy('cat_id', 'DESC')->pluck('category_name', 'cat_id')->prepend('Select Category...', '');
		return view('admin.add-subcategory')->with('data', $data);
	}
	
	public function saveSubcategoryData(Request $request){
	  $cat_id = $request->input('cat_id');
	  $sub_cat_name = $request->input('sub_cat_name');
	  $sub_cat_slug = str_slug($sub_cat_name, '-');
	  
	  if ($cat_id=="" || $sub_cat_name == "") {
		return Redirect::to('administrator/add-subcategory/')->with('blank', true);
	  }
	  
	  //Duplicate checked
	  $count = DB::table('sub_categories')
			  ->where('cat_id', '=', $cat_id)
			  ->where('sub_cat_name', '=', $sub_cat_name)
			  ->count();
	  if($count == 0 && $cat_id != "" && $sub_cat_name != ""){
		  DB::table('sub_categories')->insert(array('cat_id' => $cat_id,
		  	  'sub_cat_name' => $sub_cat_name,
		  	  'sub_cat_slug' => $sub_cat_slug));
		 return Redirect::to('administrator/add-subcategory')->with('success', true);
	  }else{
		  return Redirect::to('administrator/add-subcategory/')->with('exist', true);
	  }
	}
	
	public function viewEditSubcategory($reference_id) {
	  $data = DB::table('categories')->orderBy('cat_id', 'DESC')->pluck('category_name', 'cat_id')->prepend('Select Category...', '');
	  $subcate_data = DB::table('sub_categories')->where('sub_cat_id', '=', $reference_id)->first();
	  return view('admin.edit-subcategory')->with('subcate_data', $subcate_data)->with('data', $data);
	}
	
	public function updateSubcategory(Request $request) {
	  $reference_id = $request->input('reference_id');
	  $cat_id = $request->input('cat_id');
	  $sub_cat_name = $request->input('sub_cat_name');
	  $sub_cat_slug = str_slug($sub_cat_name, '-');
	  
	  if ($cat_id=="" || $sub_cat_name == "" || $reference_id == "") {
		return Redirect::to('administrator/edit-subcategory/' . $reference_id . '/edit')->with('blank', true);
	  }
	  
	  //Duplicate checked
	  $count = DB::table('sub_categories')
	  		->where('cat_id', '=', $cat_id)
			->where('sub_cat_name', '=', $sub_cat_name)
			->where('sub_cat_id', '<>', $reference_id)
			->count();
	  if($count>0){
		  return Redirect::to('administrator/edit-subcategory/' . $reference_id . '/edit')->with('exist', true);
	  }
	  DB::table('sub_categories')->where('sub_cat_id', '=', $reference_id)->update(array('cat_id' => $cat_id, 'sub_cat_name' => $sub_cat_name, 'sub_cat_slug' => $sub_cat_slug));
	  return Redirect::to('administrator/edit-subcategory/' . $reference_id . '/edit')->with('success', true);
	}
	
	public function deleteSubcategory($id){
	  DB::table('sub_categories')->where('sub_cat_id', '=', $id)->delete();
	  return Redirect::to('administrator/manage-subcategory');
	
	}
	
	//Manage Product
	public function viewManageProduct(){
	   $data = DB::table('products')->join('categories', 'products.prd_cat_id', '=', 'categories.cat_id')->join('sub_categories', 'products.prd_sub_cat_id', '=', 'sub_categories.sub_cat_id')->orderBy('products.prd_id', 'DESC')->get();
	   return view('admin.manage-product')->with('data', $data);
	}
	
	public function viewAddProduct() {
		$cat_det = DB::table('categories')->orderBy('cat_id', 'DESC')->pluck('category_name', 'cat_id')->prepend('Select Category...', '');
		return view('admin.add-product')->with('cat_det', $cat_det);
	}
	
	public function FindSubcategory(Request $request){
		$id = $request->input('id');
		if ($id != "") {
			$data_subcategory   = DB::table('sub_categories')->select('sub_cat_name', 'sub_cat_id')->where('cat_id', '=', $id)->get();
			$data = array(
				'data_subcategory' => $data_subcategory
			);
			echo json_encode($data); exit;
		} else {
			echo "0"; exit;
		}
	}
	
	public function saveProductData(Request $request){
	  $prd_cat_id = trim($request->input('prd_cat_id'));
	  $prd_sub_cat_id = trim($request->input('prd_sub_cat_id'));
	  $product_name = trim($request->input('product_name'));
	  $prd_slug_name = str_slug($product_name, '-');
	  $product_model = trim($request->input('product_model'));
	  $product_price = trim($request->input('product_price'));
	  $product_dp_per = trim($request->input('product_dp_per'));
	  $product_details = $request->input('product_details');
	  $prd_meta_title = trim($request->input('prd_meta_title'));
	  $prd_meta_keywords = trim($request->input('prd_meta_keywords'));
	  $prd_meta_descriptions = trim($request->input('prd_meta_descriptions'));
	  
	  if ($prd_cat_id=="" || $prd_sub_cat_id=="" || $product_name=="" || $product_model=="" || $product_price=="" || $product_dp_per=="" || $product_details=="") {
		return Redirect::to('administrator/add-product/')->with('blank', true)->withInput();
	  }
	  $product_photo = $request->file('product_photo');
	  $product_photo_filter = array_filter($product_photo);
	  $product_photo_count = count($product_photo_filter);
	  if ($product_photo_count == 0) {
		  return Redirect::to('administrator/add-product/')->with('blank', true)->withInput();
	  }
	  
	  $insta_period = $request->input('insta_period');
	  $insta_period_filter = array_filter($insta_period);
	  $result_insta_period = array_unique($insta_period_filter);
	  $insta_period_count = count($insta_period_filter);
	  if ($insta_period_count == 0) {
		  return Redirect::to('administrator/add-product/')->with('blank', true)->withInput();
	  }
	  
	  $count = DB::table('products')
			  ->where('prd_cat_id', '=', $prd_cat_id)
			  ->where('prd_sub_cat_id', '=', $prd_sub_cat_id)
			  ->where('product_name', '=', $product_name)
			  ->count();
	  if($count == 0){
		  $created_date = date("Y-m-d");
		  DB::table('products')->insert(array('prd_cat_id' => $prd_cat_id,
		  		'prd_sub_cat_id' => $prd_sub_cat_id,
				'product_name' => $product_name,
				'prd_slug_name' => $prd_slug_name,
				'product_model' => $product_model,
				'product_price' => $product_price,
				'product_dp_per' => $product_dp_per,
				'product_details' => $product_details,
				'prd_meta_title' => $prd_meta_title,
				'prd_meta_keywords' => $prd_meta_keywords,
				'prd_meta_descriptions' => $prd_meta_descriptions,
				'created_date' => $created_date,
				'updated_date' => $created_date));
				
		 $prd_id = DB::getPdo()->lastInsertId();
		 
		 if ($insta_period_count > 0) {
		  foreach ($result_insta_period as $val) {
				DB::table('product_installment_periods')->insert(array(
					'prd_id' => $prd_id,
					'insta_period' => $val
				));
			}
		  }
		  
		  if ($product_photo_count > 0) {
		  $i = 0;
		  foreach ($product_photo_filter as $val) {
			$i++;
			$ext = strtolower($val->getClientOriginalExtension());
			if ($ext == "png" || $ext == "jpg" || $ext == "jpeg") {
			  //Laravel photo cropping
			  $product_image = 'P_'.date('dmy').time().$i.'.'.$val->getClientOriginalExtension();
			  //Thumb Photo Uploading
			  $thumb_img = Image::make($val->getRealPath())->resize(600, 600);
			  $thumb_img->save(public_path() . '/product-photo/' . $product_image, 80);
					DB::table('product_photos')->insert(array(
						'prd_id' => $prd_id,
						'prd_photo' => $product_image,
						'created_on' => $created_date,
						'updated_on' => $created_date
					));
				}
			  }
		  }
		 
		 return Redirect::to('administrator/add-product')->with('success', true);
	  }else{
		  return Redirect::to('administrator/add-product/')->with('exist', true)->withInput();
	  }
	}
	
	public function viewEditProduct($reference_id) {
	  $cat_det = DB::table('categories')->orderBy('cat_id', 'DESC')->pluck('category_name', 'cat_id')->prepend('Select Category...', '');
	  $subcate_det = DB::table('sub_categories')->orderBy('sub_cat_id', 'DESC')->pluck('sub_cat_name', 'sub_cat_id')->prepend('Select Subcategory...', '');
	  $data = DB::table('products')->join('categories', 'products.prd_cat_id', '=', 'categories.cat_id')->join('sub_categories', 'products.prd_sub_cat_id', '=', 'sub_categories.sub_cat_id')->where('prd_id', '=', $reference_id)->first();
	  $prd_photo = DB::table('product_photos')->where('prd_id', '=', $reference_id)->get();
	  $installment_periods = DB::table('product_installment_periods')->where('prd_id', '=', $reference_id)->get();
	  return view('admin.edit-product')->with('cat_det', $cat_det)->with('subcate_det', $subcate_det)->with('data', $data)->with('prd_photo', $prd_photo)->with('installment_periods', $installment_periods);
	}
	
	public function deletePrdImg(Request $request){
		$id = $request->input('id');
		if($id != ""){
			$fetch_Prdimg = DB::table('product_photos')->where('prd_ph_id', '=', $id)->first();
			if ($fetch_Prdimg->prd_photo != '') {
				  $unlink_path = "public/product-photo/" . $fetch_Prdimg->prd_photo;
				  unlink($unlink_path);
			  }
			$delete_Img = DB::table('product_photos')->where('prd_ph_id', '=', $id)->delete();
			if($delete_Img){
				echo "1"; exit;
			}else{
				echo "0"; exit;	
			}
		}else{
			echo "0"; exit;	
		}
	}
	
	public function deletePip(Request $request){
		$id = $request->input('id');
		if($id != ""){
			$delete_pip = DB::table('product_installment_periods')->where('pip_id', '=', $id)->delete();
			if($delete_pip){
				echo "1"; exit;
			}else{
				echo "0"; exit;	
			}
		}else{
			echo "0"; exit;	
		}
	}
	
	public function updateProductData(Request $request){
	  $reference_id = $request->input('reference_id');
	  $prd_cat_id = trim($request->input('prd_cat_id'));
	  $prd_sub_cat_id = trim($request->input('prd_sub_cat_id'));
	  $product_name = trim($request->input('product_name'));
	  $prd_slug_name = str_slug($product_name, '-');
	  $product_model = trim($request->input('product_model'));
	  $product_price = trim($request->input('product_price'));
	  $product_dp_per = trim($request->input('product_dp_per'));
	  $product_details = $request->input('product_details');
	  $prd_meta_title = trim($request->input('prd_meta_title'));
	  $prd_meta_keywords = trim($request->input('prd_meta_keywords'));
	  $prd_meta_descriptions = trim($request->input('prd_meta_descriptions'));
	  
	  if ($prd_cat_id=="" || $prd_sub_cat_id=="" || $product_name=="" || $product_model=="" || $product_price=="" || $product_dp_per=="" || $product_details=="") {
		return Redirect::to('administrator/edit-product/' . $reference_id . '/edit')->with('blank', true)->withInput();
	  }
	  
	  $count = DB::table('products')
			  ->where('prd_cat_id', '=', $prd_cat_id)
			  ->where('prd_sub_cat_id', '=', $prd_sub_cat_id)
			  ->where('product_name', '=', $product_name)
			  ->where('prd_id', '<>', $reference_id)
			  ->count();
	  if($count == 0){
		  $updated_date = date("Y-m-d");
		  DB::table('products')->where('prd_id', '=', $reference_id)->update(array('prd_cat_id' => $prd_cat_id,
		  		'prd_sub_cat_id' => $prd_sub_cat_id,
				'product_name' => $product_name,
				'prd_slug_name' => $prd_slug_name,
				'product_model' => $product_model,
				'product_price' => $product_price,
				'product_dp_per' => $product_dp_per,
				'product_details' => $product_details,
				'prd_meta_title' => $prd_meta_title,
				'prd_meta_keywords' => $prd_meta_keywords,
				'prd_meta_descriptions' => $prd_meta_descriptions,
				'updated_date' => $updated_date));

		  $product_photo = $request->file('product_photo');
		  if($product_photo != ""){
			  $product_photo_filter = array_filter($product_photo);
			  $product_photo_count = count($product_photo_filter);
			  if ($product_photo_count > 0) {
		  $i = 0;
		  foreach ($product_photo_filter as $val) {
			$i++;
			$ext = strtolower($val->getClientOriginalExtension());
			if ($ext == "png" || $ext == "jpg" || $ext == "jpeg") {
			  //Laravel photo cropping
			  $product_image = 'P_'.date('dmy').time().$i.'.'.$val->getClientOriginalExtension();
			  //Thumb Photo Uploading
			  $thumb_img = Image::make($val->getRealPath())->resize(600, 600);
			  $thumb_img->save(public_path() . '/product-photo/' . $product_image, 80);
					DB::table('product_photos')->insert(array(
						'prd_id' => $reference_id,
						'prd_photo' => $product_image,
						'created_on' => $updated_date,
						'updated_on' => $updated_date
					));
				}
			  }
		  }
		  }
		  
		  $insta_period = $request->input('insta_period');
		  if($insta_period != ""){
			  $insta_period_filter = array_filter($insta_period);
			  $result_insta_period = array_unique($insta_period_filter);
			  $insta_period_count = count($insta_period_filter);
			  if ($insta_period_count > 0) {
		  foreach ($result_insta_period as $val) {
				DB::table('product_installment_periods')->insert(array(
					'prd_id' => $reference_id,
					'insta_period' => $val
				));
			}
		  }
		  }
	  
		 return Redirect::to('administrator/edit-product/' . $reference_id . '/edit')->with('success', true);
	  }else{
		  return Redirect::to('administrator/edit-product/' . $reference_id . '/edit')->with('exist', true)->withInput();
	  }
	
	}
	
	public function deleteProduct($id){
	  $prd_data = DB::table('product_photos')->where('prd_id', '=', $id)->get();
	  foreach($prd_data as $res_prd_photo){
		  $unlink_path_icon = "public/product-photo/" . $res_prd_photo->prd_photo;
		  unlink($unlink_path_icon);
	  }
	  DB::table('product_photos')->where('prd_id', '=', $id)->delete();
	  DB::table('product_installment_periods')->where('prd_id', '=', $id)->delete();
	  DB::table('products')->where('prd_id', '=', $id)->delete();
	  return Redirect::to('administrator/manage-product');
	}

	public function prdActiveStatus(Request $request){
	  $prdId = $request->input('prdId');
	  if ($prdId != '') {
			  $status = DB::table('products')->where('prd_id', '=', $prdId)->update(array('active_status' => '1'));
			  if($status){
				  echo "1"; exit;
			  }else{
				  echo "0"; exit;
			  }
		  } else {
		  echo "0"; exit;
	  }
    }

	public function prdDeactiveStatus(Request $request){
	  $prdId = $request->input('prdId');
	  if ($prdId != '') {
		 $status = DB::table('products')->where('prd_id', '=', $prdId)->update(array('active_status' => '0'));
		 if($status){
			  echo "1"; exit;
		 }else{
			  echo "0"; exit;
		 }
	  } else {
		  echo "0"; exit;
	  }
    }

	  
	//Manage Users
	public function viewManageUsers() {
	   $data = DB::table('user_registration')->orderBy('user_id', 'DESC')->get();
	   return view('admin.manage-users')->with('data', $data);
	}
	
	public function blockUser($id) {
		DB::table('user_registration')->where('user_id', '=', $id)->update(array('user_status' => 1));
		return Redirect::to('administrator/manage-users');
	}
  
	public function unblockUser($id) {
		DB::table('user_registration')->where('user_id', '=', $id)->update(array('user_status' => 0));
		return Redirect::to('administrator/manage-users');
	}
	
	public function deleteUser($id) {
		DB::table('user_registration')->where('user_id', '=', $id)->delete();
		return Redirect::to('administrator/manage-users');
	}
	
	public function viewUserDetails($id) {
		$data = DB::table('user_registration')->where('user_id', '=', $id)->get();
		return view('admin.user-details')->with('data', $data);
	}
  
	//Manage Orders
	public function viewManageOrders() {
	   $data = DB::table('master_order')->where('transaction_id','!=','null')->orderBy('order_id', 'DESC')->get();
	   return view('admin.manage-orders')->with('data', $data);
	}
	
	public function viewOrderDetails($id) {
		$order_info = DB::table('master_order')
				->where('order_id', '=', $id)
				->get();
				
		$payment_det = DB::table('payment_settings')
				->where('id', '=', 1)
				->first();
		
		$prd_dtls = DB::table('products')
		->join('product_photos', 'product_photos.prd_id', '=', 'products.prd_id')
		->where('products.prd_id', '=',$order_info[0]->order_prd_id)
		->orderBy('products.prd_id', 'DESC')
		->groupBy('product_photos.prd_id')
		->select('products.*', 'product_photos.prd_photo')
        ->get();
					
		$insta_dtls = DB::table('user_installments')
					->where('user_id', '=' ,$order_info[0]->user_id)
					->where('ord_id', '=' ,$id)
					->where('trns_id', '!=' ,null)
					->where('intsa_status', '=' ,'Paid')
					->orderBy('insta_id', '=' ,'DESC')
					->get();
		
		$user_dtls = DB::table('user_registration')
					->select('paypal_email_user')
					->where('user_id', '=' ,$order_info[0]->user_id)
					->first();	
					
								
		//print_r($insta_dtls);exit;
		$total_installment = $insta_dtls->sum('insta_amt');
		
		$total_paid_still_now = $order_info[0]->dp_amount+$total_installment;
		$due = $order_info[0]->total_amount - $total_paid_still_now;
				
		
		return view('admin.order-details', compact('order_info','insta_dtls','total_installment','due','prd_dtls','payment_det','user_dtls'));
	}
	
	public function updateOrderStatus(Request $request) {
		$reference_id = $request->input('reference_id');
		$order_status = $request->input('order_status');
		$ship_date = date("Y-m-d");
		
		if ($order_status=="Not yet shipped") {
		  return Redirect::to('administrator/order-details/' . $reference_id . '/details')->with('cos', true);
		}
		
		DB::table('master_order')->where('order_id', '=', $reference_id)->update(array('order_status' => $order_status, 'ship_date' => $ship_date));
		
		//Order Details
		$order_det = DB::table('master_order')->where('order_id','=',$reference_id)->get();
		//print_r($order_det);exit;
		$user_email = $order_det[0]->email;
		$user_name = $order_det[0]->bill_full_name;
		   
		
		// Admin Details
		$admin_det = Helpers::getAdminDetails();
		$admin_name = $admin_det[0]->admin_name;
		$admin_email = $admin_det[0]->alt_email;
			
		$current_year = date("Y");
  
		# Subject
		$subject = "Lay Buys :: Your order has been despatched.";
		
		//Email Template Details
		$res_template = DB::table('email_template')->where('id', '=', 5)->get();
		$input = $res_template[0]->contents;
  
	   
		$body = str_replace(array('%USERNAME%', '%ORDERNUMBER%','%ADMINNAME%','%ADMINEMAIL%','%CURRENTYEAR%'), array($user_name,$reference_id,$admin_name,$admin_email, $current_year), $input);
		//echo $body;exit;
		
		/*$content = [
				'title'=> 'ok',
				'subject'=> $subject,
				'body'=> $body,
				'email_template' => 'emails.common_mail',
				'from_email' => $admin_email];
		
		$ok=Mail::to($user_email)->send(new MailBuilder($content));*/
		
		
		$headers = "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=UTF-8\n";
		$headers .= "From:" . $admin_name . " < " . $admin_email . ">\n";
		
		$ok = mail($user_email, $subject, $body, $headers);
		  
		return Redirect::to('administrator/order-details/' . $reference_id . '/details')->with('success', true);
	}
	
	public function deleteOrder($id) {
		DB::table('master_order')->where('order_id', '=', $id)->delete();
		DB::table('order_items')->where('order_id', '=', $id)->delete();
		return Redirect::to('administrator/manage-orders');
	}
	
	public function printOrderDetails($id) {
		$admin_det = Helpers::getAdminDetails();
		
		$order_info = DB::table('master_order')
				->where('order_id', '=', $id)
				->get();
				
		$payment_det = DB::table('payment_settings')
				->where('id', '=', 1)
				->first();
		
		$prd_dtls = DB::table('products')
		->join('product_photos', 'product_photos.prd_id', '=', 'products.prd_id')
		->where('products.prd_id', '=',$order_info[0]->order_prd_id)
		->orderBy('products.prd_id', 'DESC')
		->groupBy('product_photos.prd_id')
		->select('products.*', 'product_photos.prd_photo')
        ->get();
					
		$insta_dtls = DB::table('user_installments')
					->where('user_id', '=' ,$order_info[0]->user_id)
					->where('ord_id', '=' ,$id)
					->where('trns_id', '!=' ,null)
					->where('intsa_status', '=' ,'Paid')
					->orderBy('insta_id', '=' ,'DESC')
					->get();
					
		//print_r($insta_dtls);exit;
		$total_installment = $insta_dtls->sum('insta_amt');
		
		$total_paid_still_now = $order_info[0]->dp_amount+$total_installment;
		$due = $order_info[0]->total_amount - $total_paid_still_now;
				
		
		return view('admin.print-order-details', compact('order_info','insta_dtls','total_installment','due','prd_dtls','payment_det','admin_det'));
		
	    //return view('admin.print-orders-details')->with('data', $data);
	}
	
	public function viewReturnMoney(Request $request) {
		$prd_id = $request->input('prd_id');
		$ord_id = $request->input('ord_id');
		$returning_amount = $request->input('returning_amount');
		$paypal_email_user = $request->input('paypal_email_user');
		
		//echo $prd_id."---".$ord_id."---".$returning_amount;exit;
		
		if($prd_id=="" || $ord_id=="" || $returning_amount=="" || $paypal_email_user==""){
			return Redirect::to('administrator/manage-orders');
		}else{
			Session::put('prd_id',$prd_id);
			Session::put('order_id',$ord_id);
			Session::put('returning_amount',$returning_amount);
			Session::put('paypal_email_user',$paypal_email_user);
			
			return view('admin.rm-paypal');
		}
	}
	
	public function updateReturnMoneyTransactionDetails() {
		/*$fp=fopen("ipnresult_cancel.txt","w");
		foreach($_POST as $key => $value){
			fwrite($fp,$key.'===='.$value."\n");
		}*/
		
		//$custom = 4;
		//$txn_id="TXN567OKL";
		
		$custom=$_POST['custom'];
		$txn_id=$_POST['txn_id'];
		$return_amount = $_POST['mc_gross'];

		//Update Paypal Transaction ID
		DB::table('master_order')->where('order_id', $custom)->update(array('cancel_trans_id' => $txn_id,'cancel_amount' => $return_amount));
		
		
		//######################RETURN MONEY mail goes to user#################
		
		$order_info = DB::table('master_order')
					->where('order_id', '=' ,$custom)
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
		$subject = "Lay Buys :: Money Returned to your account";
		
		//Email Template Details
		$res_template = DB::table('email_template')->where('id', '=', 9)->get();
		$input = $res_template[0]->contents;

	   
		$body_user = str_replace(array('%USERNAME%','%ORDERID%','%ADMINNAME%','%ADMINEMAIL%','%CURRENTYEAR%'), array($user_name,$custom,$admin_name,$admin_email, $current_year), $input);
	   //echo $body_admin;exit;
		
		$headers = "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/html; charset=UTF-8\n";
		$headers .= "From:" . $admin_name . " < " . $admin_alt_email . ">\n";
		
		$ok = mail($user_email, $subject, $body_user, $headers);
		
		
		Session::forget('prd_id');
		Session::forget('order_id');
		Session::forget('returning_amount');
		Session::forget('paypal_email_user');


	}
	
 
}
