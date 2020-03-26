<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>登录</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>后台登录</h2></center><hr/>
@if( session('msg'))
<div class="alert alert-danger">{{session('msg')}}</div>
@endif
<form role="form" action="{{url('/dologin')}}" method="post" enctype="multipart/form-data">
    @csrf
	<div class="form-group">
		<label for="name">用户名</label>
		<input type="text" name="user_name" class="form-control" placeholder="请输入管理员名称">
	</div>
    <div class="form-group">
		<label for="name">密码</label>
		<input type="password" name="user_pwd" class="form-control" placeholder="请输入密码">
	</div>
    <input type="submit" class="btn btn-info" value="登录">
 </form>

</body>
</html>