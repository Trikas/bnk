<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        return view('admin.pages.services');
    }


    public function register()
    {
        return view('admin.pages.register');
    }

}
