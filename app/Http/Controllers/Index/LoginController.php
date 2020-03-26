<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
use App\Admin;
// 短信验证码
use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;
// 邮箱验证码
use App\Mail\SendCode;
use Illuminate\Support\Facades\Mail;
class LoginController extends Controller
{
    public function log(){
        return view('indexs.login');
    }


    public function reg(){
        return view('indexs.reg');
    }

    public function sendSMS(){
        $user_name = request()->user_name;
        $xhr = '/^1[3|5|6|7|8|9]\d{9}$/';
        if(!preg_match($xhr,$user_name)){
            return json_encode(['no'=>'1','msg'=>'请输入正确的手机号或邮箱']);
        }


        $code = rand(100000,999999);
        $res = $this->send($user_name,$code);
        if($res['Message']=='OK'){
            session(['code'=>$code]);
            return json_encode(['no'=>'0','msg'=>'发送成功！']);
        }
        return json_encode(['no'=>'1','msg'=>$res['Message']]);

    }

    // 邮箱发送
    public function sendEmail(){
        $user_name = request()->user_name;
        $xhrs = '/^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})$/';
        if(!preg_match($xhrs,$user_name)){
            return json_encode(['no'=>'1','msg'=>'请输入正确的手机号或邮箱']);
        }
        $code = rand(100000,999999);
        Mail::to($user_name)->send(new SendCode($code));
        session(['code'=>$code]);
        return json_encode(['no'=>'0','msg'=>'发送成功！']);
    }



    public function send($user_name,$code){

// Download：https://github.com/aliyun/openapi-sdk-php
// Usage：https://github.com/aliyun/openapi-sdk-php/blob/master/README.md

AlibabaCloud::accessKeyClient('LTAI4Fn4V3r6wdN4ykWUbZ96', 'kZRQzRBHVj5H3jJkD6faSFjalyjUQ8')
                        ->regionId('cn-hangzhou')
                        ->asDefaultClient();

try {
    $result = AlibabaCloud::rpc()
                          ->product('Dysmsapi')
                          // ->scheme('https') // https | http
                          ->version('2017-05-25')
                          ->action('SendSms')
                          ->method('POST')
                          ->host('dysmsapi.aliyuncs.com')
                          ->options([
                                        'query' => [
                                          'RegionId' => "cn-hangzhou",
                                          'PhoneNumbers' => $user_name,
                                          'SignName' => "笑里有清风",
                                          'TemplateCode' => "SMS_182680110",
                                          'TemplateParam' => "{code:$code}",
                                        ],
                                    ])
                          ->request();
    return ($result->toArray());
} catch (ClientException $e) {
    return $e->getErrorMessage() . PHP_EOL;
} catch (ServerException $e) {
    return $e->getErrorMessage() . PHP_EOL;
}


    }



    public function doreg(){
        $post = request()->except(['_token','repassword']);

        $codes =  session('code');
        if(!($post['code']==$codes)){
            return redirect('/reg')->with('msg','验证码错误');
        }
        $posts = request()->except(['_token','repassword','code']);
        $admin = new Admin();
        $ret = $admin::insert($posts);
        session('code',null);
        if($ret){
            return redirect('/log');
        }
        return redirect('/reg')->with('msg','注册失败');

        
    }
    public function dolog(){
        $post = request()->except('_token');

        $admin = new Admin();
        $user = $admin::where('user_name',$post['user_name'])->first();
    
        if($user->user_pwd != $post['user_pwd']){
          return redirect('/log')->with('msg','用户名或密码错误，请重新登录');
        }

        session(['user'=>$user]);
        if($post['refer']){
            return redirect($post['refer']);
        }
        return redirect('/');
     }
    
}
