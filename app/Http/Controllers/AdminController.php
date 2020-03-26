<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use DB;
use App\Admin;
// use App\Http\Requests\StoreBrandPost;
use Validator;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表页
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name = request()->name;
        $where = [];
        if($name){
            $where[] = ['user_name','like',"%$name%"];
        }
        $list = Admin::where($where)->paginate(3);
            $query = request()->all();
        return view('admin.list',['list'=>$list,'query'=>$query]);
       
    }

    /**
     * Show the form for creating a new resource.
     *添加页
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.add');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    // 第二种
    // public function store(StoreBrandPost $request)
    {   
        // 第一种验证
        // $validatedData = $request->validate([ 
        // 'brand_name' => 'required|unique:brand|max:20',
        //  'brand_url' => 'required',
        // ],[
        //     'brand_name.required'=>'品牌名称不能为空',
        //     'brand_name.unique'=>'品牌名称已被注册',
        //     'brand_name.max'=>'品牌名称长度不能大于20',
        //     'brand_url.required'=>'品牌网址不能为空',
        // ]);
        $post = $request->except('_token');
        $post['user_pwd'] = encrypt($post['user_pwd']);

        $validator = Validator::make($post, [ 
            'user_name' => 'required|unique:admin|regex:/^[\x{4e00}-\x{9fa5}\w]{2,16}$/u',
             'user_pwd' => 'required|min:6',
             'user_email' => 'required',
            'user_tel' => 'required|regex:/^1[34578]{1}\d{9}$/',

        ],[
            'user_name.required'=>'管理员名称不能为空',
            'user_name.regex'=>'管理员名字需为中文、字母、数字、下划线、破折号2-16位',
            'user_name.unique'=>'管理员名称已被注册',
            'user_pwd.required'=>'密码不能为空',
            'user_pwd.min'=>'密码不能小于6位',
            'user_email.required'=>'邮箱不能为空',
            'user_tel.required'=>'手机号码不能为空',
            'user_tel.regex'=>'手机号码格式不正确',


        ]);

        if ($validator->fails()) { 
             return redirect('admin/create') 
                -> withErrors($validator)
                ->withInput(); 
        }




        // 文件上传
        if($request->hasFile('user_img')){
             $post['user_img'] = uploads('user_img');
        }

         
        $admin = new Admin();
        $res = $admin->insert($post);

        if($res){
            return redirect('admin/index');
        }
    }

    /**
     * Display the specified resource.
     *详情页展示
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *展示编辑页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        // $res = DB::table('brand')->where('brand_id',$id)->first();\
        $admin = new Admin();
        $res = $admin->find($id);
        return view('admin.edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *执行编辑
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            //'user_name' => 'regex:/^[\x{4e00}-\x{9fa5}\w]{2,16}$/u|unique:user',
            'goods_name'=>[
                'regex:/^[\x{4e00}-\x{9fa5}\w]{2,16}$/u',
                // Rule::unique('user')->ignore($id,'user_id'),
            ],
            'user_pwd' => 'min:6',
            'user_email'=>'required',
            'user_tel'=> 'required',       
        ],[
            'user_name.regex'=>'管理员名字可以包括中文，数字，字母，下划线，长度2~16位',
            'user_name.unique'=>'管理员名字已经存在！',
            'user_pwd.regex'=>'密码必须6位以上！',
            'user_email.required'=>'邮箱必填',
            'user_tel.required'=>'手机号必填',
        ]);

        $post = $request->except('_token');

        // 文件上传
       if($request->hasFile('user_img')){
           $post['user_img'] = uploads('user_img');
      }
       $ret = Admin::where('user_id',$id)->update($post);
       // $ret = DB::table('brand')->where('brand_id', $id)->update($post);
       if($ret !== false){
           return redirect('admin/index');
       }
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //  $res =  DB::table('brand')->where([['brand_id',$id]])->delete();
         $res = Admin::where('user_id',$id)->delete();
         if($res){
            return redirect('admin/index');
         }

    }

    public function flagobj(){
        $user_name = request()->user_name;
        
        $count = Admin::where('user_name',$user_name)->count();
        return json_encode(['no'=>'1','count'=>$count]);
    }


}
