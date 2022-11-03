@extends('includes.master')

@section('title') {{ $seo_info[0]->meta_title }} @stop
@section('keywords'){{ $seo_info[0]->meta_keyword }} @stop
@section('description'){{ $seo_info[0]->meta_descr }} @stop

@section('content')
<div class="main-blog-page blog-post-area mt-50">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <!--<div class="entry-content pt-30">asdsa</div>-->
        <div class="checkout-area">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                      <span id="msg_div"></span>
                  </div>
                  
                  @php
                  if(Session::get('user_id')!=''){
                  	$user_details = Helpers::getUserDetails();
                  }
                  @endphp
                  
                  
                  
                  
                  {{ Form::open(array('url' => 'confirm-order-process', 'role' => 'form', 'class' =>'', 'name' => 'frm_po', 'id' => 'frm_po','files'=>true, 'autocomplete' => 'off','onSubmit'=>'return validatePlaceOrder();')) }}
                     <!--Billing Address DIV-->
                     <div class="col-md-6">
                     
                 
                        <div class="checkbox-form">
                           <div class="col-md-12"><h3>Billing Details</h3></div>
                              <div class="col-md-12">
                        
                              
                                 <div class="checkout-form-list">
                                    <label>Name <span class="required">*</span></label>
                                    {!! Form::text('full_name',(Session::get('user_id'))?$user_details[0]->full_name:old('full_name'), array('id' => 'full_name','required','class'=>'','placeholder'=>'','autocomplete' => 'off')) !!}
                                 </div>
                                 </div>
                           
                              
                              <div class="col-md-6">
                                 <div class="checkout-form-list">
                                    <label>Email Address <span class="required">*</span></label>	
                                    {!! Form::email('email',(Session::get('user_id'))?$user_details[0]->email:old('email'), array('id' => 'email','required','class'=>'','placeholder'=>'','autocomplete' => 'off', 'readonly'=>'readonly')) !!}
                                 </div>
                              </div>
                              
                              <div class="col-md-6">
                                 <div class="checkout-form-list">
                                    <label>Contact No.  <span class="required">*</span></label>										
                                    {!! Form::text('contact_no',(Session::get('user_id'))?$user_details[0]->contact_no:old('contact_no'), array('id' => 'contact_no','maxlength' => 14,'required','class'=>'','placeholder'=>'','autocomplete' => 'off','onKeyUp' => 'validatephone(this)')) !!}
                                 </div>
                              </div>
                              
                              <div class="col-md-12">
                                 <div class="checkout-form-list">
                                    <label>Address <span class="required">*</span></label>
                                    {!! Form::text('address1',(Session::get('user_id'))?$user_details[0]->address1:old('address1'), array('id' => 'address1','required','class'=>'','placeholder'=>'Street address','autocomplete' => 'off')) !!}
                                 </div>
                              </div>
                              
                              <div class="col-md-12">
                                 <div class="checkout-form-list">
                                 {!! Form::text('address2',(Session::get('user_id'))?$user_details[0]->address2:old('address2'), array('id' => 'address2','class'=>'','placeholder'=>'Apartment, suite, unit etc. (optional)','autocomplete' => 'off')) !!}
                                 </div>
                              </div>
                           	  
                              <div class="col-md-6">
                                 <div class="checkout-form-list">
                                    <label>Town  <span class="required"></span></label>										
                                     {!! Form::text('town',(Session::get('user_id'))?$user_details[0]->town:old('town'), array('id' => 'town','','class'=>'','placeholder'=>'','autocomplete' => 'off')) !!}
                                 </div>
                              </div>
                              
                              
                              <div class="col-md-6">
                                 <div class="checkout-form-list">
                                    <label>City <span class="required"></span></label>										
                                     {!! Form::text('city',(Session::get('user_id'))?$user_details[0]->city:old('city'), array('id' => 'city','','class'=>'','placeholder'=>'','autocomplete' => 'off')) !!}
                                 </div>
                              </div>
                              
                              <div class="col-md-6">
                                 <div class="checkout-form-list">
                                    <label>Postcode  <span class="required">*</span></label>
                                    {!! Form::text('post_code',(Session::get('user_id'))?$user_details[0]->post_code:old('post_code'), array('id' => 'post_code','required','maxlength' => 7,'class'=>'','placeholder'=>'','autocomplete' => 'off')) !!}									
                                 </div>
                              </div>
                           </div>
                      
                          
                          
                           <div class="different-address">
                           
                           <div class="col-md-12 mt-30">
                              <div class="ship-different-title">
                                 <h3>
                                    <label>Ship to a different address?</label>
                                     {!! Form::checkbox('same_for_billing', '1', false, array('id' => 'same_for_billing', 'class' => '', 'onclick'=>'showShippingAddress()' )) !!}
                                 </h3>
                              </div>
                              </div>
                              
                              <!--Shipping Address DIV-->
                              <div id="ship-box-info">
                                
                                <div class="col-md-6">
                                
                                 <div class="checkout-form-list">
                                    <label>Name <span class="required">*</span></label>
                                    {!! Form::text('ship_full_name',(Session::get('user_id'))?$user_details[0]->ship_full_name:old('ship_full_name'), array('id' => 'ship_full_name','class'=>'','placeholder'=>'','autocomplete' => 'off')) !!}
                                 </div>
                                </div>
                              
                                <div class="col-md-6">
                                   <div class="checkout-form-list">
                                      <label>Contact No.  <span class="required">*</span></label>										
                                      {!! Form::text('ship_contact_no',(Session::get('user_id'))?$user_details[0]->ship_contact_no:old('ship_contact_no'), array('id' => 'ship_contact_no','maxlength' => 14,'class'=>'','placeholder'=>'','autocomplete' => 'off','onKeyUp' => 'validatephone(this)')) !!}
                                   </div>
                                </div>
                                
                                <div class="col-md-12">
                                   <div class="checkout-form-list">
                                      <label>Address <span class="required">*</span></label>
                                      {!! Form::text('ship_address1',(Session::get('user_id'))?$user_details[0]->ship_address1:old('ship_address1'), array('id' => 'ship_address1','class'=>'','placeholder'=>'Street address','autocomplete' => 'off')) !!}
                                   </div>
                                </div>
                                
                                <div class="col-md-12">
                                   <div class="checkout-form-list">
                                   {!! Form::text('ship_address2',(Session::get('user_id'))?$user_details[0]->ship_address2:old('ship_address2'), array('id' => 'ship_address2','class'=>'','placeholder'=>'Apartment, suite, unit etc. (optional)','autocomplete' => 'off')) !!}
                                   </div>
                                </div>
                                
                                <div class="col-md-6">
                                   <div class="checkout-form-list">
                                      <label>Town <span class="required"></span></label>										
                                       {!! Form::text('ship_town',(Session::get('user_id'))?$user_details[0]->ship_town:old('ship_town'), array('id' => 'ship_town','class'=>'','placeholder'=>'','autocomplete' => 'off')) !!}
                                   </div>
                                </div>
                                
                                
                                <div class="col-md-6">
                                   <div class="checkout-form-list">
                                      <label>City <span class="required"></span></label>										
                                       {!! Form::text('ship_city',(Session::get('user_id'))?$user_details[0]->ship_city:old('ship_city'), array('id' => 'ship_city','class'=>'','placeholder'=>'','autocomplete' => 'off')) !!}
                                   </div>
                                </div>
                                
                                <div class="col-md-6">
                                   <div class="checkout-form-list">
                                      <label>Postcode  <span class="required">*</span></label>
                                      {!! Form::text('ship_post_code',(Session::get('user_id'))?$user_details[0]->ship_post_code:old('ship_post_code'), array('id' => 'ship_post_code','maxlength' => 7,'class'=>'','placeholder'=>'','autocomplete' => 'off')) !!}									
                                   </div>
                                </div>
                              </div>
                           </div>
                        </div>
                    
                     
                     <!--Order Details DIV-->
                     <div class="col-md-6">
                        <div class="your-order">
                           <h3>Your order</h3>
                           <div class="your-order-table table-responsive">
                              <table class="con-ord">
                                  <tr class="cart_item">
                                    <td colspan="2" class="product-name"><strong>{{ $prd_dtls->product_name }}</strong></td>
                                    </tr>
                                    <tr class="cart_item">
                                      <td colspan="2" class="product-name"><strong>Model :</strong> {{ $prd_dtls->product_model }}</td>
                                    </tr>
                                    <tr class="cart_item">
                                      <td class="product-name"><strong>Price</strong></td>
                                      <td class="product-total">&pound; {{ number_format($prd_dtls->product_price,2,'.','') }}</td>
                                    </tr>
                                    <tr class="cart_item">
                                      <td class="product-name"><strong>Instalment Periods</strong></td>
                                      <td class="product-total">{{ Session::get('sel_ips') }} Weeks</td>
                                    </tr>
                                   
                                   <tr class="order-total" style="border-top:solid 1px #000;">
                                       <td colspan="2" height="1"></td>
                                    </tr>
                                    
                                    <tr class="cart_item">
                                      <td class="product-name"><strong>Down Payment ( {{ $prd_dtls->	product_dp_per }} % )</strong></td>
                                      <td class="product-total">&pound; {{ $down_payment }}</td>
                                    </tr>
                                    
                                    
                                   <tr class="order-total" style="border-top:solid 1px #000 !important;">
                                       <td align="left" valign="middle" style="text-align: left;">&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                              
                              </table>
                     	   </div>
                           
                           <div class="payment-method">                              
                              <div class="order-button-payment">
                                 {{ Form::submit('Place order', array('id'=>'pla_ord','class' => '','style' =>'width:100%; margin-bottom:15px;')) }}
                              </div>
                           </div>
                        </div>
                     </div>
                     
                  {{ Form::close() }}
                  
                 </div>
               </div>
            </div>
         </div>
      </div>
    </div>
  </div>
</div>
@stop 