<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppLandingpageMaster extends Model
{
    use HasFactory;
    protected $primaryKey = 'alm_id';
    protected $table = '1_app_landingpage_master';
}
