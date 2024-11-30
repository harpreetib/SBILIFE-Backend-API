<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HelperController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\ComModel;

class AppFeatureController extends Controller
{

    
    protected $request;
	
    public function __construct(Request $request) {
      
      date_default_timezone_set("Asia/Calcutta");
      $this->request = $request;
      $this->getBaseUrl=HelperController::getSAdminBaseUrl($request);
      
      
    }
    
    ## Manage Feature
    public function ManageFeature(Request $request)
    {
        $searchText="";
        $paginate="";
        $datef ="";
        $datet ="";
        $datefrom = request('datefrom');
        $datef = date('Y-m-d H:i:s', strtotime($datefrom));
        
        $dateto = request('dateto');
        $datet = date('Y-m-d H:i:s', strtotime($dateto));
        
        if (null !==(request('search_text'))){
            $searchText = request('search_text');
        }
         if (null !==(request('perPage'))){
            $paginate = request('perPage');
        }else{
            $paginate = 10;
        }
            
        $featureList = DB::table('1_app_feature_master as afm')
                        ->select('afm.*');
        
         if(!empty($searchText)){
            $featureList->where(function($query) use ($searchText) {
                $query->orwhere('afm_name',$searchText);
            });
        } 
        
        $featureList = $featureList->orderBy('afm_id','desc')->paginate($paginate);
        
        return view('superadmin.manage-feature.index',[
                'datefrom'=>$datefrom,
                'dateto'=>$dateto,
                'Alldata'=>$featureList,
                'status' => request('status'),
            ]);
    }
    
    public function AddFeature(Request $request)
    {
        $name = request('feature_name');
        $validator = Validator::make(['feature_name'=>$name],[
            'feature_name' => 'required|string',
        ]);
    
        if($validator->fails())
        {
            $res['code']=404;
            $res['msg']='Invalid name entered!';
        }
        else
        {
            $featureDetail = DB::table('1_app_feature_master')
                                ->where('afm_name', $name)
                                ->first();
        
            if ($featureDetail) {
                $res['code']=404;
                $res['msg'] = 'Feature Name Already Exists';
            } else {
                $uniquename = strtolower(str_replace(' ', '-', $name));
                DB::table('1_app_feature_master')->insert(['afm_name' => $name,'afm_internal_used_name'=>$uniquename]);
                $res['code']=200;
                $res['msg'] = 'Record Added successfully!';
            }
        }
        
        return json_encode($res);
    }
	
	public function editFeatureFormData(Request $request)
	{
        $id=request('id');
        $dataList = DB::table('1_app_feature_master')->where('afm_id',$id)->first();
        return $dataList;
    }
	
	public function updateFeatureData(Request $request)
    {
        $name = request('ed_feature_name');
        $afmId = request('afm_id');
        
        $validator = Validator::make(['name'=>$name,'id'=>$afmId],[
            'name' => 'required|string',
            'id'=>'required'
        ]);
        
        if($validator->fails())
        {
           return response()->json(['code' => 404, 'msg' => 'Please Enter valid data']); 
        }
        else
        {
            $checkRecord = DB::table('1_app_feature_master')
                            ->where('afm_id', '!=', $afmId)
                            ->where('afm_name', $name)
                            ->first();
            
            if ($checkRecord) {
                return response()->json(['code' => 404, 'msg' => 'Feature name already exists.']);
            }
            
            $uniquename = strtolower(str_replace(' ', '-', $name));
            $updateResult = DB::table('1_app_feature_master')
                            ->where('afm_id', $afmId)
                            ->update(['afm_name' => $name,'afm_internal_used_name'=>$uniquename]);
            
            if ($updateResult) {
                return response()->json(['code' => 200, 'msg' => 'Feature Updated Successfully!']);
            } else {
                return response()->json(['code' => 404, 'msg' => 'Feature name already exists']);
            }
        }
    }
    
    public function EnableDisableFeature($id)
    {
        
        $validator = Validator::make(['id'=>$id],[
            'id'=>'required|numeric'
        ]);
        
        if($validator->fails())
        {
            return response()->json(['code'=>404, 'msg' => 'Record not found to update status']);  
        }
        else
        {
            $result = DB::table('1_app_feature_master')
                        ->where('afm_id', $id)
                        ->first();
           
            if ($result) {
                $newStatus = $result->afm_status === 'active' ? 'inactive' : 'active';
        
                DB::table('1_app_feature_master')
                    ->where('afm_id', $id)
                    ->update(['afm_status' => $newStatus]);
        
                return response()->json(['code'=>200,'msg' => 'Status updated successfully!']);
            } else {
                return response()->json(['code'=>404,'msg' => 'Record not found to update status']);
            }
        }
    }
}
