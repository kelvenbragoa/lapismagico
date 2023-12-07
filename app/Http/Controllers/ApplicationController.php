<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    //
    public function __invoke()
    {
        if(Auth::user()->role_id == 1){
            return view('admin.layouts.app');
        }

    }
}
