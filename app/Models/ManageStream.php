<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ManageStream extends Model
{
    use HasFactory;//use SoftDeletes;
    protected $primaryKey = 'mws_id';
    protected $table = '1_manag_webinar_streaming';
    public $timestamps = false;
}
