<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventMaster extends Model
{
    use HasFactory;
    protected $primaryKey = 'aem_id';
    protected $table = '1_event_master';
    const UPDATED_AT = 'aem_update_time';
}
