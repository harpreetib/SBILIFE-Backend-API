<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManageIntermediatePage extends Model
{
    use HasFactory;//use SoftDeletes;
    protected $primaryKey = 'mip_id';
    protected $table = '1_manage_intermediate_page';
    //const UPDATED_AT = 'mip_update_date';
    public $timestamps = false;
}
