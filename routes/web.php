<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('dp-notify-paypal', 'homeController@updateDownPaymentTransactionDetails');


Route::get('/', 'homeController@showHome');

Route::get('contact-us', 'homeController@viewContactUs');
Route::post('contact-us', 'homeController@sendContactUsMail');

Route::get('category/{slug}-{cat_id}', 'homeController@viewProductsCategoryWise');

Route::get('subcategory/{slug_cat}-{cat_id}/{slug_sub_cat}-{sub_cat_id}', 'homeController@viewProductsCategorySubcategoryWise');

//User Registration
Route::get('user-signup', 'homeController@viewUserSignUp');
Route::get('popup-terms-cond', 'homeController@displayTermsCondsPage');
Route::post('user-signup', 'homeController@saveUserData');
Route::get('registration-completed', 'homeController@viewUserSignUpCompleted');

//Registration email Confirmation
Route::get('{user_email}/confirm-email', 'homeController@confiemEmailAddress');
Route::get('registration-success', 'homeController@viewConfiemEmailAddress');


//User Login & logout
Route::get('login-page', 'homeController@displayLoginPage');
Route::post('user-login', 'homeController@checkLogin');
Route::get('user-logout', 'homeController@userLogout');


//User forgot password
Route::post('user-forgot-password', 'homeController@userForgotPassword');

Route::get('product-details/{slug}-{prd_id}', 'homeController@viewProductDetails');

//Cms Page
Route::get('cms/{slug}', 'homeController@cmsPages');


//FOR STL TESTING
Route::get('paypal-testing-stl', 'paymentTestingController@showPaymentPagePaypal');
Route::get('thank-you-stl', 'paymentTestingController@showThankYou');
Route::get('payment-failed-stl', 'paymentTestingController@showPaymentFailed');
//FOR STL TESTING


Route::group(['middleware' => ['checkuserlogin']], function() {
  Route::get('my-account', 'homeController@showMyAccount');
  
  Route::post('order-process', 'homeController@orderProcess');
  Route::get('confirm-order', 'homeController@showConfirmOrder');
  Route::post('confirm-order-process', 'homeController@confirmOrderProcess');
  
  Route::get('dp-paypal', 'homeController@showDownPaymentPaypal');
  Route::get('dp-thank-you', 'homeController@showDownPaymentThankYou');
  Route::get('dp-payment-failed', 'homeController@showDownPaymentFailed');
  Route::get('order-details-{id}', 'homeController@showDownPaymentOrderDetail');
  
  Route::post('installment-process', 'homeController@installmentProcess');
  Route::get('installment-paypal', 'homeController@showInstallmentPaypal');
  Route::get('installment-thank-you', 'homeController@showInstallmentThankYou');
  Route::get('installment-payment-failed', 'homeController@showInstallmentFailed');
  
  Route::get('profile-settings', 'homeController@viewProfileSettings');
  Route::post('profile-settings', 'homeController@updateProfileSettings');
  
  Route::get('change-password', 'homeController@viewChangePassword');
  Route::post('change-password', 'homeController@saveChangePassword');
  
  Route::get('cancel-order-{id}', 'homeController@cancelOrder');
});

Route::post('weekly-payment-calc', 'homeController@calculateWeeklyPayment');


















/*Route::post('save-nl-data', 'homeController@saveNewsletterData');

Route::get('products', 'homeController@getAllProducts');
Route::post('products', 'homeController@getAllProducts');

Route::get('cart', 'homeController@viewCart');
Route::post('add-to-cart', 'homeController@addToCart');

Route::get('delete-cart-item-{cart_id}', 'homeController@deleteItemFromTopCart');
Route::post('delete-item','homeController@deleteItemFromCart');

Route::post('update-qty','homeController@updateCartItem');

Route::post('check-coupon','homeController@checkCouponCode');

Route::get('show-shipping-price', 'homeController@showShippingPrice');



Route::post('place-order-process', 'homeController@placeOrder');

Route::get('paypal', 'homeController@showPaypal');




Route::get('thank-you', 'homeController@showThankYou');
Route::get('payment-failed', 'homeController@showPaymentFailed');

Route::get('login', 'homeController@viewLogin');
Route::post('user-login-process', 'homeController@userLogin');

Route::post('user-forgot-password', 'homeController@userForgotPassword');


Route::get('my-account', 'homeController@showMyAccount')->middleware('checkuserlogin');

Route::get('user-edit-profile', 'homeController@viewUserProfile')->middleware('checkuserlogin');
Route::post('update-user-profile', 'homeController@updateUserProfile')->middleware('checkuserlogin');

Route::get('user-logout', 'homeController@userLogout');*/


/************************************************************************************************************
#################################### ADMIN CONTROLLER STARTS HERE ###########################################
************************************************************************************************************/

//Admin Login
Route::get('administrator', 'adminController@viewLogin');
Route::post('admin-login','adminController@adminLogin');

//Admin Logout
Route::get('administrator/logout', array('uses' => 'adminController@logout'));

//forgot password - Admin
Route::get('administrator/forgot-psw-admin', function(){	
	return View::make('admin.forgot-psw-admin');
});
Route::post('admin-forgot-psw-process','adminController@adminPswRecovery');


Route::group(['middleware' => ['checkadminlogin']], function() {
  //Admin Dashboard
  Route::get('administrator/dashboard', function(){
	  return View::make('admin.dashboard'); 
  });
  
  //My Account
  Route::get('administrator/my-account', 'adminController@viewAdminAccount');
  Route::post('update-admin-details','adminController@updateAdminDetails');
  
  //Changa Password
  Route::get('administrator/change-password-admin', 'adminController@viewChangePassword');
  Route::post('change-admin-psw', 'adminController@changeAdminPsw');
  
  //Manage SEO
  Route::get('administrator/manage-seo', 'adminController@viewManageSeo');
  Route::post('update-seo-details','adminController@updateSeoDetails');
  
  
  //Manage Payment Settings
  Route::get('administrator/payment-setting', 'adminController@viewManagePayment');
  Route::post('update-payment-setting','adminController@updatePaymentSetting');
  
  
  //Manage Contents
  Route::get('administrator/manage-contents', 'adminController@viewManageContents');
  Route::get('administrator/add-content', 'adminController@viewAddContent');
  Route::post('add-content', 'adminController@saveContent');
  Route::get('administrator/edit-content/{id}/edit', 'adminController@viewEditContent');
  Route::post('update-content', 'adminController@updateContent');
 Route::get('administrator/manage-contents/{id}/delete', 'adminController@deleteContents');
  
  //Manage Banners
  Route::get('administrator/manage-banners', 'adminController@viewManageBanners');
  
  Route::get('administrator/add-banner', 'adminController@viewAddBanner');
  Route::post('add-banner', 'adminController@saveBannerData');
  
  Route::get('administrator/edit-banner/{id}/edit', 'adminController@viewEditBanner');
  Route::post('update-banner', 'adminController@updateBanner');
  
  Route::get('administrator/manage-banners/{id}/delete', 'adminController@deleteBanner');
  
  //Manage Category
  Route::get('administrator/manage-category', 'adminController@viewManageCategory');
  
  Route::get('administrator/add-category', 'adminController@viewAddCategory');
  Route::post('add-category', 'adminController@saveCategoryData');
  
  Route::get('administrator/edit-category/{id}/edit', 'adminController@viewEditCategory');
  Route::post('update-category', 'adminController@updateCategory');
  
  Route::get('administrator/manage-category/{id}/delete', 'adminController@deleteCategory');
  
  //Manage Subcategory
  Route::get('administrator/manage-subcategory', 'adminController@viewManageSubcategory');
  
  Route::get('administrator/add-subcategory', 'adminController@viewAddSubcategory');
  Route::post('add-subcategory', 'adminController@saveSubcategoryData');
  
  Route::get('administrator/edit-subcategory/{id}/edit', 'adminController@viewEditSubcategory');
  Route::post('edit-subcategory', 'adminController@updateSubcategory');
  
  Route::get('administrator/manage-subcategory/{id}/delete', 'adminController@deleteSubcategory');
  
  //Manage Product
  Route::get('administrator/manage-product', 'adminController@viewManageProduct');
  
  Route::get('administrator/add-product', 'adminController@viewAddProduct');
  Route::post('findsubcategory', 'adminController@FindSubcategory');
  Route::post('add-product', 'adminController@saveProductData');
  
  Route::get('administrator/edit-product/{id}/edit', 'adminController@viewEditProduct');
  Route::post('removePrdImg', 'adminController@deletePrdImg');
  Route::post('removePip', 'adminController@deletePip');
  Route::post('edit-product', 'adminController@updateProductData');
  
  Route::get('administrator/manage-product/{id}/delete', 'adminController@deleteProduct');

  Route::post('prdActive_Status', 'adminController@prdActiveStatus');
  Route::post('prdDeactive_Status', 'adminController@prdDeactiveStatus');
  
  
  //Manage Users
  Route::get('administrator/manage-users', 'adminController@viewManageUsers');
  
  Route::get('administrator/user-details/{id}/details', 'adminController@viewUserDetails');
  
  Route::get('administrator/manage-users/{id}/delete', 'adminController@deleteUser');
  
  Route::get('administrator/manage-users/{id}/block', 'adminController@blockUser');
  Route::get('administrator/manage-users/{id}/unblock', 'adminController@unblockUser');
  
  
  //Manage Orders
  Route::get('administrator/manage-orders', 'adminController@viewManageOrders');
  Route::get('administrator/order-details/{id}/details', 'adminController@viewOrderDetails');
  Route::post('update-order-status', 'adminController@updateOrderStatus');
  //Route::get('administrator/manage-orders/{id}/delete', 'adminController@deleteOrder');
  Route::get('administrator/print-order-details/{id}', 'adminController@printOrderDetails');
  
  
  //Return cancel order money
  Route::post('return-money-process', 'adminController@viewReturnMoney');
  //Route::get('administrator/rm-paypal', 'adminController@showInstallmentPaypal');
  //Route::get('administrator/rm-thank-you', 'adminController@showReturnMoneyThankYou');
  Route::get('administrator/rm-payment-failed', 'adminController@showReturnMoneyFailed');
  
  
});