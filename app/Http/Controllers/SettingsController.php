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

use App\Http\Controllers\HelperController;
use App\Http\Controllers\EnxRtc\RoomController;

use App\Models\AppFeatureMaster;
use App\Models\FeatureSettingAgainstAnEvent;
use App\Models\AppLandingpageMaster;

class SettingsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    protected $eventDetails;

    public function __construct(Request $request) {
      
      date_default_timezone_set("Asia/Calcutta");
      $this->request = $request;
    //   $this->getBaseUrl=HelperController::getAdminBaseUrl($request);
    $this->getBaseUrl=HelperController::getSAdminBaseUrl($request);
    }

    public function index()
    {
        return view('home',[ 'prefix_url' => $this->getBaseUrl]);
    }
    
    
    public function settings(){
                                
        // dd(Session('A_Session'));
         $selectedEvent=Session('selectedEvent');
        
        $settinngsList=AppFeatureMaster::where('afm_status','active')->get(); 
        
        $LandingPage=AppLandingpageMaster::where('alm_status','active')->get(); 
        
        $FeatureSetting=FeatureSettingAgainstAnEvent::where('fsae_status','active')
        // ->where('aem_id',$selectedEvent->aem_id)
        ->get();  
          //dd($settinngsList);                      
       return view('settings.settings',['settinngsList'=>$settinngsList,
                                        'LandingPage'=>$LandingPage,
                                        'FeatureSetting'=>$FeatureSetting,
                                        'prefix_url' => $this->getBaseUrl
                                        ]);
    }
    
    public function saveSettings(){
        // dd(request('AfmId'));
        
        $selectedEvent=Session('selectedEvent');
        
        $check=FeatureSettingAgainstAnEvent::where('afm_id',request('AfmId'))
        ->where('aem_id',1)->get(); 
  
        if(count($check)!=0){
            FeatureSettingAgainstAnEvent::where('aem_id',1)
            ->where('afm_id',request('AfmId'))
            ->update(
                array(
                    'alm_id'=>request('AlmId'),
                    'fsae_status'=>request('reqText')
                    )
                );
        }else{
            FeatureSettingAgainstAnEvent::insert(
                array(
                    'afm_id'=>request('AfmId'),
                    'aem_id'=>1,
                    'alm_id'=>request('AlmId'),
                    'fsae_status'=>request('reqText')
                    )
                );
        }
        
        return 'success';
    }
    


 ## ============ Stream Settings =================== ##
    public function streammaster()
    {
              $tdetail=Session('tdetail');
              $profileDetail=Session('profileDetail');
              $eventDetails=Session('selectedEvent'); 

          $AccessList=DB::table('1_manag_webinar_streaming')->get();
          //dump($AccessList);
          return view('datatables.stream-master',[
              'AccessList'=>$AccessList, 
              'prefix_url' => $this->getBaseUrl
            ]);
         
    }

    public function changeStreamStatus()
    {
          $pdetail=Session('profileDetail');
          $tdetail=Session('tdetail');
         
          $check = DB::table('1_manag_webinar_streaming')
          ->where('mws_id',request('mws_id'))
          ->first();

          if ($check->mws_status == 'active') {
          $active = DB::table('1_manag_webinar_streaming')
            ->where('mws_id',request('mws_id'))
            ->update(
                  array( 
                        'mws_status'=>'inactive'
                        
                      )
                );
                $returnVal='inactive';
          }else{
          $inactive = DB::table('1_manag_webinar_streaming')
                ->where('mws_id',request('mws_id'))
                ->update(
                    array( 
                          'mws_status'=>'active',
                          
                          )
                  );
                  $returnVal='active';
              }
              
          
    }


    public function AddeStreams()
    {

          $pdetail=Session('profileDetail');
          $tdetail=Session('tdetail');
          $eventDetails=Session('selectedEvent');
          
          
          ## Upload Background Image ##
           if(!null==request('web_bgimage')){
                  $upload_image=request('web_bgimage');
                  $imageName = date('Y-m-d').time().'.'.$upload_image->getClientOriginalExtension();
                  $imagePath='assets/images/'.Session('session')[0]->bm_id.'/conferencehall/';

                  $upload_image->move(public_path($imagePath), $imageName);
           }
        
        
          $insertPosterData=array();
          $insertPosterData['mws_mode']= request('mws_mode');
          
          if(request('mws_mode')=='gallery'){
               $insertPosterData['mws_active_url']='gallery' ;
          }
          
          if(null != request('liveChatUrl')){
               $insertPosterData['mws_live_chat_url']=request('liveChatUrl') ;
          }else{
               $insertPosterData['mws_live_chat_url']=NULL ;
          }
           
          
          $insertPosterData['mws_name']= request('mws_name');
          $insertPosterData['mws_video_url']=request('mws_video_url');
          $insertPosterData['mws_has_exhibition']= request('mws_has_exhibition');
          $insertPosterData['mws_exhibition_url']= request('mws_exhibition_url');
          $insertPosterData['mws_youtube_url']=request('mws_youtube_url');
          $insertPosterData['mws_facebook_url']= request('mws_facebook_url');
           $insertPosterData['mws_custom_css']= request('mws_custom_css');
          
          $insertPosterData['mws_webinar_finish_url']=request('mws_webinar_finish_url');
          $insertPosterData['aem_id']=$eventDetails->aem_id;
          
          if(isset($imageName) && !empty($imageName)){
              $insertPosterData['mws_background_img']=$imageName;
          }
          $insertPosterData['mws_presentation_video']=NULL;
          if(!null==request('presentationVideoUrl')){
              $insertPosterData['mws_presentation_video']=request('presentationVideoUrl');
          }
           $insertPosterData['mws_footer_wigets']=NULL;
          if(!null==request('footer_wigets')){
              $insertPosterData['mws_footer_wigets']=request('footer_wigets');
          }
              
        
          ## End : poster Insert ##
          if(!null==request('mws_id')){
              
              DB::table('1_manag_webinar_streaming')
                  ->where('mws_id',request('mws_id'))
                  ->update(
                    $insertPosterData
                  );
              
          }else{
              DB::table('1_manag_webinar_streaming')
                  ->insert(
                          $insertPosterData
                  );
          }
          return json_encode($insertPosterData);
    }

    public function editStreams()
    {
      $tdetail=Session('tdetail');
      $profileDetail=Session('profileDetail');
      $eventDetails=Session('selectedEvent');     
      $exhim_id="";
      if(!empty(request('mws_id'))){
          
            $hm_id=request('mws_id');
            
            $dataList =  DB::table('1_manag_webinar_streaming')        
                        ->where('mws_id',$hm_id)
                        ->first();
           
       
            return view('datatables.editstream',[
              'dataList'=>$dataList,
              'prefix_url' => $this->getBaseUrl
            ]);
      }
    }
    
    public function ActivateStream(){
      $tdetail=Session('tdetail');
      $profileDetail=Session('profileDetail');
      $eventDetails=Session('selectedEvent');

       $ActiveStreamData=array();
       
        $ActiveStreamData['mws_active_url']= request('mws_active_url');
        $ActiveStreamData['mws_mode']='live';
        if(request('mws_active_url')=='gallery'){
          $ActiveStreamData['mws_mode']='gallery';
        }

      DB::table('1_manag_webinar_streaming')
              ->where('mws_id',request('mws_id'))
              ->update(
                      
                          $ActiveStreamData 
                            
              );
    }
    
    
    ## Stream Gallery ##
    
    public function gallerymaster(){
        
        $tdetail=Session('tdetail');
          $profileDetail=Session('profileDetail');
          $eventDetails=Session('selectedEvent'); 
          if(!null==request('mwsid')){
                $AccessList=DB::table('1_manag_webinar_streaming')->where('mws_id',request('mwsid'))->get();
          $GalleryList=DB::table('1_webinar_gallery_mapping')->where('mws_id',request('mwsid'))->where('wgm_status','Y')->get();
         
         return view('datatables.stream-gallery',[
             'AccessList'=>$AccessList,
              'GalleryList'=>$GalleryList, 
              'prefix_url' => $this->getBaseUrl
            ]);
         
         
          }else{
              return 'Not Found!';
          }
        
    }
    
    
    public function Addvideogallery (){
             
           if(!null==request('video_url')){

                    $videoUrl = request('video_url');
                     
                    if(strpos(request('video_url'), '?v') == true){
                        
                         $newurl=explode('?v=',request('video_url'));
                         $videoUrl="https://www.youtube.com/embed/".$newurl[1];
                    } 
                    else if(strpos(request('video_url'), 'youtu.be/') == true){
                        
                        $newurl=explode('youtu.be/',request('video_url'));
                        $videoUrl="https://www.youtube.com/embed/".$newurl[1];
                    } 
              			      
                    $insertVideoGallery=array(
                                  'mws_id'=> request('mws_id'),
                                  'wgm_video_url'=>$videoUrl,
                                  );
                    if(!null==request('video_caption')){
                        $insertVideoGallery['wgm_video_caption']=request('video_caption');
                    }
                    
                    $insert=DB:: table('1_webinar_gallery_mapping')
                    ->insert(
                        $insertVideoGallery
                    );
            

          }
    }
    
    public function Removevideogallery(){
        
        DB:: table('1_webinar_gallery_mapping')->where('wgm_id',request('wgm_id'))->update(array('wgm_status'=>'N'));
    }
    
    
    
    ## notify Settings ##
    public function notifyhere()
    {
          $tdetail=Session('tdetail');
          $profileDetail=Session('profileDetail');
          $eventDetails=Session('selectedEvent'); 

          $notifiedList=DB::table('1_manage_notify')->get();
          //dump($AccessList);
          return view('datatables.notifymanage',[
              'notifiedList'=>$notifiedList, 
              'prefix_url' => $this->getBaseUrl
            ]);
         
    }
    
############################  


   public function usersManagement()
    {
        $tdetail=Session('tdetail');
        $selectedEvent=Session('selectedEvent');

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
            //Session::put('search_text', $search_text);
        }
        $leadList=DB::table('access_mappings');
        if(!empty($searchText)){
              $leadList->where(function($query) use ($searchText) {
                  $query->orwhere('lm.lm_email',$searchText)
                      ->orwhere('lm.lm_mobile',$searchText)
                      ->orwhere('mc.cm_name',$searchText)
                      ->orwhere('em.exhim_organization_name','like','%'.$searchText.'%')
                      ->orwhere('leema.activity','like','%'.$searchText.'%')
                      ->orwhere('qm.qm_text','like','%'.$searchText.'%')
                      ->orwhere('pm.pm_text','like','%'.$searchText.'%')
                      ->orwhere('lm.lm_fullname','like','%'.$searchText.'%');
              });
        }
        $accesType = DB::table('access_types')->get();

        $res=$leadList->paginate($paginate);
       //dump($accesType);
         return view('settings.settingMaster',[
                                  'leadList'=>$res,
                                  'accesType'=>$accesType,
                                  'prefix_url' => $this->getBaseUrl

                                    ]);

    }

    public function edituser(){
        $tdetail=Session('tdetail');
        $profileDetail=Session('profileDetail');
        $eventDetails=Session('selectedEvent');     
        $map_id="";
        if(!empty(request('map_id'))){
              $map_id=request('map_id');
              $dataList =  DB::table('access_mappings')
                          ->where('map_id',$map_id)->first();
            $accesType = DB::table('access_types')->get();

              return view('settings.edituser',[
                'dataList'=>$dataList,
                'accesType'=>$accesType,
                'prefix_url' => $this->getBaseUrl
                ]);
        }

    }

    public function updateuser(){
            $insert = DB::table('access_mappings')
                    ->where('map_id',request('map_id'))
                    ->update(
                          array( 
                                              
                                'user_name'=>request('edit_user_name'),
                                'login_id'=>request('edit_user_login'),
                                'email_id'=>request('edit_user_email'),
                                'mobile_no'=>request('edit_user_phone'),
                                'video_url'=>request('edit_user_video'),
                                'at_id'=>request('edit_access_type')
                              )
                        );
                    return "Updated";
    }
    
      public function saveNewuser(){
        $tdetail=Session('tdetail');
        $selectedEvent=Session('selectedEvent');
        $bm_id = Session('bm_id');
       // dd(request('access_type'));
        $data = DB::table('access_mappings')
                ->insert(
                        array(
                              'bm_id'=> $bm_id,
                              'user_name'=> request('name'),
                              'login_id'=> request('loginid'),
                              'password'=> rand(100000,999999),
                              'email_id'=> request('email'),
                              'mobile_no'=> request('mobile'),
                              'video_url'=> request('video'),
                              'at_id'=>request('access_type')

                      )
                );
                return 'inserted';
        
    }

    public function changeuserStatus()
      {
            
            $check = DB::table('access_mappings')
            ->where('map_id',request('map_id'))
            ->first();
//dd($check);
            if ($check->status == 'active') {
            $active = DB::table('access_mappings')
              ->where('map_id',request('map_id'))
              ->update(
                    array( 
                          'status'=>'inactive'
                          
                        )
                  );
                  $returnVal='inactive';
            }else{
            $inactive = DB::table('access_mappings')
                  ->where('map_id',request('map_id'))
                  ->update(
                      array( 
                            'status'=>'active'
                            
                            )
                    );
                    $returnVal='active';
                }
                
           
            
            return "Updated";
       }

}