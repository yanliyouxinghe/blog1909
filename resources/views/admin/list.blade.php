<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>管理员列表</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>管理员列表</h2></center><hr/>
<form>
<input type="text" name="name" value="{{$query['name'] ?? ''}}" placeholder="请输入品牌名称关键字">
<button class="btn btn-success">点我搜索</button>
</form>
<table class="table table-striped">
	<caption>管理员列表</caption>
	<thead>
		<tr>
			<th>管理员ID</th>
			<th>管理员名称</th>
            <th>管理员头像</th>
            <th>管理员邮箱</th>
			<th>管理员手机号码</th>
			<th>操作</th>            
		</tr>
	</thead>
	<tbody>
    @foreach ($list as $v)
		<tr>
			<td>{{$v->user_id}}</td>
			<td>{{$v->user_name}}</td>
            <td>
				@if($v->user_img)
				<img src="{{env('UPLOADS_URL')}}{{$v->user_img}}" with="40" height="40">
				@endif			
			</td>
			<td>{{$v->user_email}}</td>
			<td>{{$v->user_tel}}</td>
            <td>
                <a href="{{url('/admin/edit/'.$v->user_id)}}" class="btn btn-warning">编辑</button>
                <a href="{{url('/admin/destroy/'.$v->user_id)}}" class="btn btn-danger">删除</a>
                <a href="{{url('/admin/create')}}" class="btn btn-success">添加</a>
        </td>
        </tr>
		@endforeach
		<tr>
			<td colspan="6">{{$list->appends($query)->links()}}</td>
		</tr>
	</tbody>
</table>

</body>
</html>