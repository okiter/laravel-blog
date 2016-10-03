<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginPost;
use App\Models\Admin;
use Illuminate\Support\Facades\Crypt;

class LoginController extends Controller
{
    public function login(LoginPost $request){
        if($request->getMethod()=='POST'){

            $username = $request->input('usenrame');
            $admin = Admin::where("username",$request->input('username'))->first();
            if($admin){
                if($admin->password!=$request->input("password")){
                    return back()->with("msg","密码错误!");
                }
                session(['admin'=>$admin]);
                return redirect('admin/index'); //转向后台页面
            }else{
                return back()->withErrors(["msg"=>"用户名错误!"]);
            }
        }
        return view('admin.login');
    }

    public function logout(){
        session(['admin'=>null]);  //退出
        return redirect('admin/login');
    }



}
