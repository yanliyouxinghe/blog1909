<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品品牌添加</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>商品品牌添加</h2></center><hr/>
<a style="float:right" href="{{url('/brand/index')}}" class="btn btn-default">前往列表</a>

<form role="form" action="{{url('/brand/store')}}" method="post" enctype="multipart/form-data">
    @csrf
	<div class="form-group">
		<label for="name">品牌名称</label>
		<input type="text" name="brand_name" class="form-control" placeholder="请输入品牌名称">
		<b style="color: red">{{$errors->first('brand_name')}}</b>
	</div>
    <div class="form-group">
		<label for="name">品牌LOGO</label>
		<input type="file" name="brand_logo" class="form-control">
	</div>
	<div class="form-group">
		<label for="name">品牌相册</label>
		<input type="file" name="brand_imgs[]" class="form-control" multiple="multiple">
	</div>
    <div class="form-group">
		<label for="name">品牌网址</label>
		<input type="text" name="brand_url" class="form-control" placeholder="请输入品牌网址">
		<b style="color: red">{{$errors->first('brand_url')}}</b>
	</div>
    <div class="form-group">
		<label for="name">品牌介绍</label>
		<textarea class="form-control" name="brand_desc" placeholder="请输入品牌介绍"></textarea>
    </div>
    <button type="button" class="btn btn-info">添加</button>
 </form>

 <script>
	 	$(function(){

			var flag = false;
			$("input[name='brand_name']").blur(function(){
					var _this = $(this);
					// _this.next().empty();
				var brand_name = _this.val();
				 var xhr = /^[\u4e00-\u9fa5\w-.]{2,16}$/;
				 if(!xhr.test(brand_name)){
					_this.next().text('品牌名称需由中文、字母、数字、下划线、-或者.组成的长度为度为2-16位');
					flag = false;
				 }
				 $.ajax({
					url : '/brand/flagobj',
					dataType : 'json',
					data : {'brand_name':brand_name},
					async:false,
					success:function(res){
						if(res.count > 0){
							$("input[name='brand_name']").next().text('品牌名称已存在');
							flag = false;
						}
						flag = true;
						
					}
				});
			});
		 

			
			$('button').click(function(){
				var flag2 = false;
				var brand_name = $("input[name='brand_name']").val();
				var xhr = /^[\u4e00-\u9fa5\w-.]{2,16}$/;
				 if(brand_name ==''){
					$("input[name='brand_name']").next().text('品牌名称不能为空');
					flag2 = false;
				 }else if(!xhr.test(brand_name)){
						$("input[name='brand_name']").next().text('品牌名称需由中文、字母、数字、下划线、-或者.组成的长度为度为2-16位');
						flag2 = false;
				 }else{
					$("input[name='brand_name']").next().text();
					flag2 = true;
				 }

				
				$.ajax({
					url : '/brand/flagobj',
					dataType : 'json',
					data : {'brand_name':brand_name},
					async:false,
					success:function(res){
						if(res.count > 0){
							$("input[name='brand_name']").next().text('品牌名称已存在');
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