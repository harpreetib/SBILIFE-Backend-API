<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeadEventMasterMapping extends Model
{
    use HasFactory;
     protected $primaryKey = 'lemm_id';
    protected $table = '1_lead_event_master_mapping';
    const UPDATED_AT = 'lemm_update_date';
}
