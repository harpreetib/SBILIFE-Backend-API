<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
use App\Http\Requests;

use App\UsersModel;

Use Session;
Use Exception;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Route;


class HelController extends Controller
{
        static function setimpdata($request){
                $msg="Wrong attempt!";
                ## Brand Details ##
                if(isset($request->brand) && !empty($request->brand)){
                    $getbrandlist= UsersModel::getbrandDetails($request->brand);
                    if(!empty($getbrandlist)){
                        $tdetail=HelController::settables($getbrandlist);
                        $eventDetails=UsersModel::getEventDetails($tdetail,$request);
                        //if(!empty($eventDetails)){
                            ## Global Variable ##
                            return $globalData=array('tdetail'=>$tdetail, 'brand'=>$getbrandlist, 'event'=>$eventDetails);
                            
                        /*}else{
                            $msg="Empty current/ active event!";
                        }*/
                    }
                }
              
                echo '<p>'.$msg.'</p>';
                exit;
            
        }

        static function settables($brandData){
            $tablesName = collect([
                ## Lead Part ##
                'lead_master'=> $brandData->bm_id.'_'.'lead_master',
                'event_master'=>$brandData->bm_id.'_'.'event_master',
                'lead_event_master_mapping'=>$brandData->bm_id.'_'.'lead_event_master_mapping',

                
                ## Exhibitor ##
                'exhibitor_master'=>$brandData->bm_id.'_'.'exhibitor_master',
                'exhibitor_boothstaff'=>$brandData->bm_id.'_'.'exhibitor_boothstaff',
                'exhibitor_city_master'=>$brandData->bm_id.'_'.'exhibitor_city_master',
                'exhibitor_product_mapping'=>$brandData->bm_id.'_'.'exhibitor_product_mapping',

                'exhibitor_event_with_boothstaff_mapping'=>$brandData->bm_id.'_'.'exhibitor_event_with_boothstaff_mapping',
                'exhibitor_event_mapping'=>$brandData->bm_id.'_'.'exhibitor_event_mapping',


                'exhibitor_product_master'=>$brandData->bm_id.'_'.'exhibitor_product_master',
                'exhibitor_gallery'=>$brandData->bm_id.'_'.'exhibitor_gallery',
                
                
                ## Masters ##
                'master_lead_source'=>$brandData->bm_id.'_'.'master_lead_source',
                'organization_type'=>$brandData->bm_id.'_'.'organization_type',
                                  
                'parent_product_master'=>$brandData->bm_id.'_'.'parent_product_master',
                'product_master'=>$brandData->bm_id.'_'.'product_master',
                'parent_product_master_mapping'=>$brandData->bm_id.'_'.'parent_product_master_mapping',

                'exhibitor_product_mapping'=>$brandData->bm_id.'_'.'exhibitor_product_mapping',
                                  
                'qualification_master'=>$brandData->bm_id.'_'.'qualification_master',
                'inquiry_data'=>$brandData->bm_id.'_'.'inquiry_data',
                'product_exhibitor_master_mapping'=>$brandData->bm_id.'_'.'product_exhibitor_master_mapping',
                'live_career_counseling_sessions'=>$brandData->bm_id.'_'.'live_career_counseling_sessions',
                'live_career_counseling_sessions_request'=>$brandData->bm_id.'_'.'live_career_counseling_sessions_request',

                'lead_event_exhibitor_mapping_activity'=>$brandData->bm_id.'_'.'lead_event_exhibitor_mapping_activity',
                'lead_event_exhibitor_mapping_remark'=>$brandData->bm_id.'_'.'lead_event_exhibitor_mapping_remark',
                'lead_event_exhibitor_mapping'=>$brandData->bm_id.'_'.'lead_event_exhibitor_mapping',
                'exhibitor_hall_category'=>$brandData->bm_id.'_'.'exhibitor_hall_category',
                'gallery_category_master'=>$brandData->bm_id.'_'.'gallery_category_master',
                   
                                
                                  
            ]);
            return $tablesName;
        }
 
}
?>
