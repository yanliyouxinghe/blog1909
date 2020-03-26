<!DOCTYPE html>
<html lang="zh-cn">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Author" contect="http://www.webqin.net">
    <title>三级分销</title>
    <link rel="shortcut icon" href="/static/index/images/favicon.ico" />
    
    <!-- Bootstrap -->
    <link href="/static/index/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/index/css/style.css" rel="stylesheet">
    <link href="/static/index/css/response.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="maincont">
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>购物车</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <table class="shoucangtab">
      <tr>
       <td width="75%"><span class="hui">购物车共有：<strong class="orange">{{$count}}</strong>件商品</span></td>
       <td width="25%" align="center" style="background:#fff url(/static/index/images/xian.jpg) left center no-repeat;">
        <span class="glyphicon glyphicon-shopping-cart" style="font-size:2rem;color:#666;"></span>
       </td>
      </tr>
     </table>
     <!-- <input type="checkbox" id="cart_tr" class="box" />全选 -->
     @foreach($cart as $v)
     <div class="dingdanlist">
      <table>
       <tr  goods_id="{{$v->goods_id}}" id="cart_tr">
        <td width="4%"><input type="checkbox" id="cart_tr" goods_id = {{$v->goods_id}} class="box" name="1" /></td>
        <td class="dingimg" width="15%"><img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" /></td>
        <td width="50%">
         <h3>{{$v->goods_name}}</h3>
         <time>下单时间:{{date("Y-m-d H:i",$v->create_time)}}</time>
        </td>
        <td align="right"><input type="text" class="spinnerExample" id="cart_{{$v->cart_id}}" /></td>
       </tr>
       <tr>
        <th colspan="4"><strong class="orange">¥{{$v->goods_price}}</strong></th>
       </tr>
       <!-- <tr>
        <td width="100%" colspan="4"><a href="javascript:;"><input type="checkbox" name="1" /> 删除</a></td>
       </tr> -->
      </table>
     </div><!--dingdanlist/-->
     @endforeach
     <div class="gwcpiao">
     <table>
      <tr>
       <th width="10%"><a href="javascript:history.back(-1)"><span class="glyphicon glyphicon-menu-left"></span></a></th>
       <td width="50%">总计：<strong class="orange">
     <!-- @foreach($cart as $v)
         ¥{{$v->goods_price*$v->b_num}}
         {{$v->goods_price+$v->b_num}}
      @endforeach -->
      ￥100
        </strong></td>
       <td width="40%"><a href="javascript:void(0)" class="jiesuan">去结算</a></td>
      </tr>
     </table>
    </div><!--gwcpiao/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="/static/index/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/static/index/js/bootstrap.min.js"></script>
    <script src="/static/index/js/style.js"></script>
    <!--jq加减-->
    <script src="/static/index/js/jquery.spinner.js"></script>
   <script>
  $('.spinnerExample').spinner({});
       @if($name='cart')
           @foreach($cart_id as $k=>$v)
           $('#cart_'+{{$v}}).val({{$b_num[$k]}})
          @endforeach
        @endif
	</script>
  </body>
</html>
<script>
  $(function(){
    $(".jiesuan").click(function(){
      var _this = $(this);

      var box = $(".box:checked");
      if(box.length == 0){
      alert('请选择要结算的商品');
      return false;
      }
       
          var str = '';
           box.each(function(){
              str += $(this).parents("tr#cart_tr").attr('goods_id')+','; 
           });
           str = str.trim();
           str = str.substr(0,str.length-1);
           location.href="/pay/?ids="+str;
 
    //  location.href="/pay";
    });








    
  });





</script>
