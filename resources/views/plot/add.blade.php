
<form action="{{url('/plot/store')}}" method="POST" enctype="multipart/form-data">
@csrf
   小区名称： <input type="text" name="plot_name"><br>
   导购人：<input type="text" name="plot_ren"><br>
   导购联系方式：<input type="text" name="plot_tel"><br>
   房屋面积：<input type="text" name="plot_floor"><br>
  房屋图片 ：<input type="file" name="plot_img"><br>
   <!-- 房屋相册：<input type="file"  multipart name="plot_imgs"><br> -->
    售价：<input type="text" name="plot_price"><br>


<input type="submit" value="添加">


</form>