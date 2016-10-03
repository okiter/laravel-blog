<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests;

class IndexController extends Controller
{
    public function index(){

        return view("admin/index");
    }
    public function info(){
        return view("admin/info");
    }
}
