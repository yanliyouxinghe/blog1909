<?php

namespace App\Http\Controllers\Index;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Brand;
use App\Admin;
use App\Category;
use App\Goods;
use App\Cart;
use App\Order;


class IndexController extends Controller
{
    public function index(){
        $goods = new Goods();
        $ishuan = $goods::where('is_huan',1)->take(5)->get();
        $isshu = $goods::count();
        $cate = Category::where('pid',0)->get();
        $ishot = $goods::where('is_hot',1)->take(8)->get();
        $ishcuo = $goods::where('is_cuo',1)->take(3)->get();
    
        return view('indexs.indexs',['ishuan'=>$ishuan,'isshu'=>$isshu,'cate'=>$cate,'ishot'=>$ishot,'ishcuo'=>$ishcuo]);
    }


    public function pronav($id){
        // Redis::flushall();
        // $count = Cache::add('count_'.$id,1)?Cache::get('count_'.$id):Cache::increment('count_'.$id);
        $count = Redis::setnx('count_'.$id,1)?Redis::get('count_'.$id):Redis::incr('count_'.$id);
        // $goods = Cache::get('goods');
        $goods = Redis::get('goods');
        // dd($goods);
        if(!$goods){
            echo 'wwww';
        $goods =  Goods::where('goods_id',$id)->get();
        //    Cache::put('goods',$goods,60*60*24);
        $goods = serialize($goods);
        Redis::setex('goods',60*60*24,$goods);
        // dd($goods);
        }
        $goods = unserialize($goods);
        return view('indexs/pronav.prona',['goods'=>$goods,'id'=>$id,'count'=>$count]);
    }

    public function prolist(){
        $goods =  Goods::all();
     return view('indexs/pronav.prolist',['goods'=>$goods]);
 }


 public function user(){
    // $user_id = cookie('user_id');
    // $user =  Admin::where('user_id',$user_id)->get();
    return view('indexs/user');
}



 public function carlist(){
    $count = Cart::count();
   
    $cart = Cache::get('cart');
    if(!$cart){
    $cart = Cart::join('Goods','Goods.goods_id','=','Cart.goods_id')
     ->join('Admin','Admin.user_id','=','Cart.user_id')->get();
     
     Cache::put('cart',$cart,60*60*24);
    }
    $b_num = array_column($cart->toArray(),'b_num');
    $goods_price = array_column($cart->toArray(),'goods_price');

    $cart_id = array_column($cart->toArray(),'cart_id');
 return view('indexs.car.carlist',['cart'=>$cart,'count'=>$count,'b_num'=>$b_num,'cart_id'=>$cart_id,'goods_price'=>$goods_price]);
}

public function addcar(request $request){

    $user = session('user');
    if(!$user){
        return json_encode(['no'=>'0','msg'=>'请先登录']);
    }

    $goods_id = $request->goods_id;
    $buy_num = $request->buy_num;
 
    $goods = Goods::find($goods_id);
    if($goods->goods_num<$buy_num){
        return json_encode(['no'=>'000','msg'=>'存库不足']);
    }
    $cart = Cart::where(['user_id'=>$user->user_id,'goods_id'=>$goods_id])->first();
    if($cart){
        $buy_num = $cart->b_num+$buy_num;
        if($goods->goods_num<$buy_num){
            $buy_num = $goods->goods_num;
        }
        $res = Cart::where('cart_id',$cart->cart_id)->update(['b_num'=>$buy_num]);
    }else{
        $data=[
            'user_id'=>$user->user_id,
            'goods_id'=>$goods_id,
            'b_num'=>$buy_num,
            'create_time'=>time()
        ];
        $res = Cart::create($data);
    }
    if($res !== false){
        return json_encode(['no'=>'1','msg'=>'添加成功']);
    }


}

public function pay(request $request){
    $goods_ids = $request->ids;
    $goods_id = explode(',',$goods_ids);
    $goods = Cache::get('goods');
    if(!$goods){
        $goods = Goods::whereIn('goods_id',$goods_id)->get();
        Cache::put('goods',$goods,60*60*24);
    }
   return view('indexs.pay',['goods'=>$goods,'goods_id'=>$goods_id]);
}


public function success($id){
        $goods_id = $id;
        // $user_id = cookie('user_id');
       
        $user_id = 18;
        $order_no = rand(1000,9999).time();
          $order_id = $id;

        $data = [
            'user_id'=>$user_id,
            'create_time'=>time(),
            'order_no'=>$order_no
        ];
        $ret = Order::create($data);
        if($ret){

            return view('indexs.success',['order_no'=>$order_no]);
        }
}
}
