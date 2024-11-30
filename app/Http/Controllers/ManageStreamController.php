<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\HelperController;
use App\Models\ManageStream;
use App\Models\ManageIntermediatePage;

class ManageStreamController extends Controller
{
    protected $request;
	
    public function __construct(Request $request) {
      
      date_default_timezone_set("Asia/Calcutta");
      $this->request = $request;
      $this->getBaseUrl=HelperController::adminBaseUrl($request);
    }
     public function streammaster()
        {
                  $selectedEvent=Session('A_Session');
                  $AprofileDetail=Session('AprofileDetail');
                  $eventDetails=Session('selectedEvent'); 
    
              $AccessList=ManageStream::get();
               //dump($AccessList);
              return view('datatables.stream-master',[
                  'AccessList'=>$AccessList, 
                  'prefix_url' => $this->getBaseUrl
                ]);
             
        }
        
public function changeStreamStatus(){
      $pdetail=Session('AprofileDetail');
     
      $check = ManageStream::where('mws_id',request('mws_id'))->first();
    
      if ($check->mws_status == 'active') {
      $active = ManageStream::where('mws_id',request('mws_id'))
        ->update(
              array( 
                    'mws_status'=>'inactive'
                    
                  )
            );
            $returnVal='inactive';
      }else{
      $inactive = ManageStream::where('mws_id',request('mws_id'))
            ->update(
                array( 
                      'mws_status'=>'active',
                      
                      )
              );
              $returnVal='active';
          }
}



public function setDefaultStatusMws(){
    
      if(request('isDefault') != null){
          if(request('isDefault') == 'Y'){
              ManageIntermediatePage::query()->update(['isDefault' => 'N']);
          }
          ManageStream::where('mws_id',request('mws_id'))->update(['isDefault' => request('isDefault')]);
      }
      
}


    public function AddeStreams(Request $request)
    {
        
          $pdetail=Session('AprofileDetail');
          $A_Session=Session('A_Session');
          $eventDetails=Session('selectedEvent');
          
          ## Upload Background Image ##
           if(!null==request('web_bgimage')){
                  $upload_image=request('web_bgimage');
                  $imageName = date('Y-m-d').time().'.'.$upload_image->getClientOriginalExtension();
                //   $imagePath='assets/images/'.Session('A_Session')[0]->bm_id.'/conferencehall/';by sonu 21-dec-2021
                $imagePath='assets/images/'.Session('A_Session')->bm_id.'/conferencehall/';

                  $upload_image->move(public_path($imagePath), $imageName);
           }
        
        
          $insertPosterData=array();
          $insertPosterData['mws_mode']= request('mws_mode');
          $insertPosterData['isDefault']='N';
          
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
        //   $insertPosterData['mws_custom_css']= request('mws_custom_css'); by snu-21-dec-2021
          
          $insertPosterData['mws_webinar_finish_url']=request('mws_webinar_finish_url');
          $insertPosterData['aem_id']=$eventDetails->aem_id;
          
          if(isset($imageName) && !empty($imageName)){
              $insertPosterData['mws_background_img']=$imageName;
          }
          $insertPosterData['mws_presentation_video']=NULL;
          if(!null==request('presentationVideoUrl')){
              $insertPosterData['mws_presentation_video']=request('presentationVideoUrl');
          }
        //   $insertPosterData['mws_footer_wigets']=NULL;  by snu-21-dec-2021
        //   if(!null==request('footer_wigets')){
        //       $insertPosterData['mws_footer_wigets']=request('footer_wigets');
        //   }
        
        
        ## isDefault ##
          if(isset($request->isDefault)){
              if($request->isDefault == 'Y'){
                  ManageStream::query()->update(['isDefault' => 'N']);
                  ManageIntermediatePage::query()->update(['isDefault' => 'N']);
              }
               $insertPosterData['isDefault']=request('isDefault');
          }      
        
          ## End : poster Insert ##
          if(!null==request('mws_id')){
              
              ManageStream::where('mws_id',request('mws_id'))
                  ->update(
                    $insertPosterData
                  );
              
          }else{
              ManageStream::insert(
                          $insertPosterData
                  );
          }
          return json_encode($insertPosterData);
    }

    public function editStreams()
    {
     
      $AprofileDetail=Session('AprofileDetail');
      $eventDetails=Session('selectedEvent');     
      $exhim_id="";
      if(!empty(request('mws_id'))){
          
            $hm_id=request('mws_id');
            
            $dataList =  ManageStream::where('mws_id',$hm_id)->first();
           
            return view('datatables.editstream',[
              'dataList'=>$dataList,
              'prefix_url' => $this->getBaseUrl
            ]);
      }
    }
    
    public function ActivateStream(){
      
      $AprofileDetail=Session('AprofileDetail');
      $eventDetails=Session('selectedEvent');

       $ActiveStreamData=array();
       
        $ActiveStreamData['mws_active_url']= request('mws_active_url');
        $ActiveStreamData['mws_mode']='live';
        if(request('mws_active_url')=='gallery'){
          $ActiveStreamData['mws_mode']='gallery';
        }

      ManageStream::where('mws_id',request('mws_id'))
              ->update(
                      
                          $ActiveStreamData 
                            
              );
    }
    
}
