<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistrationTypeMaster extends Model
{
    use HasFactory;
    protected $primaryKey = 'rtm_id';
    protected $table = '1_registration_type_master';
}
