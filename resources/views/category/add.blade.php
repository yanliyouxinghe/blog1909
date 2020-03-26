<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品分类添加</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>商品分类添加</h2></center><hr/>
<a style="float:right" href="{{url('/category/index')}}" class="btn btn-default">前往分类列表</a>
<form role="form" action="{{url('/category/store')}}" method="post">
    @csrf
    <div class="form-group">
		<label for="name">分类名称</label>
		<input type="text" name="cate_name" class="form-control" placeholder="请输入分类名称">
		<b style="color: red">{{$errors->first('cate_name')}}</b>
	</div>
	<div class="form-group">
		<label for="name">父极分类名称</label>
		<select name="pid">
            <option value="0">请选择</option>
            @foreach ($cate as $v)
            <option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
            @endforeach
        </select>
	</div>
    <div class="form-group">
		<label for="name">是否展示</label>
		<input type="radio" name="cate_show" value="1">是
		<input type="radio" name="cate_show" value="0">否

	</div>
    <div class="form-group">
		<label for="name">分类简介</label>
		<input type="text" name="cate_desc" class="form-control" placeholder="请输入分类简介">
	</div>
    <button type="button" class="btn btn-info">添加</button>
 </form>
 <script>
	 	$(function(){

			var flag = false;
			$("input[name='cate_name']").blur(function(){
					var _this = $(this);
					// _this.next().empty();
				var cate_name = _this.val();
				 var xhr = /^[\u4e00-\u9fa5\w-.]{2,16}$/;
				 if(!xhr.test(cate_name)){
					_this.next().text('分类名称需由中文、字母、数字、下划线、-或者.组成的长度为度为2-16位');
					flag = false;
				 }
				 $.ajax({
					url : '/category/flagobj',
					dataType : 'json',
					data : {'cate_name':cate_name},
					async:false,
					success:function(res){
						if(res.count > 0){
							$("input[name='cate_name']").next().text('分类名称已存在');
							flag = false;
						}
						flag = true;
						
					}
				});
			});
		 

		
			$('button').click(function(){
				var flag2 = false;
				var cate_name = $("input[name='cate_name']").val();
				var xhr = /^[\u4e00-\u9fa5\w-.]{2,16}$/;
				 if(cate_name ==''){
					$("input[name='cate_name']").next().text('分类名称不能为空');
					flag2 = false;
				 }else if(!xhr.test(cate_name)){
						$("input[name='cate_name']").next().text('分类名称需由中文、字母、数字、下划线、-或者.组成的长度为度为2-16位');
						flag2 = false;
				 }else{
					$("input[name='cate_name']").next().text();
					flag2 = true;
				 }

			
				$.ajax({
					url : '/category/flagobj',
					dataType : 'json',
					data : {'cate_name':cate_name},
					async:false,
					success:function(res){
						if(res.count > 0){
							$("input[name='cate_name']").next().text('分类名称已存在');
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