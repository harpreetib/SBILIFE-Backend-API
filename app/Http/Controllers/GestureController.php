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

class GestureController extends Controller
{

    
    protected $request;
	
    public function __construct(Request $request) {
      
      date_default_timezone_set("Asia/Calcutta");
      $this->request = $request;
      $this->getBaseUrl=HelperController::getSAdminBaseUrl($request);
    }
    
    public function ManageGesture(Request $request)
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
            
        $gestureList = DB::table('1_gesture_master as gm')->select('gm.*');
        
         if(!empty($searchText)){

              $gestureList->where(function($query) use ($searchText) {
                    $query->orwhere('gm_name',$searchText);
                  });
        } 
        
        $gestureList = $gestureList->orderBy('gm_id','desc')->paginate($paginate);
        
        return view('superadmin.manage-gestures.managegesture',[
            'datefrom'=>$datefrom,
            'dateto'=>$dateto,
            'Alldata'=>$gestureList,
            'status' => request('status')
        ]);
    }
    
    public function AddGesture(Request $request)
    {
        $gesture_name = request('gesture_name');
        $file = request('gesture');
        $validator = Validator::make(['gesture_name'=>$gesture_name],[
            'gesture_name' => 'required|string',
        ]);
    
        if($validator->fails())
        {
            $res['code']=404;
            $res['msg']='Invalid Parameter entered!';
        }
        else
        {
            $existingRecord = DB::table('1_gesture_master')
                                ->where('gm_name', $name)
                                ->first();

            if ($existingRecord) 
            {
                $res['code']=404;
                $res['msg'] = 'Feature Name Already Exists';
            } 
            else 
            {
                $destinationPath = '/assets/images/gesture/';
                $profileImage = date('YmdHis') . ".jpg";
                $imgurl = $destinationPath.$profileImage;
                $fileupload=$file->move(public_path($destinationPath), $imgurl);
                
                DB::table('1_gesture_master')->insert([
                    'gm_name' => $name,
                    'gm_file' => $imgurl,
                ]);
        
                $res['code']=200;
                $res['msg'] = 'Record Added successfully!';
            }
        }
        return json_encode($res);
    }

    public function editGestureTemplate(request $request)
    {
        $id=request('id');
        $dataList = DB::table('1_gesture_master')->where('gm_id',$id)->first();
        return $dataList;
    }
    
    public function updateGesture(Request $request)
    {
        $name = request('ed_gesture_name');
        $gmId = request('gm_id');
        
        $validator = Validator::make(['name'=>$name,'id'=>$gmId],[
            'name' => 'required|string',
            'id'=>'required'
        ]);
        
        if($validator->fails())
        {
           return response()->json(['code' => 404, 'msg' => 'Please Enter valid data']); 
        }
        else
        {
            $checkRecord = DB::table('1_gesture_master')
                            ->where('gm_id', '!=', $gmId)
                            ->where('gm_name', $name)
                            ->first();
            
            if ($checkRecord) {
                return response()->json(['code' => 404, 'msg' => 'Feature name already exists.']);
            }
            
            if ($request->hasFile('ed_gest_icon')) {
                $file = $request->file('ed_gest_icon');
                $destinationPath = '/assets/images/gesture/';
                $profileImage = date('YmdHis') . ".jpg";
                $imgurl = $destinationPath . $profileImage;
                $fileupload = $file->move(public_path($destinationPath), $imgurl);
                $gestureDataArr['gm_file'] = $imgurl;
            }
            
            $gestureDataArr['gm_name'] = $name;
        
            $updateResult = DB::table('1_gesture_master')
                            ->where('gm_id', $gmId)
                            ->update($gestureDataArr);
            
            if ($updateResult) {
                return response()->json(['code' => 200, 'msg' => 'Feature Updated Successfully!']);
            } else {
                return response()->json(['code' => 404, 'msg' => 'Feature name already exists']);
            }
        }
    }

    public function EnableDisableGesture($id)
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
            $result = DB::table('1_gesture_master')
                        ->where('gm_id', $id)
                        ->first();
           
            if ($result) {
                $newStatus = $result->gm_status === 'active' ? 'inactive' : 'active';
        
                DB::table('1_gesture_master')
                    ->where('gm_id', $id)
                    ->update(['gm_status' => $newStatus]);
        
                return response()->json(['code'=>200,'msg' => 'Status updated successfully!']);
            } else {
                return response()->json(['code'=>404,'msg' => 'Record not found to update status']);
            }
        }
    }
}
