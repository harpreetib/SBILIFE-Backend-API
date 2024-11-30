<?php
if(empty($paymentResponse)){
    
    $url='https://'.request()->getHost().'/registration';
	header("Location: $url");
	exit;
	
}


$status="Failed";
if(isset($paymentResponse['status']) && $paymentResponse['status']=='paid'){
	$status="Successful";
}
?>

@extends('layouts.master')
@section('page-css')

<link rel="stylesheet" href="{{asset('assets/styles/vendor/ladda-themeless.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/styles/vendor/quill.bubble.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/quill.snow.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/sweetalert2.min.css')}}">


<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js" integrity="sha512-vUJTqeDCu0MKkOhuI83/MEX5HSNPW+Lw46BA775bAWIp1Zwgz3qggia/t2EnSGB9GoS2Ln6npDmbJTdNhHy1Yw==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" integrity="sha512-zxBiDORGDEAYDdKLuYU9X/JaJo/DPzE42UubfBw9yg8Qvb2YRRIQ8v4KsGHOx2H1/+sdSXyXxLXv5r7tHc9ygg==" crossorigin="anonymous" />

<style>
    .divide{
        border-top: 1px solid #dee2e6;
        padding-top: 5px;
    }
</style>
<style>
    .multiselect-container .checkbox input{    position: inherit;
    opacity: 1;
    height: auto;
    width: auto;}
    
    .my-multiselect .btn-default {
      background: #f8f9fa;
    border: 1px solid #ced4da;
    color: #47404f;
    padding: 6px 10px 2px 10px;
    height: auto;
    width:100%;

    border-radius: 4px !important;
}
.breadcrumb ul li {
    display: inline;
    position: relative;
    padding: 0 0.5rem;
    line-height: 1;
    vertical-align: bottom;
    color: #70657b;
}
</style>
@endsection

@section('main-content')

<div id="spinner" style="display:none;z-index: 99999;position: fixed;background: black;width: 100%;height: 100%;opacity: 0.39;">
		<div class="spinner-border text-success" style="margin-top: 20%;margin-left: 44%;"></div>
</div>

            <div class="breadcrumb">
                <h1>Payment</h1>
                <ul>
                  <li>Response</li>
                </ul>

            </div>
            <div class="separator-breadcrumb border-top"></div>
            
           
            
            <div class="row mb-4">
              
                


                <div class="col-md-12 mb-4">
                    <div class="card text-left">

                        <div class="card-body">
                            <div class="table">
                              <div class="row ">
                                  <div class="col-md-12">

    
  <div class="table">
      <div class="container">
    <div class="row ">
					<div class="col-md-6 text-center mx-auto">
					<!--Transaction Successful-->

						<div class="programme-section payment border p-3 mb-3 shadow" style="border-radius: 15px;">
							<div class="payment-icon">
							    @if(isset($paymentResponse['status']) && !empty($paymentResponse['status']) && $paymentResponse['status']!='paid')
								<div class=" " id="payment-failed">
										<img src="{{ asset('assets/images/close.png')}}" alt="" title="">
										<div class="mt-3"><h2>Transaction Failed</h2></div>
								</div>
							    @endif
							     @if(isset($paymentResponse['status']) && !empty($paymentResponse['status']) && $paymentResponse['status']=='paid')
								<div class="" id="payment-success">
									<!--i class="fa fa-check-circle-o text-success" aria-hidden="true"> </i-->
									<img src="{{ asset('assets/images/success-icon.png')}}" alt="" title="">
									<div class=""><h2 >Thank You Transaction Successful </h2></div>
								</div>
								@endif
							</div>
							<div class="row">
								<div class="col-md-12 mx-auto my-3 ">
								<div class="programme-section p-4 rounded sm-transaction">
								<p><b class="">Transaction {{$status}}</b></p>
								<hr>
								<div class="d-flex justify-content-between">
									<div class=""><b>Date</b></div>
									<div class=""><?php echo $paymentResponse['addedon']  ?></div>
								</div>

								<div class="d-flex justify-content-between mt-3">
									<div class=""><b>Customer</b></div>
									<div class=""><?php echo $paymentResponse['firstname']  ?></div>
								</div>
								
								<div class="d-flex justify-content-between mt-3">
									<div class=""><b>Transaction id</b></div>
									<div class="">#<?php echo $paymentResponse['txnid']  ?></div>
								</div>
								<div class="d-flex justify-content-between mt-3">
									<div class=""><b>Paytm Method</b></div>
									<div class=""><?php echo $paymentResponse['mode']  ?></div>
								</div>
								<div class="d-flex justify-content-between mt-3">
									<div class=""><b>Status</b></div>
									<div class="">
									    <?php if($paymentResponse['status']!="paid") { ?>
									    <i class="fa fa-times text-danger" aria-hidden="true">Failed</i>
									    	<?php } if($paymentResponse['status']=="paid") { ?>
									    <i class="fa fa-check-circle-o text-success" aria-hidden="true">Success </i>
									    	<?php } ?>
									</div>
								</div>
								<?php if($status=="Failed") { ?>
								<div class="d-flex justify-content-between mt-3">
									<div class=""><b>Message</b></div>
									<div class=""><?php echo $paymentResponse['error_Message']  ?></div>
								</div>
								<?php } ?>
								<hr>
								
							@if($userdetails->country_id=='98')
                <div class="d-flex justify-content-between mt-3">
                <div class=""><b>Total</b></div>
                <div class="">₹ <?php echo $paymentResponse['amount']/100   ?></div>
              </div>
              @else
            
              
              <div class="d-flex justify-content-between mt-3">
                <div class=""><b>Total</b></div>
                <div class="">$ <?php echo $paymentResponse['amount']/100   ?></div>
              </div>
              
              @endif
            
								
									<?php if($url != ''){ ?>
								<!--<div class="d-flex justify-content-between mt-3">-->
								<!--	<div class=""><b></b></div>-->
								<!--	<div class=""><a class="btn btn-success" href="{{$url}}">Back to lobby</a></div>-->
								<!--</div>-->
								<?php }?>
								</div>
								</div>
							</div>
							
						</div>
					<!--Transaction Successful End-->
					
					@if($paymentResponse['status']=="paid")
                    <!--<div class="col-md-12">-->
                    <!--    <p>Please select you available slots by-->
                    <!--    <a href="https://cetabusinessforum.ibentos.com/?reg={{base64_encode($userdetails->lemm_id)}}" target="_blank">clicking here</a>-->
                    <!--    </p>-->
                    <!--    </div>-->
                    @endif				
					</div>
		</div>
  </div>
    
             
  </div>
</div>
   


</div>
</div>

</div>
</div>
</div>




@endsection

@section('page-js')

@endsection
