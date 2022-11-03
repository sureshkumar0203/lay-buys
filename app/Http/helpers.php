<?php
class Helpers {
	//Genrate Key for url passing
	public static function keyMaker($id){ 
		$secretkey='1HutysK98UuuhDasdfafdCrackThisBeeeeaaaatchkHgjsheIHFH44fheo1FhHEfo2oe6fifhkhs'; 
		$key=md5($id.$secretkey); 
		return $key; 
	}
	
	public static function getAdminDetails() {
		$admin_det = DB::table('core')->where('id', '>', 0)->get();
		return $admin_det;
    }
	
	public static function getTemplateDetails($template_id) {
		$templ_det = DB::table('email_template')->where('id', '=', $template_id)->get();
		return $templ_det;
    }
	
	public static function getSeoDetails() {
		$seo_det = DB::table('seo')->where('id', '>', 0)->get();
		return $seo_det;
    }
	
	public static function getPaymentDetails() {
		$payment_det = DB::table('payment_settings')->where('id', '>', 0)->get();
		return $payment_det;
    }
	
	
	
	public static function getUserDetails() {
		$user_id = Session::get('user_id');
		$user_data = DB::table('user_registration')->where('user_id', '=', $user_id)->get();
		return $user_data;
    }
	
	public static function createRandomPassword(){
		$chars = "abcdefghijkmnopqrstuvwxyz023456789ABCDEWFGHJKLMNOPQRSTUVWXYZ";
		srand((double)microtime()*1000000);
		$i = 0;
		$pass = '' ;		
		while ($i <= 6){
			$num = rand() % 70;
			$tmp = substr($chars, $num, 1);
			$pass = $pass . $tmp;
			$i++;
		 }
		return $pass;
	}
	
	public static function createHighSecurityPassword(){
		$upcase = "ABCDEFGHIJKLMNPQRSTUVWXYZ";
		$lowercase = "abcdefghijklmnpqrstuvwxyz";
		$digit = "123456789";
		$special = "!@#$%^&*";
		
		$gen_up_case = substr(str_shuffle($upcase),0,2);
		$gen_low_case = substr(str_shuffle($lowercase),0,2);
		$gen_digit = substr(str_shuffle($digit),0,2);
		$gen_special = substr(str_shuffle($special),0,2);
		
		$mixed = $gen_up_case.$gen_low_case.$gen_digit.$gen_special;
		$final_psw = str_shuffle($mixed);
		
		return $final_psw;
	}
	
	
	public static function randomPassword($len = 8) {
	  //enforce min length 8
	  if($len < 8)
		  $len = 8;
  
	  //define character libraries - remove ambiguous characters like iIl|1 0oO
	  $sets = array();
	  $sets[] = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
	  $sets[] = 'abcdefghjkmnpqrstuvwxyz';
	  $sets[] = '23456789';
	  $sets[]  = '~!@#$%^&*(){}[],./?';
  
	  $password = '';
	  
	  //append a character from each set - gets first 4 characters
	  foreach ($sets as $set) {
		  $password .= $set[array_rand(str_split($set))];
	  }
  
	  //use all characters to fill up to $len
	  while(strlen($password) < $len) {
		  //get a random set
		  $randomSet = $sets[array_rand($sets)];
		  
		  //add a random char from the random set
		  $password .= $randomSet[array_rand(str_split($randomSet))]; 
	  }
	  
	  //shuffle the password string before returning!
	  return str_shuffle($password);
	}
	
	public static function cmsPages(){
		$pages = DB::table('contents')->get();
		return $pages;
	}

	public static function aboutCmsPages(){
		$aboutAages = DB::table('contents')->where('id', '=', '1')->first();
		return $aboutAages;
	}

}
?>