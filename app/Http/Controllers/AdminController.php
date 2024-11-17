<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('add-admin');
    }

    public function edit(){
        return view('edit-admin');
    }
}
