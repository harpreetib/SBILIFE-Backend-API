<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureSettingAgainstAnEvent extends Model
{
    use HasFactory;
     protected $primaryKey = 'fsae_id';
    protected $table = '1_feature_setting_against_an_event';
    public $timestamps = false;
}
