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

class AuditoriumController extends Controller
{
    protected $eventDetails;

    public function __construct(Request $request) {
      
      date_default_timezone_set("Asia/Calcutta");
      $this->request = $request;
      $this->getBaseUrl=HelperController::adminBaseUrl($request);
      $this->getBannerBaseUrl = 'https://'.request()->getHost().config('app.rootFolder').'/se/public';
    }

    public function index()
    {
        return view('home',[ 'prefix_url' => $this->getBaseUrl]);
    }

    
    
    ## ----------------------- Booth Setup -----------------------------------##
    
   
    public function manageaudi(Request $request) 
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
        
        $hallImgBaseUrl = 'https://'.request()->getHost().config('app.rootFolder').'/se/public';
        
        $leadList=DB::table('1_auditorium_setting as ehc')
                    ->Select(
                        DB::raw('CONCAT("'.$hallImgBaseUrl.'", ehc.ehc_hall_bgimage) AS logo'),
                        DB::raw('CONCAT("'.$hallImgBaseUrl.'", ehc.hp_video) AS bg_video'),
                        'ehc.ehc_id','ehc.hp_type');
                    
        //$leadList->orderby('ehc.ehc_order','asc');
        $res=$leadList->paginate($paginate);
        
        return view('auditorium.index',[
              'leadList'=>$res,
              'prefix_url' => $this->getBaseUrl
        ]);
    }
        
        public function AddAudiContent(Request $request) 
        {
        
            $setArray['hp_type'] = request('file_type');
            
            $existData = DB::table('1_homepage_setting')->count();
        
            if(!null==request('upload_photo') && request('photoupload')=='photoupload'){
              
                    $pdfFileData=request('product_image');
                    $data = request('logoimage');
                    
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    
                    $data = base64_decode($data);
                    $imageNames= 'himage-'.date('Y-m-d').time().'.jpg';
                    $imagePath='/assets/images/auditorium/';
                    File::makeDirectory(public_path() . $imagePath, 0777, true, true);
                    $path = public_path() . $imagePath . $imageNames;
                    
                    file_put_contents($path, $data);
                    
                    $imageNames = $imagePath . $imageNames; //Added For Metaverse Access
                    
                    $setArray['ehc_hall_bgimage'] = $imageNames;
            }
            
            
            if(!null==request('egapplylink')){
              
                $videoUrl = request('egapplylink');
                
                $vidName= 'video-'.date('Y-m-d').time().'.mp4';
                $vidPath='/assets/images/auditorium/';
                $path = public_path() . $vidPath . $vidName;
                
                File::makeDirectory(public_path() . $vidPath, 0777, true, true);
                $videoUrl->move(public_path($vidPath), $vidName);
                
                $videoUrl = $vidPath.$vidName; //Added For Access File From Metaverse
                
                $setArray['hp_video'] = $vidPath.$vidName;
            }
          
        
            if(!empty(request('ehc_id')))
            {
                DB::table('1_auditorium_setting')
                    ->where('ehc_id',request('ehc_id'))
                    ->update(
                      $setArray
                    );
            }
            
            if($existData < 1)
            {
                $bmId = DB::table('1_auditorium_setting')->insertGetId($setArray);
            }
            
            return redirect($this->getBaseUrl.'/manageaudi');
        }
    
    public function EditAudiContent(Request $request)
    {
        $hallImgBaseUrl = '';
        $res = array();
        $list = DB::table('1_auditorium_setting AS ehc')
                    ->Select('ehc.hp_type')
                    ->where('ehc.ehc_id',request('ehc_id'))->first();
        
        if($list)
        {
            $res['code'] = 200;
            $res['hp_type'] = $list->hp_type;
        }
        else{
            $res['code'] = 404;
        }
        
        echo json_encode($res);
    }
}
