<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use App\Category;
use App\Goods;
use Validator;
use App\Http\Requests\StoreGoodsPost;
use Illuminate\Validation\Rule;

use App\Http\Controllers\Common AS A;
class GoodsController extends A
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $name = request()->name;
        $where = [];
        if($name){
            $where[] = ['goods_name','like',"%$name%"];
        }
        // $pageSize = config('app.pagSize');
        $goods = new Goods();
        $list = $goods
            ->leftjoin("Brand","goods.brand_id","=","Brand.brand_id")
            ->leftjoin("Category","goods.cate_id","=", "Category.cate_id")
            ->where($where)
            ->paginate(3);
        $query = request()->all();
        return view('goods.list',['list'=>$list,'query'=>$query]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $brand = Brand::get();
        $cate = Category::all();
        $cate = $this->getcateinfo($cate);
        return view('goods.form',['brand'=>$brand,'cate'=>$cate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    public function store(StoreGoodsPost $request)

    {
        $post = $request->except('_token');

        // $validator = Validator::make($post, [ 
        //     'goods_name' => 'required|unique:goods|max:50|min:2',
        //      'goods_num' => 'required|numeric',
        //      'goods_price' => 'required|numeric',
        //      'goods_score' => 'required',


        // ],[
        //     'goods_name.required'=>'商品名称不能为空',
        //     'goods_score.required'=>'商品货号不能为空',
        //     'goods_name.max'=>'商品名称2-50位',
        //     'goods_name.min'=>'商品名称2-50位',
        //     'goods_name.unique'=>'品牌名称已被注册',
        //     'goods_num.required'=>'商品存库不能为空',
        //     'goods_price.required'=>'商品价格不能为空',
        //     'goods_num.numeric'=>'商品存库必须为数字',
        //     'goods_price.numeric'=>'商品价格必须为数字',


        // ]);

        // if ($validator->fails()) { 
        //      return redirect('goods/create') 
        //         -> withErrors($Validator)
        //         ->withInput(); 
        // }



        if($request->hasFile('goods_img')){
            $post['goods_img'] = $this->uploads('goods_img');
        }

        if($request->hasFile('goods_imgs')){
            $goods_imgs = $this->Moreuploads('goods_imgs');
            $post['goods_imgs'] = implode('|',$goods_imgs);
        }


        $goods = new Goods();
        $res = $goods->insert($post);
        if($res){
            return redirect('goods/index');
        }
        

    }

    // 文件上传
    public function uploads($img){
        $file = request()->$img;
        if($file->isValid()){
            $store_result = $file->store('uploads');
            return $store_result;
        }
        exit('上传失败');
    }

    // 多文件上传
    public function Moreuploads($img){
        $file = request()->$img;
        foreach($file as $k=>$v){
            if($v->isValid()){
                $store_result[$k] = $v->store('uploads');
            }else{
                $store_result[$k] = '文件上传';
            }
        }
        return $store_result;
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        
        $goods = new Goods();        
        $list = $goods
        ->leftjoin("Brand","goods.brand_id","=","Brand.brand_id")
        ->leftjoin("Category","goods.cate_id","=", "Category.cate_id")
        ->get();
        $res = $goods->find($id);
        return view('goods.upload',['res'=>$res,'list'=>$list]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGoodsPost $request, $id)
    {

       
        $post = $request->except('_token');

    //     $request -> Validator([ 
    //         'goods_name' => [
    //            'regex:/^[\x{4e00}-\x{9fa5}\w]{2,50}$/u',
    //            Rule::unique('goods')->ignore($id,'goods_id'),
    //         ],
    //          'goods_num' => 'required|numeric',
    //          'goods_price' => 'required|numeric',
    //          'goods_score' => 'required',
    //     ],[
    //         'goods_name.required'=>'商品名称不能为空',
    //         'goods_score.required'=>'商品货号不能为空',
    //         'goods_name.regex'=>'商品名称可以包含中文，数字，字母，下划线长度2-50位',
    //         'goods_name.unique'=>'品牌名称已被注册',
    //         'goods_num.required'=>'商品存库不能为空',
    //         'goods_price.required'=>'商品价格不能为空',
    //         'goods_num.numeric'=>'商品存库必须为数字',
    //         'goods_price.numeric'=>'商品价格必须为数字',


    //     ]);
    //     if ($validator->fails()) { 
    //         return redirect('goods/edit') 
    //            -> withErrors($validator)
    //            ->withInput(); 
    //    }


        if($request->hasFile('goods_img')){
            $post['goods_img'] = $this->uploads('goods_img');
       }

    if($request->hasFile('goods_imgs')){
        $goods_imgs = $this->Moreuploads('goods_imgs');
        $post['goods_imgs'] = implode('|',$goods_imgs);
    }
        $ret = Goods::where('goods_id',$id)->update($post);
        // $ret = DB::table('brand')->where('brand_id', $id)->update($post);
        if($ret !== false){
            return redirect('goods/index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = Goods::where('goods_id',$id)->delete();
        if($res){
           return redirect('goods/index');
        }
    }

    public function flagobj(){
        $goods_name = request()->goods_name;
        
        $count = Goods::where('goods_name',$goods_name)->count();
        return json_encode(['no'=>'1','count'=>$count]);
    }





}
