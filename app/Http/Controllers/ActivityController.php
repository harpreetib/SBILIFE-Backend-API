<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HelperController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ActivityController extends Controller
{
    protected $request;
	
    public function __construct(Request $request) {
      
      date_default_timezone_set("Asia/Calcutta");
      $this->request = $request;
      $this->getBaseUrl=HelperController::getSAdminBaseUrl($request);
      
    }
    
    public function ManageActivity(){
        
        $searchText="";
        $paginate="";
        $datef ="";
        $datet ="";
        $datefrom = request('datefrom');
        $datef = date('Y-m-d H:i:s', strtotime($datefrom));
        
        $dateto = request('dateto');
        $datet = date('Y-m-d H:i:s', strtotime($dateto));
        $leadstage = request('leadstage');
        
        if (null !==(request('search_text'))){
            $searchText = request('search_text');
        }
         if (null !==(request('perPage'))){
            $paginate = request('perPage');
        }else{
            $paginate = 10;
        }
            
        $tempList = DB::table('1_activity_master as am')->select('am.*');
        
         if(!empty($searchText)){

              $tempList->where(function($query) use ($searchText) {
                    $query->orwhere('am_text',$searchText);
                  });
        } 
        
        $tempList = $tempList->orderBy('am_id','desc');
        $tempList = $tempList->whereNotNull('am_text');
        $tempList = $tempList->paginate($paginate);
        
        return view('superadmin.manage-activity.index',[
                'datefrom'=>$datefrom,
                'dateto'=>$dateto,
                'Alldata'=>$tempList,
                'status' => request('status'),
            ]);
    }
    
    public function AddActivity(Request $request)
    {
        $request->validate([
            'activity_name' => 'required|string',
        ]);

        $name = $request->input('activity_name');
    
        $existingRecord = DB::table('1_activity_master')
            ->where('am_text', $name)
            ->first();
    
        if ($existingRecord) {
            return "exists";
        } else {
            DB::table('1_activity_master')->insert([
                'am_text' => $name,
            ]);
    
            return "success";
        }
    }

    public function EditActivityData(Request $request)
    {
        $id=request('id');
        $dataList = DB::table('1_activity_master')->where('am_id',$id)->first();
        return $dataList;
    }
    
    public function UpdateActivityData(Request $request)
    {
        $res = $request->all();
        // dd($res);
        $request->validate([
            'ed_activity_name' => 'required|string',
        ]);
    
        $amId = request('am_id');
        
        $checkRecord = DB::table('1_activity_master')
            ->where('am_id', '!=', $amId)
            ->where('am_text', $res['ed_activity_name'])
            ->first();
        // dd($checkRecord);
        if ($checkRecord) {
            return response()->json(['status' => 'error', 'message' => 'Activity name already exists.']);
        }
    
        $updateResult = DB::table('1_activity_master')
            ->where('am_id', $amId)
            ->update(['am_text' => $res['ed_activity_name']]);
        // dd($updateResult);
        if ($updateResult) {
            return response()->json(['status' => 'success', 'message' => 'User Activity Updated Successfully']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Failed to update Activity name already exists']);
        }
    }

    public function ChangeActivityStatus($id)
    {
        $result = DB::table('1_activity_master')->where('am_id', $id)->first();
    
        if ($result) {
            $newStatus = $result->am_status === 'active' ? 'inactive' : 'active';
    
            DB::table('1_activity_master')
                ->where('am_id', $id)
                ->update(['am_status' => $newStatus]);
    
            return response()->json(['message' => 'You have ' . $newStatus . ' services successfully']);
        } else {
            return response()->json(['message' => 'Services Disabled'], 404);
        }
    }
	 
}

