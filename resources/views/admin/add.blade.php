<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>管理员添加</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>管理员添加</h2></center><hr/>
<a style="float:right" href="{{url('/admin/index')}}" class="btn btn-default">前往列表</a>
<!-- @if ($errors->any()) 
<div class="alert alert-danger">
	 <ul>
		 @foreach ($errors->all() as $error)
		  <li>{{ $error }}</li>
		@endforeach
	</ul> 
</div>
@endif -->
<form role="form" action="{{url('/admin/store')}}" method="post" enctype="multipart/form-data">
    @csrf
	<div class="form-group">
		<label for="name">管理员名称</label>
		<input type="text" name="user_name" class="form-control" placeholder="请输入管理员名称">
		<b style="color: red">{{$errors->first('user_name')}}</b>
	</div>
    <div class="form-group">
		<label for="name">密码</label>
		<input type="password" name="user_pwd" class="form-control" placeholder="请输入密码">
		<b style="color: red">{{$errors->first('user_pwd')}}</b>
	</div>
	<div class="form-group">
		<label for="name">管理员头像</label>
		<input type="file" name="user_img" class="form-control">
	</div>
    <div class="form-group">
		<label for="name">邮箱</label>
		<input type="text" name="user_email" class="form-control" placeholder="请输入邮箱">
		<b style="color: red">{{$errors->first('user_email')}}</b>
    </div>

    <div class="form-group">
		<label for="name">手机号码</label>
		<input type="text" name="user_tel" class="form-control" placeholder="请输入手机号码">
		<b style="color: red">{{$errors->first('user_tel')}}</b>
    </div>
    <button type="button" class="btn btn-info">添加</button>
 </form>

 <script>
	 	$(function(){

			var flag = false;
			$("input[name='user_name']").blur(function(){
					var _this = $(this);
					// _this.next().empty();
				var user_name = _this.val();
				 var xhr = /^[\u4e00-\u9fa5\w-.]{2,16}$/;
				 if(!xhr.test(user_name)){
					_this.next().text('管理员名称需由中文、字母、数字、下划线、-或者.组成的长度为度为2-16位');
					flag = false;
				 }
				 $.ajax({
					url : '/admin/flagobj',
					dataType : 'json',
					data : {'user_name':user_name},
					async:false,
					success:function(res){
						if(res.count > 0){
							$("input[name='user_name']").next().text('管理员名称已存在');
							flag = false;
						}
						flag = true;
						
					}
				});
			});
		 

			
			$('button').click(function(){
				var flag2 = false;
				var user_name = $("input[name='user_name']").val();
				var xhr = /^[\u4e00-\u9fa5\w-.]{2,16}$/;
				 if(user_name ==''){
					$("input[name='user_name']").next().text('管理员名称不能为空');
					flag2 = false;
				 }else if(!xhr.test(user_name)){
						$("input[name='user_name']").next().text('管理员名称需由中文、字母、数字、下划线、-或者.组成的长度为度为2-16位');
						flag2 = false;
				 }else{
					$("input[name='user_name']").next().text();
					flag2 = true;
				 }

				
				$.ajax({
					url : '/admin/flagobj',
					dataType : 'json',
					data : {'user_name':user_name},
					async:false,
					success:function(res){
						if(res.count > 0){
							$("input[name='user_name']").next().text('管理员名称已存在');
							flag2 = false;
						}
						
					}
				});

				if(flag === false||flag2===false) {
					return false;
				}
				$('form').submit();

			});
		});
 </script>
</body>
</html>