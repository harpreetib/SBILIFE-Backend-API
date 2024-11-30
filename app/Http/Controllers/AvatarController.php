<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HelperController;
use Illuminate\Support\Facades\Auth;


class AvatarController extends Controller
{

    
    protected $request;
	
	public function __construct(Request $request) {
		date_default_timezone_set("Asia/Kolkata");
        $this->request = $request;
       
	}
	
	
	public function checkuser(Request $request)
	{
	    dd('chekkk11');
	}

	
    
    
    
    
    
    
	
}
