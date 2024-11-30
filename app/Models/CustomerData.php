<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CustomerData extends Model
{  use SoftDeletes;
     protected $fillable = ['full_name', 'email'];   
    use HasFactory;
}
