<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CmsMaster extends Model
{
    use HasFactory;
     protected $primaryKey = 'cms_id';
    protected $table = '1_cms_master';
}
