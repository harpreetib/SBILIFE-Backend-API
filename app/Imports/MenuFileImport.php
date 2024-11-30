<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\ToModel;

class MenuFileImport implements ToModel
{

    use RemembersRowNumber;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $etm_id; 

    public function __construct(int $etm_id = 1)
    {
        $this->etm_id = $etm_id; 
    }
    
    public function model(array $row)
    {
        
      if($this->rowNumber != 1) {

        $result['em_menu_name'] =  trim($row[0]);      
        $result['em_menu_id'] = trim($row[1]);
        $result['em_order_by'] = trim($row[2]);
		
		$result['etm_id'] = $this->etm_id;

        if(!empty($result['etm_id'])) {
			
            $check =  DB::table('1_environment_template_menu_list')
                    ->where('em_menu_id',$result['em_menu_id'])
					->where('etm_id',$result['etm_id'])
					->first();

			if($check) {
				DB::table('1_environment_template_menu_list')
				->where('em_menu_id',$result['em_menu_id'])
				->where('id',$check->id)
				->update($result);
			}
			else{
				$em_id = DB::table('1_environment_template_menu_list')->insertGetId($result);
			}
        }       
                 
     }   
    }
}
