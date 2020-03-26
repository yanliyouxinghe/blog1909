<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>管理员修改</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>管理员修改</h2></center><hr/>
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
<form role="form" action="{{url('/admin/update/'.$res->user_id)}}" method="post" enctype="multipart/form-data">
    @csrf
	<div class="form-group">
		<label for="name">管理员名称</label>
		<input type="text" name="user_name" value="{{$res->user_name}}" class="form-control" placeholder="请输入管理员名称">
		<b style="color: red">{{$errors->first('user_name')}}</b>
	</div>
    <div class="form-group">
		<label for="name">密码</label>
		<input type="password" name="user_pwd" value="{{$res->user_pwd}}" class="form-control" placeholder="请输入密码">
		<b style="color: red">{{$errors->first('user_pwd')}}</b>
	</div>
	<div class="form-group">
		<label for="name">管理员头像</label>
        <input type="file" name="user_img" class="form-control">
        @if($res->user_img)
				<img src="{{env('UPLOADS_URL')}}{{$res->user_img}}" with="40" height="40">
				@endif	
	</div>
    <div class="form-group">
		<label for="name">邮箱</label>
		<input type="text" name="user_email" value="{{$res->user_email}}" class="form-control" placeholder="请输入邮箱">
		<b style="color: red">{{$errors->first('user_email')}}</b>
    </div>

    <div class="form-group">
		<label for="name">手机号码</label>
		<input type="text" name="user_tel"  value="{{$res->user_tel}}" class="form-control" placeholder="请输入手机号码">
		<b style="color: red">{{$errors->first('user_tel')}}</b>
    </div>
    <input type="submit" class="btn btn-info" value="修改">
 </form>

</body>
</html>