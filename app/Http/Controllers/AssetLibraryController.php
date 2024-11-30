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

class AssetLibraryController extends Controller
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
    
   
    public function manageassetlibrary()
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

        $leadList=DB::table('1_asset_library_master as bm')
                    ->join('1_asset_library_category_master as bcm', 'bm.bcm_id','bcm.bcm_id')
                    ->Select(DB::raw('CONCAT("'.$this->getBannerBaseUrl.'", bm.bm_banner) AS bm_banner'),'bm.bm_caption','bm.bm_description','bm.bm_link','bm.bm_id','bcm.*');
                    
        if (null !==(request('cat_id'))){
            $bcm_id = request('cat_id');
            $leadList = $leadList->where('bm.bcm_id',$bcm_id);
        }
                    
        $leadList->orderby('bm.bcm_id','desc');
        $res=$leadList->paginate($paginate);
        
        $category = DB::table('1_asset_library_category_master')->where('bcm_status','Y')->get();
        
        $assetfileList=DB::table('1_asset_file_master as af')
                    ->join('1_asset_file_category_master as afm', 'af.afm_id','afm.afm_id')
                    ->Select(DB::raw('CONCAT("'.$this->getBannerBaseUrl.'", af.af_file) AS af_file'),'af.af_caption','af.af_id','afm.*');
                    
        $assetfileList->orderby('af.afm_id','desc');
        $assetfileList=$assetfileList->paginate($paginate);
        
        $assetfilecategory = DB::table('1_asset_file_category_master')->where('afm_status','Y')->get();
        
        $bannerCount = DB::table('1_asset_library_master as bm')
                        ->Join('1_asset_library_category_master as bcm', 'bm.bcm_id','bcm.bcm_id')
                        ->Select('bcm.bcm_name',DB::raw('count(*) as total'))
                        ->groupBy('bm.bcm_id')
                        ->get();
        
        return view('manageassetlibrary.index',[
              'leadList'=>$res,
              'assetfileList'=>$assetfileList,
              'category'=>$category,
              'assetfilecategory'=>$assetfilecategory,
              'bannerCount' => $bannerCount,
              'bcm_id' => $bcm_id,
              'prefix_url' => $this->getBaseUrl
        ]);
      
    }
    
    public function AddAssetLibraryContent(Request $request) {
        
        $setArray['bcm_id'] = request('egcategory');
        $setArray['bm_caption'] = request('egcaption');
        $setArray['bm_link'] = request('eglink');
        $setArray['bm_description'] = request('egdescription');
        
        if(!null==request('upload_photo') && request('photoupload')=='photoupload'){
          
                $pdfFileData=request('product_image');
                $data = request('logoimage');
                
                list($type, $data) = explode(';', $data);
                list(, $data)      = explode(',', $data);
                
                $data = base64_decode($data);
                $imageNames= 'pimage-'.date('Y-m-d').time().'.jpg';
                $imagePath='/assets/images/assetlibrabry/cat-'.request('egcategory').'/';
                File::makeDirectory(public_path() . $imagePath, 0777, true, true);
                $path = public_path() . $imagePath . $imageNames;
                
                file_put_contents($path, $data);
                
                $imageNames = $imagePath . $imageNames; //Added For Metaverse Access
                
                $setArray['bm_banner'] = $imageNames;
        }
        
        
        
        if(!empty(request('bm_id')))
        {
            DB::table('1_asset_library_master')
                ->where('bm_id',request('bm_id'))
                ->update(
                  $setArray
                );
        }
        else
        {
            $bmId = DB::table('1_asset_library_master')->insertGetId($setArray);
        }
        
        $page = !empty(request('page')) ? '?page='.request('page') : '';
        return redirect($this->getBaseUrl.'/manageassetlibrary'.$page);
    }
    
    public function EditAssetLibraryContent(Request $request)
    {
        $res = array();
        
        $list = DB::table('1_asset_library_master')
                ->Select(DB::raw('CONCAT("'.$this->getBannerBaseUrl.'", bm_banner) AS bm_banner'),'bm_caption','bm_link','bm_description','bcm_id')
                ->where('bm_id',request('bmId'))->first();
        
        if($list)
        {
            $res['code'] = 200;
            $res['caption'] = $list->bm_caption;
            $res['link'] = $list->bm_link;
            $res['desc'] = $list->bm_description;
            $res['cat_id'] = $list->bcm_id;
            $res['img'] = $list->bm_banner;
        }
        else{
            $res['code'] = 404;
        }
        
        echo json_encode($res);
    }
    
    public function AddAssetLibraryFile(Request $request) {
        
        $setArray['afm_id'] = request('efcategory');
        $setArray['af_caption'] = request('efcaption');
        
        if(!null==request('effile')){
              
            $fileUrl = request('effile');
            //dd($fileUrl->getClientOriginalExtension());
            
            $fileName= 'file-'.date('Y-m-d').time().'.'.$fileUrl->getClientOriginalExtension();
            $filePath='/assets/images/assetlibrary/files/';
            $path = public_path() . $filePath . $fileName;
            
            File::makeDirectory(public_path() . $filePath, 0777, true, true);
            $fileUrl->move(public_path($filePath), $fileName);
            
            $fileNewUrl = $filePath.$fileName; //Added For Access File From Metaverse
            
            $setArray['af_file'] = $fileNewUrl;
        }
        
        if(!empty(request('af_id')))
        {
            DB::table('1_asset_file_master')
                ->where('af_id',request('af_id'))
                ->update(
                  $setArray
                );
        }
        else
        {
            $bmId = DB::table('1_asset_file_master')->insertGetId($setArray);
        }
        
        $page = !empty(request('page')) ? '?page='.request('page') : '';
        return redirect($this->getBaseUrl.'/manageassetlibrary'.$page);
    }
    
    public function EditAssetLibraryFile(Request $request)
    {
        $res = array();
        
        $list = DB::table('1_asset_file_master')
                ->Select('af_caption','afm_id')
                ->where('af_id',request('afId'))->first();
        
        if($list)
        {
            $res['code'] = 200;
            $res['caption'] = $list->af_caption;
            $res['cat_id'] = $list->afm_id;
        }
        else{
            $res['code'] = 404;
        }
        
        echo json_encode($res);
    }
}
