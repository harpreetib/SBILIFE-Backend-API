<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Redirect;
use Session;
use Stripe;
use QrCode;

class StripeController extends Controller
{
 
    
   
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
   
  
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function Response(Request $request)
    {
        
   
        $custId=Session::get('userid');
        
        $txnID = Session::get('txnid');
        
        $brandData=Session::get('A_Session');
        
        if(empty($custId) || empty($txnID)){
    
            $url='https://'.request()->getHost().'/admin/'.$brandData->bm_nickname.'/mysubscription';
        	header("Location: $url");
        	exit;
        }
                    
        
        $alreadypaid=Session::get('alreadypaid');
        $url='';
        
        $AllEvent=DB::table('1_event_master')->where('aem_status','!=','old')->get();
        
        $packages=DB::table('customer_data as cd')
                ->join('brand_organizer_master as bm','cd.bm_id','bm.bm_id')
                ->join('customer_package_mapping as cpm','cpm.cd_id','cd.id')
            	->join('1_package_master as pm','cpm.pm_id','pm.pm_id')
            	->join('master_countries as mc','cd.cd_country_code','mc.counm_code')
            	->select('cd.*','pm.pm_amount','bm.bm_nickname as brand_name','mc.counm_name','mc.counm_code','cpm.pm_id as pmId')
            	->where('cd.id',$custId)
            	->first();
        	
        $userdetails=$packages;
        
        $mihpayid=Session::get('checkoutid');
        

        if( isset ($userdetails->id) && !empty($userdetails->id) ) {

          $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
          
           $checkout_session= $stripe->checkout->sessions->retrieve(
              $mihpayid,
              []
            );

            $response_log = $checkout_session->toArray();
            $response_log = print_r($response_log,true);
            
            if($checkout_session->payment_status == 'paid') {
                
                \Session::put('success', 'Payment success');
                
                if($packages){
                    DB::table('customer_data')->where('id',$packages->id)->update(array('cd_is_confirm'=>'confirm','payment_status'=>'success','pm_id'=>$userdetails->pmId));
                }
                
                DB::table('1_package_transaction_log')->where('txnid',$txnID)->update(['response_log'=>$response_log,'response_verify_txn_status'=>'Success']);

                DB::table('1_package_transaction_details')->where('userids',$userdetails->id)->where('txnid',$txnID)->update(['mihpayid'=>$mihpayid,'mode'=>$checkout_session->mode,'status'=>$checkout_session->payment_status,'amount'=>$checkout_session->amount_total]) ;
            
                if($alreadypaid=='no'){
                    StripeController::fetchdetailsNMail($userdetails->id);  
                }
                
                $ResponseArry=array();
                
                $paymentResponse=DB::table('1_package_transaction_details')->where('mihpayid',$mihpayid)->first();
                $userdetails = DB::table('customer_data as cd')->where('cd.id', $paymentResponse->userids)->first();
                $ResponseArry['addedon']=$paymentResponse->update_datetime;
                $ResponseArry['firstname']=$userdetails->cd_full_name;
                $ResponseArry['txnid']=$paymentResponse->txnid;
                $ResponseArry['mode']=$paymentResponse->mode;
                $ResponseArry['productinfo']=$paymentResponse->productinfo;
                $ResponseArry['status']=$paymentResponse->status;
                $ResponseArry['amount']=$paymentResponse->amount;
       
                return view('customers.payment.response',['paymentResponse'=>$ResponseArry,'userdetails'=>$userdetails,'AllEvent'=>$AllEvent,'url'=>$url]);
            }

            else{
                Session::put('error', 'Payment failed');

                DB::table('1_package_transaction_log')->where('txnid',$txnID)->update(['response_log'=>$response_log,'response_verify_txn_status'=>'Failed']);

                DB::table('1_package_transaction_details')->where('userids',$userdetails->lemm_id)->where('txnid',$txnID)->update(['mihpayid'=>$mihpayid,'mode'=>$checkout_session->mode,'status'=>$checkout_session->payment_status,'amount'=>$checkout_session->amount_total,'error_Message'=>'Transaction Cancelled By User']) ;

                StripeController::fetchdetailsNMailfailuer($custId);  
               
                $ResponseArry=array();
            
                $paymentResponse=DB::table('1_package_transaction_details')->where('mihpayid',$mihpayid)->first();
                $userdetails = DB::table('customer_data as cd')->where('cd.id', $paymentResponse->userids)->first();
                $ResponseArry['addedon']=$paymentResponse->update_datetime;
                $ResponseArry['firstname']=$userdetails->cd_full_name;
                $ResponseArry['txnid']=$paymentResponse->txnid;
                $ResponseArry['mode']=$paymentResponse->mode;
                $ResponseArry['productinfo']=$paymentResponse->productinfo;
                $ResponseArry['status']=$paymentResponse->status;
                $ResponseArry['amount']=$paymentResponse->amount;
                $ResponseArry['error_Message']=$paymentResponse->error_Message;
                
                return view('customers.payment.response',['paymentResponse'=>$ResponseArry,'userdetails'=>$userdetails,'AllEvent'=>$AllEvent,'url'=>$url]);
                
            }
        }
        else{
            $url='https://'.request()->getHost().'/admin/'.$brandData->bm_nickname.'/mysubscription';
            
            return Redirect::to($url);
        }
    }
   

    public static function fetchdetailsNMailfailuer($exhib_id) {
        $email_to="";
        $id=$exhib_id;

        $users = DB::table('customer_data as cd')->where('cd.id', $id)->first();

        $email_to=$users->cd_email;
        
        $email_to='monu@ibentos.com';
        //////////////////////////mail send reg ////////////////////////////////////
        try{
            Mail::send('emailer.customer.customer_payment_failed', ['allRequestData' => $users], function ($m) use ($email_to) {
                     $m->from('invitation@smartevents.in', 'Megaspace');
                    $m->to($email_to);
                    $m->subject('Payment failed Megaspace Pakcage Upgrade');
                });
        }
        catch(\Exception$e){
            
        }
        
    }

    public static function fetchdetailsNMail($lmId){
        
        $custId=Session::get('userid');
    
       $userdetails = DB::table('customer_data as cd')->where('cd.id', $custId)->where('cd.cd_is_confirm','confirm')->where('cd.payment_status','success')->first();
       
        if($userdetails){
            
            $email_to="";  
                
            $packageDetail=DB::table('customer_data as cd')
            	->join('1_package_master as pm','cd.pm_id','pm.pm_id')
            	->select('cd.*','pm.*')
            	->where('cd.id',$custId)
            	->first();
            
            $email_to=$userdetails->lm_email;
            
            $email_to='monu@ibentos.com';
            //////////////////////////mail send reg ////////////////////////////////////
            try{
                    Mail::send('emailer.customer.customer_payment_success', ['fullname' => $userdetails->cd_full_name,'email'=>$userdetails->cd_email,'package'=>$packageDetail], function ($m) use ($email_to) {
                        $m->from('invitation@smartevents.in', 'Megaspace');
                        $m->to($email_to);
                        $m->subject('Congratulations! You Have Successfully Upgraded package for Megaspace');
                    });
            }
            catch(\Exception $e){
               // echo $e;
            }
            
        }
        
        
    }
}
