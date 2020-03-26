<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use DB;
use App\Brand;
// use App\Http\Requests\StoreBrandPost;
use Validator;
class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表页
     * @return \Illuminate\Http\Response
     */
    public function index()
    {       

        

        // 存入session第一种方法
        // session(['name'=>'zhangsan']);
        // 存入session第二种方法
        // request()->session()->put('age','100');
        // 输出session第一种方法
        // echo session('name');
        // 输出session第二种方法
        // echo request()->session()->get('age');
        // 删除session第一种方法
        // session(['name'=>null]);
        // 删除session第二种方法
        // request()->session()->forget('age');
        // 获取全部session
        // dump(request()->session()->all());
        // 删除全部
        // request()->session()->flush();
        $name = request()->name;
        $url = request()->url;
        $where = [];
        if($name){
            $where[] = ['brand_name','like',"%$name%"];
        }
        if($url){
            $where[] = ['brand_url','like',"%$url%"];
        }



        $pageSize = config('app.pageSize');
        // $brand = DB::table('brand')->get();
        $brand = Brand::where($where)->orderby('brand_id','desc')->paginate($pageSize);
        $query = request()->all();
        if(request()->ajax()){
            return view('brand.listajax',['brand'=>$brand,'query'=>$query]);
        }
        return view('brand.list',['brand'=>$brand,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brand.create');
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


        $validator = Validator::make($post, [ 
            'brand_name' => 'required|unique:brand|max:20',
             'brand_url' => 'required',
        ],[
            'brand_name.required'=>'品牌名称不能为空',
            'brand_name.unique'=>'品牌名称已被注册',
            'brand_name.max'=>'品牌名称长度不能大于20',
            'brand_url.required'=>'品牌网址不能为空',
        ]);

        if ($validator->fails()) { 
             return redirect('brand/create') 
                -> withErrors($validator)
                ->withInput(); 
        }




        // 文件上传
        if($request->hasFile('brand_logo')){
             $post['brand_logo'] = uploads('brand_logo');
        }

         //多文件上传
         if($request->hasFile('brand_imgs')){
            $brand_imgs = Moreuploads('brand_imgs');
            $post['brand_imgs'] = implode('|',$brand_imgs);
        
       }
        $brand = new Brand();
        $res = $brand->insert($post);
        if($res){
            return redirect('brand/index');
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
        $brand = new Brand();
        $res = $brand->find($id);
        return view('brand.edit',['res'=>$res]);
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
        //
        $post = $request->except('_token');

         // 文件上传
        if($request->hasFile('brand_logo')){
            $post['brand_logo'] = uploads('brand_logo');
       }
        $ret = Brand::where('brand_id',$id)->update($post);
        // $ret = DB::table('brand')->where('brand_id', $id)->update($post);
        if($ret !== false){
            return redirect('brand/index');
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
         $res = Brand::where('brand_id',$id)->delete();
         
         if($res){
            if(request()->ajax()){
                return json_encode(['error_no'=>'1','error_msg'=>'删除成功']);
             }
            return redirect('brand/index');
         }

    }

    public function flagobj(){
        $brand_name = request()->brand_name;
        
        $count = Brand::where('brand_name',$brand_name)->count();
        return json_encode(['no'=>'1','count'=>$count]);
    }


}
