<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品添加</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>商品添加</h2></center><hr/>
<a style="float:right" href="{{url('/goods/index')}}" class="btn btn-default">前往列表</a>
<form role="form" action="{{url('/goods/store/')}}" method="post" enctype="multipart/form-data">
    @csrf
	<div class="form-group">
		<label for="name">商品名称</label>
        <input type="text" name="goods_name" class="form-control" placeholder="请输入商品名称">
        <b style="color: red">{{$errors->first('goods_name')}}</b>
	</div>
    <div class="form-group">
        <label for="name">商品货号</label>
        <input type="text" name="goods_score" class="form-control" placeholder="请输入商品货号">
        <b style="color: red">{{$errors->first('goods_score')}}</b>

    </div>
   
    <div class="form-group">
		<label for="name">商品分类</label>
            <select name="cate_id">
                <option value="0">请选择</option>
                @foreach($cate as $v)
                <option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
                @endforeach
            </select>
    </div>
    <div class="form-group">
		<label for="name">商品品牌</label>
            <select name="brand_id">
                <option value="0">请选择</option>
                @foreach($brand as $v)
                <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                @endforeach
            </select>
    </div>
    <div class="form-group">
        <label for="name">商品价格</label>
        <input type="text" name="goods_price" class="form-control" placeholder="请输入商品价格">
        <b style="color: red">{{$errors->first('goods_price')}}</b>
    </div>
    <div class="form-group">
        <label for="name">商品存库</label>
        <input type="text" name="goods_num" class="form-control" placeholder="请输入商品存库">
        <b style="color: red">{{$errors->first('goods_num')}}</b>
        
    </div>
    <div class="form-group">
        <label for="name">商品主图</label>
        <input type="file" name="goods_img" class="form-control">
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
        <label for="name">是否热销</label>
        <input type="radio" name="is_new" value="1">是
        <input type="radio" name="is_new" value="0">否
	</div>
	<div class="form-group">
        <label for="name">是否展示幻灯片</label>
        <input type="radio" name="is_new" value="1">是
        <input type="radio" name="is_new" value="0">否
	</div>
	<div class="form-group">
        <label for="name">是否促销</label>
        <input type="radio" name="is_cuo" value="1">是
        <input type="radio" name="is_cuo" value="0">否
    </div>
    <div class="form-group">
		<label for="name">商品介绍</label>
		<textarea class="form-control"   name="goods_desc" placeholder="请输入品牌介绍"></textarea>
    </div>
    <button type="button" class="btn btn-info">添加</button>
 </form>
 <script>
	 	$(function(){

			var flag = false;
			$("input[name='goods_name']").blur(function(){
					var _this = $(this);
					// _this.next().empty();
				var goods_name = _this.val();
				 var xhr = /^[\u4e00-\u9fa5\w-.]{2,16}$/;
				 if(!xhr.test(goods_name)){
					_this.next().text('商品名称需由中文、字母、数字、下划线、-或者.组成的长度为度为2-16位');
					flag = false;
				 }
				 $.ajax({
					url : '/goods/flagobj',
					dataType : 'json',
					data : {'goods_name':goods_name},
					async:false,
					success:function(res){
						if(res.count > 0){
							$("input[name='goods_name']").next().text('商品名称已存在');
							flag = false;
						}
						flag = true;
						
					}
				});
			});
		 

		
			$('button').click(function(){
				var flag2 = false;
				var goods_name = $("input[name='goods_name']").val();
				var xhr = /^[\u4e00-\u9fa5\w-.]{2,16}$/;
				 if(goods_name ==''){
					$("input[name='goods_name']").next().text('商品名称不能为空');
					flag2 = false;
				 }else if(!xhr.test(goods_name)){
						$("input[name='goods_name']").next().text('商品名称需由中文、字母、数字、下划线、-或者.组成的长度为度为2-16位');
						flag2 = false;
				 }else{
					$("input[name='goods_name']").next().text();
					flag2 = true;
				 }

		
				$.ajax({
					url : '/goods/flagobj',
					dataType : 'json',
					data : {'goods_name':goods_name},
					async:false,
					success:function(res){
						if(res.count > 0){
							$("input[name='goods_name']").next().text('商品名称已存在');
							flag2 = false;
						}
						
					}
				});
				if(flag === false||flag2===false){
					return false;
				} 
				$('form').submit();
			});
		});
 </script>
</body>
</html>