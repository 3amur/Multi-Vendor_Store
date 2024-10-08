<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        // response() : view , json, redirect, file
        return response()->view('dashboard.master'); 
    }
}
