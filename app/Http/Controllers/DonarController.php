<?php

namespace App\Http\Controllers;
 
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect; 

class DonarController extends Controller
{
    public function index(Request $request)
    { 
        return view("donar.donar"); 
    }

    public function checkout()
    {
        return view("donar.donar_checkout"); 
    }

    public function pending()
    {
        return view("donar.donar_status_pending"); 
    }

    public function rejected()
    {
        return view("donar.donar_status_rejected"); 
    }

    public function successful()
    {
        return view("donar.donar_status_successful"); 
    }

}
