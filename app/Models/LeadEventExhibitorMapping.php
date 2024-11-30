<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadEventExhibitorMapping extends Model
{
    use HasFactory;
     protected $primaryKey = 'leem_id';
    protected $table = '1_lead_event_exhibitor_mapping';
}
