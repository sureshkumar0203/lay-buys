<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class paymentTestingController extends Controller
{
    public function showPaymentPagePaypal(){
		return view('paypal-payment');
	}

	public function updateTransactionDetails(){
		$fp=fopen("ipnresult.txt","w");
		foreach($_POST as $key => $value){
			fwrite($fp,$key.'===='.$value."\n");
		}
	}

	public function showThankYou(){
		return view('thank-you-stl');
	}

	public function showPaymentFailed(){
		return view('payment-failed-stl');
	}
}
