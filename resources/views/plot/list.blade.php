<table border="1px">
    <tr>
        <td>ID</td>
        <td>小区名称</td>
        <td>导购人</td>
        <td>导购联系方式</td>
        <td>房屋面积</td>
        <td>房屋图片</td>
        <td>房屋相册</td>
        <td>房屋售价</td>
    </tr>
    @foreach($rest as $b)
    <tr>
        <td>{{$b->id}}</td>
        <td>{{$b->plot_name}}</td>
        <td>{{$b->plot_ren}}</td>
        <td>{{$b->plot_tel}}</td>
        <td>{{$b->plot_floor}}</td>
        <td>
        @if($b->plot_img)
		<img src="{{env('UPLOADS_URL')}}{{$b->plot_img}}" with="40" height="40">
		@endif	
        </td>
        <td></td>
        <td>{{$b->plot_price}}</td>
    </tr>
    @endforeach
</table>