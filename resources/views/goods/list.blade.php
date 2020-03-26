<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>商品列表</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<center><h2>商品列表</h2></center><hr/>
<form>
<input type="text" name="name" value="{{$query['name'] ?? ''}}" placeholder="请输入商品名称关键字">
<button class="btn btn-success">点我搜索</button>
</form>
<table class="table table-striped" border="1px">
	<caption>商品列表</caption>
	<thead>
		<tr>
			<th>商品ID</th>
			<th>商品名称</th>
			<th>商品存库</th>
            <th>商品品牌</th>
			<th>商品价格</th>            
			<th>商品分类</th>
			<th>是否上架</th>
			<th>是否显示</th>
			<th>是否精品</th>
			<th>是否热销</th>
			<th>是否展示幻灯片</th>
			<th>是否促销</th>            
            <th>商品主图</th>
			<th>商品相册</th>
			<th>商品详情</th>   
			<th>操作</th>            
		</tr>
	</thead>
	<tbody>
    @foreach ($list as $v)
		<tr>
			<th>{{$v->goods_id}}</th>
            <th>{{$v->goods_name}}</th>     
            <th>{{$v->goods_num}}</th>
            <th>{{$v->brand_name}}</th>
            <th>{{$v->goods_price}}</th>     
            <th>{{$v->cate_name}}</th>
            <th>{{$v->is_up ? '√' : 'x'}}</th>
            <th>{{$v->is_best ? '√' : 'x'}}</th>     
			<th>{{$v->is_new ? '√' : 'x'}}</th>
            <th>{{$v->is_huan ? '√' : 'x'}}</th>
			<th>{{$v->is_hot ? '√' : 'x'}}</th>
			<th>{{$v->is_cuo ? '√' : 'x'}}</th>
			
			<th><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" with="40" height="40"></th>
			
            <th>@if($v->goods_imgs)
				@php $goods_imgs = explode('|',$v->goods_imgs); @endphp
				@foreach($goods_imgs as $vv)
				<img src="{{env('UPLOADS_URL')}}{{$vv}}" with="40" height="40">
				@endforeach
				@endif		</th>    
            <th>{{$v->goods_desc}}</th>
            <th>
				<a href="{{url('/goods/edit/'.$v->goods_id)}}" class="btn btn-warning">编辑</button>
                <a href="{{url('/goods/destroy/'.$v->goods_id)}}" class="btn btn-danger">删除</a>
                <a href="{{url('/goods/create')}}" class="btn btn-success">添加</a>
 
        </th>
        </tr>
		@endforeach

	
	</tbody>

</table>
<tr>
			<td colspan="6">{{$list->appends($query)->links()}}</td>
		</tr>
</body>
</html>