<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品修改</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>商品修改</h2></center><hr/>
<a style="float:right" href="{{url('/goods/index')}}" class="btn btn-default">前往列表</a>
<form role="form" action="{{url('/goods/update/'.$res->goods_id)}}" method="post" enctype="multipart/form-data">
    @csrf
	<div class="form-group">
		<label for="name">商品名称</label>
        <input type="text" name="goods_name" value="{{$res->goods_name}}" class="form-control" placeholder="请输入商品名称">
        <b style="color: red">{{$errors->first('goods_name')}}</b>
	</div>
    <div class="form-group">
        <label for="name">商品货号</label>
        <input type="text" name="goods_score"  value="{{$res->goods_score}}" class="form-control" placeholder="请输入商品货号">
        <b style="color: red">{{$errors->first('goods_score')}}</b>

    </div>
   
    <div class="form-group">
		<label for="name">商品分类</label>
            <select name="cate_id">
                <option value="0">请选择</option>
                @foreach($list as $v)
                <option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
                @endforeach
            </select>
    </div>
    <div class="form-group">
		<label for="name">商品品牌</label>
            <select name="brand_id">
                <option value="0">请选择</option>
                @foreach($list as $v)
                <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                @endforeach
            </select>
    </div>
    <div class="form-group">
        <label for="name">商品价格</label>
        <input type="text" name="goods_price"  value="{{$res->goods_price}}" class="form-control"  placeholder="请输入商品价格">
        <b style="color: red">{{$errors->first('goods_price')}}</b>
    </div>
    <div class="form-group">
        <label for="name">商品存库</label>
        <input type="text" name="goods_num" value="{{$res->goods_num}}" class="form-control" placeholder="请输入商品存库">
        <b style="color: red">{{$errors->first('goods_num')}}</b>
        
    </div>
    <div class="form-group">
        <label for="name">商品主图</label>
        <input type="file" name="goods_img" class="form-control">
        @if($res->goods_img)
				<img src="{{env('UPLOADS_URL')}}{{$res->goods_img}}" with="40" height="40">
				@endif	
    </div>
    <div class="form-group">
        <label for="name">商品相册</label>
        <input type="file" multiple="multiple" name="goods_imgs[]" class="form-control">
    </div>
    <div class="form-group">
        <label for="name">是否显示</label>
        <input type="radio" name="is_up" value="1">是
        <input type="radio" name="is_up" value="0">否
    </div>
    <div class="form-group">
        <label for="name">是否精品</label>
        <input type="radio" name="is_best" value="1">是
        <input type="radio" name="is_best" value="0">否
    </div>
    <div class="form-group">
        <label for="name">是否新品</label>
        <input type="radio" name="is_new" value="1">是
        <input type="radio" name="is_new" value="0">否
    </div>
    <div class="form-group">
		<label for="name">商品介绍</label>
		<textarea class="form-control"   name="goods_desc" placeholder="请输入品牌介绍"></textarea>
    </div>
    <input type="submit" class="btn btn-info" value="修改">
 </form>

</body>
</html>