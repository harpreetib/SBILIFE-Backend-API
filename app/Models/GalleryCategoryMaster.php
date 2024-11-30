<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GalleryCategoryMaster extends Model
{
    use HasFactory;//use SoftDeletes;
    protected $primaryKey = 'gcm_id';
    protected $table = '1_gallery_category_master';
    public $timestamps = false;
    
}
