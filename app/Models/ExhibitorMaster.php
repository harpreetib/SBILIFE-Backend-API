<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExhibitorMaster extends Model
{
    use HasFactory;
     protected $primaryKey = 'exhim_id';
    protected $table = '1_exhibitor_master';
}
