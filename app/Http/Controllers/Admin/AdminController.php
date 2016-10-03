<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Admin;

class AdminController extends Controller
{

    public function pass(Requests\Admin\PassRequest $request){
        if($request->method()=='POST'){
              $admin = session('admin');
              if($admin->password==$request->input("old_password")){
                  $admin->password = $request->input("password");
                  $admin->update();
                  return redirect('admin/info');
              }else{
                  //原始密码错误
                  return back()->withErrors(["old_password"=>"原始密码错误!"]);
              }
        }else{
            return view('admin.pass');
        }
    }
}
