<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>新闻添加</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>新闻添加<a style="float: left;" href="{{url('/news/index')}}" class="btn btn-success">新闻列表</a></h2></center><hr/>
<form action="{{url('/news/store')}}" method="post" class="form-horizontal" role="form">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">新闻标题</label>
		<div class="col-sm-8">
			<input type="text" name="news_name" class="form-control" id="firstname" >
			<b style="color:red">{{$errors->first('news_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">新闻作者</label>
		<div class="col-sm-8">
			<input type="text" name="news_men" class="form-control" id="firstname" >
			<b style="color:red">{{$errors->first('news_men')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">新闻详情</label>
		<div class="col-sm-8">
			<input type="text" name="news_desc" class="form-control" id="firstname" >
			<b style="color:red">{{$errors->first('news_desc')}}</b>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-8">
			<button type="submit" class="btn btn-default">添加</button>
		</div>
	</div>
</form>

</body>
</html>