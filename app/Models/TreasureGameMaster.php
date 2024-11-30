<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TreasureGameMaster;

class TreasureGameMaster extends Model
{
    use HasFactory;
    protected $primaryKey = 'tgm_id';
    protected $table = '1_treasure_game_master';
    
    public static function GetGameList($bm_id) {
        $res = array();
        $res['locations'] = DB::table('1_treasure_game_locations')->select('*')->where('bm_id',$bm_id)->where('tgl_status','active')->first();
        $res['gameList'] = DB::table('1_treasure_game_master as tgm')
                            ->leftjoin("customer_data as cu",\DB::raw("FIND_IN_SET(tgm.tgm_id,cu.tgm_ids)"),">",\DB::raw("'0'"))
                            ->Join('1_treasure_game_master_mapping as tgmm','tgm.tgm_id','tgmm.tgm_id')
                            ->Join('1_treasure_game_category as tgc', 'tgc.tgc_id','tgm.tgc_id')
                            ->select('tgm.*','tgmm.*','tgc.category_name','tgc.tgc_id as cat_id')
                            ->where('cu.bm_id',$bm_id)
                            ->where('tgm_status','active')
                            ->get();
        //dd($res['gameList']);
        return $res;
    }
}
