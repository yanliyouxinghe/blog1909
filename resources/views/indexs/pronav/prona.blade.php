@extends('layouts.shop')
@section('title', '全部详情')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     

      @foreach($goods as $v)
    @if($v->goods_imgs)
    <div id="sliderA" class="slider">
        @php $goods_imgs = explode('|',$v->goods_imgs); @endphp
        @foreach($goods_imgs as $vv)
           <img src="{{env('UPLOADS_URL')}}{{$vv}}"/>
      @endforeach
     </div><!--sliderA/-->
     @endif
     @endforeach

     @foreach($goods as $v)
     <table class="jia-len">

      <tr>
       <th><strong class="orange">{{$v->goods_price}}</strong></th>
       <td>
       <span><input type="text"  class="spinnerExample"/></span>
       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$v->goods_name}}</strong>
        <p class="hui">{{$v->goods_desc}}</p>
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     @endforeach
     <div>
         <h3 class="proTitle">商品访问量{{$count}}</h3>
     </div>
     <div class="height2"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
      <li class="guigeCur"><a href="javascript:;">50ML</a></li>
      <li><a href="javascript:;">100ML</a></li>
      <li><a href="javascript:;">150ML</a></li>
      <li><a href="javascript:;">200ML</a></li>
      <li><a href="javascript:;">300ML</a></li>
      <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     @foreach($goods as $v)

     <div class="proinfoList">
      <img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" width="636" height="822" />
     </div><!--proinfoList/-->
     @endforeach

     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td>
      <a href="javascript:void(0)" id="addcar"  class="btn btn-primary btn-lg btn-block">加入购物车</a>
      <!-- {{url('/addcar/'.$id)}} -->
    </td>
      </tr>
     </table>
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/static/index/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/static/index/js/bootstrap.min.js"></script>
    <script src="/static/index/js/style.js"></script>
    <!--焦点轮换-->
    <script src="/static/index/js/jquery.excoloSlider.js"></script>
    <script>
		$(function () {
		 $("#sliderA").excoloSlider();
		});
	</script>
     <!--jq加减-->
    <script src="/static/index/js/jquery.spinner.js"></script>
   <script>
	$('.spinnerExample').spinner({});
	</script>
      @include('indexs.public.footer');
      <script>
          $("#addcar").click(function(){
              var goods_id = {{$id}};
              var buy_num =  $(".spinnerExample").val();

              if(buy_num<1){
                  alert('购买量最小为1');
                  return;
              }

            $.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
            $.post('/addcar',{goods_id:goods_id,buy_num:buy_num},function(res){
                if(res.no=='0'){
                  alert(res.msg);
                  location.href='/log?refer='+location.href;
                }
                if(res.no=='000'){
                  alert(res.msg);
                  return;
                }
                if(res.no=='1'){
                  alert(res.msg);
                  location.href="/car/carlist";
                }
            },'json');
          });
      
      
      </script>
     @endsection