<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadMaster extends Model
{
    use HasFactory;
    protected $primaryKey = 'lm_id';
    protected $table = '1_lead_master';
    const UPDATED_AT = 'lm_last_update_date';
}
