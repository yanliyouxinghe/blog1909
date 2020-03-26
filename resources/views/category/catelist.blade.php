<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>分类列表</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>商品分类列表</h2></center><hr/>

<table class="table table-striped">
	<caption>商品分类列表</caption>
	<thead>
		<tr>
			<th>分类ID</th>
			<th>分类名称</th>
			<th>分类介绍</th>
			<th>操作</th>            
		</tr>
	</thead>
	<tbody>
    @foreach ($cate as $v)
		<tr>
			<td>{{$v->cate_id}}</td>
            <td>{{$v->cate_name}}</td>     
			<td>{{$v->cate_desc}}</td>
            <td>
                <a href="{{url('/category/edit/'.$v->cate_id)}}" class="btn btn-warning">编辑</button>
                <a href="{{url('/category/destroy/'.$v->cate_id)}}" class="btn btn-danger">删除</a>
                <a href="{{url('/category/create')}}" class="btn btn-success">添加</a>
        </td>
        </tr>
		@endforeach
		<tr>
			<td colspan="6">{{$cate->links()}}</td>
		</tr>
	</tbody>
</table>

</body>
</html>