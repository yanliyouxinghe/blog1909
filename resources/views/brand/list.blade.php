<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>品牌列表</title>
	<link rel="stylesheet" href="{{asset('/static/admin/css/bootstrap.min.css')}}">  
	<script src="/static/admin/js/jquery.min.js"></script>
	<script src="/static/admin/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>商品品牌列表</h2></center><hr/>
<form>
<input type="text" name="name" value="{{$query['name'] ?? ''}}" placeholder="请输入品牌名称关键字">
<input type="text" name="url" value="{{$query['url'] ?? ''}}" placeholder="请输入品牌网址关键字">
<button class="btn btn-success">点我搜索</button>
</form>
<table class="table table-striped">
	<caption>商品品牌列表</caption>
	<thead>
		<tr>
			<th>品牌ID</th>
			<th>品牌名称</th>
            <th>品牌LOGO</th>
            <th>品牌相册</th>
			<th>品牌网址</th>
            <th>品牌简介</th>
			<th>操作</th>            
		</tr>
	</thead>
	<tbody>
    @foreach ($brand as $v)
		<tr>
			<td>{{$v->brand_id}}</td>
			<td>{{$v->brand_name}}</td>
            <td>
				@if($v->brand_logo)
				<img src="{{env('UPLOADS_URL')}}{{$v->brand_logo}}" with="40" height="40">
				@endif			
			</td>
			<td>
				@if($v->brand_imgs)
				@php $brand_imgs = explode('|',$v->brand_imgs); @endphp
				@foreach($brand_imgs as $vv)
				<img src="{{env('UPLOADS_URL')}}{{$vv}}" with="40" height="40">
				@endforeach
				@endif		
			</td>
				<td>{{$v->brand_url}}</td>
			<td>{{$v->brand_desc}}</td>
            <td>
                <a href="{{url('/brand/edit/'.$v->brand_id)}}" class="btn btn-warning">编辑</button>
                <a href="javascript:void(0)" id="{{$v->brand_id}}" class="btn btn-danger">删除</a>
                <a href="{{url('/brand/create')}}"  class="btn btn-success">添加</a>
        </td>
        </tr>
		@endforeach
		<tr>
			<td colspan="6">{{$brand->appends($query)->links()}}</td>
		</tr>
	</tbody>
</table>
	<script>
		$('.btn-danger').click(function(){
				var id = $(this).attr('id');
				var isdel = confirm('确定删除吗?');
				if(isdel == true){
					$.get('/brand/destroy/'+id,function(rest){
						if(rest.error_no == '1'){
							location.reload();
						}
					},'json');
				}	
			
		});


		$(document).on('click','.pagination a',function(){
			 var url = $(this).prop('href');
			$.get(url,function(res){
				$('tbody').html(res);
			});
			return false;
		});
		
	</script>
</body>
</html>