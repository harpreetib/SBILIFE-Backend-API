<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppFeatureMaster extends Model
{
    use HasFactory;
     protected $primaryKey = 'afm_id';
    protected $table = '1_app_feature_master';
}
