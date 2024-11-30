<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Validator;
use Session;
use Redirect;
use App\ComModel;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\HelperController;
use App\Models\ManageIntermediatePage;
use App\Models\ManageStream;
use App\Models\GalleryCategoryMaster;

class IntermediatepageController extends Controller
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

    protected $request;

    public function __construct(Request $request) {
      
      date_default_timezone_set("Asia/Calcutta");
      $this->request = $request;
      $this->getBaseUrl=HelperController::adminBaseUrl($request);
    }

    public function index()
    {
        return view('home',[ 'prefix_url' => $this->getBaseUrl]);
    }
   
    public function manage_intermediate_page(request $request)
    {
          
          $profileDetail=Session('AprofileDetail');
          $eventDetails=Session('selectedEvent'); 

          $hallCategory=ManageIntermediatePage::leftJoin('1_gallery_category_master as gcm','gcm.gcm_id','=','1_manage_intermediate_page.gcm_id' )
          ->where('1_manage_intermediate_page.aem_id',$eventDetails->aem_id)
          ->orderBy('mip_order','asc')
          ->get();
   
          # Gallery Category#
          $galleryCategory=GalleryCategoryMaster::all();
          
          return view('datatables.manage_intermediate_page',[
              'hallCategory'=>$hallCategory, 
              'galleryCategory' => $galleryCategory,
              'prefix_url' => $this->getBaseUrl
            ]);
    }
    public function updatestatus_intermediate_page()
    {
          $pdetail=Session('AprofileDetail');
          $tdetail=Session('A_Session');
         
          $check = ManageIntermediatePage::where('mip_id',request('mipId'))->first();

          $updateArray=array();
          $updateArray['mip_status']='active'; 
          if ($check->mip_status == 'active') {
              $updateArray['mip_status']='inactive'; 
          }
              
        ## Update ##  
          $active = ManageIntermediatePage::where('mip_id',request('mipId'))
            ->update(
                  $updateArray
            );
        return $updateArray['mip_status'];
    }
    
    
    
    public function setDefaultStatusMip(){
    
      if(request('isDefault') != null){
          if(request('isDefault') == 'Y'){
              ManageStream::query()->update(['isDefault' => 'N']);
          }
          ManageIntermediatePage::where('mip_id',request('mip_id'))->update(['isDefault' => request('isDefault')]);
      }
      
    }

    
    
    public function addeditpopup_intermediate_page()
    {
      $tdetail=Session('tdetail');
      $profileDetail=Session('profileDetail');
      $eventDetails=Session('selectedEvent');     
      $exhim_id="";
      $dataList=array();
      if(!empty(request('mipId'))){
            $mipId=request('mipId');
            $dataList =  DB::table('1_manage_intermediate_page')        
                        ->where('mip_id',$mipId)
                        ->where('aem_id',$eventDetails->aem_id)
                        ->first();
      }
      
    //   dd($dataList);
      
    # Gallery Category#
    $galleryCategory=GalleryCategoryMaster::all();
      
      return view('datatables.addeditpopup_intermediate_page',[
              'dataList'=>$dataList,
              'galleryCategory'=>$galleryCategory,
              'prefix_url' => $this->getBaseUrl
            ]);
    }
    
    
    public function addedit_intermediate_page(Request $request)
    {
        
          $pdetail=Session('AprofileDetail');
          $eventDetails=Session('selectedEvent');
          
          
          ## Upload Background Image ##
          if(!null==request('bgimage')){
                  $upload_image=request('bgimage');
                  $imageName = date('Y-m-d').time().'.'.$upload_image->getClientOriginalExtension();
                  $imagePath='assets/images/'.Session('A_Session')->bm_id.'/exhibitionhall/';

                  $upload_image->move(public_path($imagePath), $imageName);
          }
        
        
          $insertPosterData=array();
          $insertPosterData['mip_name']= request('pageName');
          $insertPosterData['mip_caption']=request('pageCaption');
          $insertPosterData['aem_id']=$eventDetails->aem_id;
          $insertPosterData['mip_presentation_video']=NULL;
          $insertPosterData['mip_html']=NULL;
          $insertPosterData['isDefault']='N';
          
          
          if(isset($imageName) && !empty($imageName)){
              $insertPosterData['mip_bgimage']=$imageName;
          }
          
          ##  Presentation Video Url ##
        //  if(isset($request->presentationVideoUrl)){
               $insertPosterData['mip_presentation_video']=request('presentationVideoUrl');
        //  }
          
           ##  Lobby Video Url ##
          if(isset($request->lobbyVideoUrl)){
               $insertPosterData['mip_lobby_video']=request('lobbyVideoUrl');
          }
          
           ##  Custom Redirect URL ##
        //  if(isset($request->redirectUrl)){
               $insertPosterData['mip_redirect_url']=request('redirectUrl');
               
            //   $insertPosterData['mip_custom_css']=request('custom_css');
        //  }
          
          
              ## Page Footer Wigets HTML ##
        //   if(isset($request->pageHtml)){
        //       $insertPosterData['mip_footer_wigets']=request('footer_wigets');
        //   }
          
          
          ## Page HTML ##
        //   if(isset($request->pageHtml)){
        //       $insertPosterData['mip_html']=request('pageHtml');
        //   }
          
          ## Gallery Category ##
          if(!null==request('galleryCategory')){
               $insertPosterData['gcm_id']=request('galleryCategory');
          }
          
          ## isDefault ##
          if(isset($request->isDefault)){
              if($request->isDefault == 'Y'){
                  ManageIntermediatePage::query()->update(['isDefault' => 'N']);
                  ManageStream::query()->update(['isDefault' => 'N']);
              }
               $insertPosterData['isDefault']=request('isDefault');
          }
          
          ## End : poster Insert ##
          if(!null==request('mipId')){
              
              ManageIntermediatePage::where('mip_id',request('mipId'))->update( $insertPosterData);
              
          }else{
              ManageIntermediatePage::insert($insertPosterData);
          }
          
          return json_encode($insertPosterData);
    }
    

      


}
