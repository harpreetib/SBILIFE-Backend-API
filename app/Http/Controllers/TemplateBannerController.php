<?php

namespace App\Http\Controllers;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
//use Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;
use Redirect;
use App\ComModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\HelperController;
use App\Http\Controllers\EnxRtc\RoomController;
use Illuminate\Support\Facades\File;

class TemplateBannerController extends Controller
{
    protected $eventDetails;

    public function __construct(Request $request) {
      
      date_default_timezone_set("Asia/Calcutta");
      $this->request = $request;
      $this->getBaseUrl=HelperController::adminBaseUrl($request);
      $this->getBannerBaseUrl = 'https://'.request()->getHost().config('app.rootFolder').'/admin/';
    }
   
    public function managetemplatebanners()
    {
        
        $bcm_id = '';
        $tdetail=Session('tdetail');

        $profileDetail=Session('profileDetail');
        $eventDetails=Session('selectedEvent');

        if(Session::has('paginate')){
            $paginate = Session::get('paginate');
        } else{
          $paginate = 10;
        }
        if (null !==(request('pagination'))){
            $paginate = request('pagination');
            Session::put('paginate', $paginate);
        }
        $searchText="";
        if (null !==(request('search_text'))){
            $searchText = request('search_text');
        }
        
        $bm_id = Session('bm_id');
                    
        $leadList = DB::table('1_environment_template_location_list as etll')
                        ->leftjoin('customer_data as cd','cd.etm_id','etll.etm_id')
                        ->join('1_environment_content_update_master_bkp as ecumb','ecumb.etll_id','etll.id')
                        ->Select('etll.*',DB::raw('CONCAT("'.$this->getBannerBaseUrl.'", ecumb.fu_name) AS filename'))
                        ->where('cd.bm_id',$bm_id)
                        ->where('ecumb.bm_id',$bm_id)
                        ->where('etll.em_status','active');
        //dd($leadList->get());
        $leadList->orderby('etll.location_id','asc');
        $res=$leadList->paginate($paginate);
        
        return view('customers.manage-template-banners.index',[
              'leadList'=>$res,
              'bcm_id' => $bcm_id,
              'prefix_url' => $this->getBaseUrl
        ]);
      
    }
    
    public function UpdateTemplateBannerData(Request $request) {
        $res = array();
        $id = request('tmpId');
        $setArray['em_position_x'] = request('position_x');
        $setArray['em_position_y'] = request('position_y');
        $setArray['em_position_z'] = request('position_z');
        
        $setArray['em_rotation_x'] = request('rotation_x');
        $setArray['em_rotation_y'] = request('rotation_y');
        $setArray['em_rotation_z'] = request('rotation_z');
        
        $setArray['em_scale_x'] = request('scale_x');
        $setArray['em_scale_y'] = request('scale_y');
        $setArray['em_scale_z'] = request('scale_z');
        
        $bm_id = Session('bm_id');
        
        $check = DB::table('1_environment_content_update_master')->where('id',$id)->first();
        
        //dd($check);
        
        if($check)
        {
            DB::table('1_environment_content_update_master')
                ->where('bm_id',$bm_id)
                ->where('id',$id)
                ->update(
                  $setArray
                );
            $res['code'] = 200;
        }
        else {
            $res['code'] = 404;
        }
        
        return json_encode($res);
    }
}
