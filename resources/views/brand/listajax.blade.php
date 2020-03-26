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
                <a href="{{url('/brand/destroy/'.$v->brand_id)}}" class="btn btn-danger">删除</a>
                <a href="{{url('/brand/create')}}" class="btn btn-success">添加</a>
        </td>
        </tr>
        @endforeach
        <tr>
			<td colspan="6">{{$brand->appends($query)->links()}}</td>
		</tr>