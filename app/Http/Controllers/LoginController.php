<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Admin;
class LoginController extends Controller
{
   public function login(){
       return view('login');
   }

   public function dologin(){
    $post = request()->except('_token');
   
    $adminuser = Admin::where('user_name',$post['user_name'])->first();

    if(decrypt($adminuser->user_pwd) != $post['user_pwd']){
      return redirect('/login')->with('msg','用户名或密码错误，请重新登录');
    }
    session(['adminuser'=>$adminuser]);
    return redirect('/index/index');
        

}
}
