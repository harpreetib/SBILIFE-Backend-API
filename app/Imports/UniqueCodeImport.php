<?php

namespace App\Imports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\ToModel;

class UniqueCodeImport implements ToModel
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

        $result['location_id'] =  trim($row[0]);      
        $result['em_position_x'] = trim($row[1]);
        $result['em_position_y'] = trim($row[2]);
        $result['em_position_z'] = trim($row[3]); 
		
		$result['em_rotation_x'] = trim($row[4]);
        $result['em_rotation_y'] = trim($row[5]);
        $result['em_rotation_z'] = trim($row[6]); 
		
		$result['em_scale_x'] = trim($row[7]);
        $result['em_scale_y'] = trim($row[8]);
        $result['em_scale_z'] = trim($row[9]); 
		
		$result['type'] = trim($row[10])=='Video' ? 'video':'image';
		
		$result['etm_id'] = $this->etm_id;

        if(!empty($result['location_id'])) {
			
            $check =  DB::table('1_environment_template_location_list')
					->where('location_id',$result['location_id'])
					->where('etm_id',$result['etm_id'])
					->first();

			if($check) {
				DB::table('1_environment_template_location_list')
				->where('id',$check->id)
				->where('location_id',$result['location_id'])
				->update($result);
			}
			else{
				$em_id = DB::table('1_environment_template_location_list')->insertGetId($result);
			}
        }       
                 
     }   
    }
}
