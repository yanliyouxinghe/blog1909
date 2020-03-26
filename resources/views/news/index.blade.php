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
<center><h2>新闻列表展示<a style="float: left;" href="{{url('/news/create')}}" class="btn btn-success">添加</a></h2></center><hr/>

<table class="table">
<form>
	<input type="text" name="news_name"  placeholder="请输入关键字">
	<button>搜索<tton>
</form>
	<thead>
		<tr>
			<th>新闻id</th>
			<th>新闻标题</th>
			<th>新闻详情</th>
			<th>新闻作者</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($news as $v)
		<tr class="active">
			<td>{{$v->news_id}}</td>
			<td>{{$v->news_name}}</td>
			<td>{{$v->new_desc}}</td>
			<td>{{$v->news_men}}</td>
			
			<td>
				<a href="{{url('/news/edit/'.$v->news_id)}}" type="button" class="btn btn-primary">编辑</a>
				<a href="{{url('/news/destroy/'.$v->news_id)}}" type="button" class="btn btn-warning">删除</a>
			</td>
		</tr>
		@endforeach
		<tr>
			<td colspan="6">
				{{$news->links()}}
			</td>
		</tr>
	</tbody>
</table>
<script>
//分页
$(document).on('click','.pagination a',function(){
    // alert(111);
    var url = $(this).attr('href');
    $.get(url,function(result){
        $('tbody').html(result);
    });
    return false;
});
</script>
</body>
</html>