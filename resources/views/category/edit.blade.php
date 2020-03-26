<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品分类修改</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>商品分类修改</h2></center><hr/>
<a style="float:right" href="{{url('/category/index')}}" class="btn btn-default">前往分类列表</a>
<form role="form" action="{{url('/category/update/'.$res->cate_id)}}" method="post">
    @csrf
    <div class="form-group">
		<label for="name">分类名称</label>
		<input type="text" value="{{$res->cate_name}}" name="cate_name" class="form-control" placeholder="请输入分类名称">
	</div>
	<div class="form-group">
		<label for="name">父极分类名称</label>
		<select name="cate_names">
            <option value="0">请选择</option>
            @foreach ($ret as $v)
            <option value="{{$v->cate_names}}">{{$v->cate_names}}</option>
            @endforeach
        </select>
	</div>
    <div class="form-group">
        <label for="name">是否展示</label>
        <input type="radio" checked  name="cate_show" value="1">是
            <input type="radio" name="cate_show" value="0">否
       
	</div>
    <div class="form-group">
		<label for="name">分类简介</label>
		<textarea type="text" name="cate_desc" class="form-control" placeholder="请输入分类简介">{{$res->cate_desc}}</textarea>
	</div>
    <input type="submit" class="btn btn-info" value="修改">
 </form>

</body>
</html>