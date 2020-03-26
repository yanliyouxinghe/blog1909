<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品品牌修改</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>商品品牌修改</h2></center><hr/>
<a style="float:right" href="{{url('/brand/index')}}" class="btn btn-default">前往列表</a>
<form role="form" action="{{url('/brand/update/'.$res->brand_id)}}" method="post" enctype="multipart/form-data">
    @csrf
	<div class="form-group">
		<label for="name">品牌名称</label>
		<input type="text" name="brand_name" value="{{$res->brand_name}}" class="form-control" placeholder="请输入品牌名称">
	</div>
    <div class="form-group">
        <label for="name">品牌LOGO</label>
        <input type="file" name="brand_logo" class="form-control">
        @if($res->brand_logo)
				<img src="{{env('UPLOADS_URL')}}{{$res->brand_logo}}" with="40" height="40">
				@endif	
    </div>
   
    <div class="form-group">
		<label for="name">品牌网址</label>
		<input type="text" name="brand_url"  value="{{$res->brand_url}}" class="form-control" placeholder="请输入品牌网址">
	</div>
    <div class="form-group">
		<label for="name">品牌介绍</label>
		<textarea class="form-control"   name="brand_desc" placeholder="请输入品牌介绍">{{$res->brand_desc}}</textarea>
    </div>
    <input type="submit" class="btn btn-info" value="修改">
 </form>

</body>
</html>