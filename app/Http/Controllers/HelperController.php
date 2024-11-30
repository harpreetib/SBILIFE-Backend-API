<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
//use Requests;

use Validator;
Use Session;
Use Exception;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Route;

use App\ComModel;

class HelperController extends Controller
{
        
     public $successStatus = 200;

    /**
         *
         * @return \Illuminate\Http\Response
         */
         
    
        ## current IP ##
        static function realIp(){
            if (!empty($_SERVER["HTTP_CLIENT_IP"]))
            {
                //check for ip from share internet
                $ip = $_SERVER["HTTP_CLIENT_IP"];
            }
            elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
            {
                // Check for the Proxy User
                $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            }
            else
            {
                $ip = $_SERVER["REMOTE_ADDR"];
            }

            return $ip;
        }

        static function generate_otp($num=4,$alpha=0,$numNonAlpha=0)
        {
           
            $listAlpha  = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $listNumber = '0123456789';
            $listNonAlpha = '@:!.$';
            //$listNonAlpha = '@:!.$';//',$;@:!.$/*-@_+;./*$-!,';
            $uniqueCreateCode= substr(str_shuffle($listAlpha),0,$alpha).
            substr(str_shuffle($listNumber),0,$num).
            substr(str_shuffle($listNonAlpha),0,$numNonAlpha);

            $uniqueCode=$uniqueCreateCode;
            return $uniqueCode;
        }

        #### =========SADMIN================ ####
        static function getSAdminBaseUrl($request)
        {
            $url=config('app.rootFolder');
            $url .=""; 
            if(isset($request->brand)){
                $url.='/'.$request->brand;
            }
            if(isset($request->curevent)){
                $url.='/'.$request->curevent;
            }
            return $url;
        }
        static function SadminBaseUrl($request)
        {
           
            $url=config('app.rootFolder');
            $baseroot='/console';
            $url .=$baseroot;
          
            if(isset($request->brand)){
                $url.='/'.$request->brand;
            }
            
            return $url;
        }
         #### =========End SADMIN================ ####
         
         
         #### =========ADMIN================ ####
        static function adminBaseUrl($request)
        {
           
            $url=config('app.rootFolder');
          
            if(isset($request->brand)){
                $url.=$request->brand;
            }
            
            return $url;
        }
         #### =========End ADMIN================ ####
         
         
         #### =========exhibitor================ ####
        static function exhibitorBaseUrl($request)
        {
            $url=config('app.rootFolder');
            $baseroot='/console';//;
            $url .=$baseroot;
            $url .="/exhibitor/"; 
            if(isset($request->brand)){
                $url.=$request->brand;
            }
            
            return $url;
        }
        
        static function getBaseUrl($request)
        {
            $url="";
            $url .="/exhibitor"; 
            if(isset($request->brand)){
                $url.='/'.$request->brand;
            }
            if(isset($request->curevent)){
                $url.='/'.$request->curevent;
            }
            return $url;
        }


        static function autoadminBaseUrl($request)
        {
           
            $url=config('app.rootFolder');
          
            if(isset($request->brand)){
                $brand = base64_decode($request->brand);
                $url.=$brand;
            }
            
            return $url;
        }
    
}
?>
