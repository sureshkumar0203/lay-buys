<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Helpers;
use View;
use DB;
use Request;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		$admin_det = Helpers::getAdminDetails();
        
        $seo_info = DB::table('seo')->where('id','=','1')->get();
		$top_cat_info = DB::table('categories')->orderBy('category_name', 'ASC')->get();
		$req_file_name = Request::path();
		
		//echo $request->path();exit;
		$uri_ary = explode('/', $req_file_name);
		if($uri_ary[0]=='subcategory'){
		  $sub_cat_sec= $uri_ary[2];
		  
		  $uri = explode('-', $sub_cat_sec);
		  $sub_cat_id_selected = array_pop($uri);
		}else{
		  $sub_cat_id_selected =0;
		}
		View::share(['admin_det'=>$admin_det,'seo_info'=>$seo_info,'req_file_name'=>$req_file_name,'top_cat_info'=>$top_cat_info,'sub_cat_id_selected'=>$sub_cat_id_selected]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
