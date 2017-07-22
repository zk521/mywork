<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>SHOP 管理中心 - 订单管理 </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/general.css" rel="stylesheet" type="text/css" />
<link href="css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
</head>
<body>

<h1>
<!-- <span class="action-span"><a href="brand.php?act=add">添加品牌</a></span> -->
<span class="action-span1"><a href="index.php?act=main">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 订单管理 </span>
<div style="clear:both"></div>
</h1>

<div class="form-div">
      <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH">
        <input type="text" name="order_sn" id="order_sn" size="15">
        <select id="order_status">
          <option value="">--订单状态--</option>
          <option value="0">未确认</option>
          <option value="1">确认</option>
          <option value="2">已经取消</option>
          <option value="3">无效</option>
          <option value="4">退货</option>
        </select>
        <select id="shipping_status">
          <option value="">--配送状态--</option>
          <option value="0">未发货</option>
          <option value="1">已发货</option>
          <option value="2">已签收</option>
          <option value="3">配货中</option>
          <option value="4">退货</option>
        </select>
    <button class="button" id="btn">搜索</button>
    <span style="background-color: rgb(255, 255, 255);">根据订单号和状态搜索</span>
</div>

<form method="post" action="" name="listForm">
<!-- start brand list -->
<div class="list-div" id="listDiv">

  <table cellpadding="3" cellspacing="1">
    
		<tr>
			<th>订单ID</th>
			<th>订单号</th>
      <th>用户id</th>
      <th>商品名称</th>
      <th>数量</th>
      <th>属性值</th>
      <th>价格</th>
      <th>订单状态</th>订单的状态;0未确认,1确认,2已取消,3无效,4退货</br>
      <th>配送状态</th>商品配送情况;0未发货,1已发货,2已签收,3配货中，4退货 
			<th>操作</th>
		</tr>
  <?php foreach($order_data as $key=>$val) :?>
  <tbody id="box">
    <tr>
      <td style="width: 10px;"><?=$val['id']?></td>
      <td style="width: 140px;"><?=$val['order_sn']?></td>
      <td style="width: 10px;"><?=$val['user_id']?></td>
      <td style="width: 140px;"><?=$val['goods_name']?></td>
      <td style="width: 40px;"><?=$val['buy_number']?></td>
      <td style="width: 200px;"><?=$val['goods_attr']?></td>
      <td style="width: 80px;"><?=$val['goods_price']?></td>
      <td style="width: 120px;"><?=$val['order_status']?></td>
      <td style="width: 120px;"><?=$val['shipping_status']?></td>
			<td align="center" style="width: 120px;background-color: rgb(255, 255, 255);">
          <a href="?r=order/info"><img src="images/info.png" style="width: 30px;height: 30px;"></a>   
      </td>
		</tr>
   </tbody>
  <? endforeach ;?>
    <tr>
  		<td align="right" nowrap="true" colspan="6">
              <div id="turn-page">
  			总计  <span id="totalRecords">11</span>
          个记录分为 <span id="totalPages">2</span>
          页当前第 <span id="pageCurrent">1</span>
          页，每页 <input type="text" size="3" id="pageSize" value="10" onkeypress="return listTable.changePageSize(event)">
          <span id="page-link">
            <a href="javascript:listTable.gotoPageFirst()">第一页</a>
            <a href="javascript:listTable.gotoPagePrev()">上一页</a>
            <a href="javascript:listTable.gotoPageNext()">下一页</a>
            <a href="javascript:listTable.gotoPageLast()">最末页</a>
            <select id="gotoPage" onchange="listTable.gotoPage(this.value)">
              <option value="1">1</option><option value="2">2</option>          </select>
          </span>
        </div>
      </td>
    </tr>
 </table>

<!-- end brand list -->
</div>
</form>


<div id="footer">
	版权所有 &copy; 2016-2017 软工教育 - 高级PHP - </div>
</div>

</body>
</html>
<script>
    $("#btn").click(function(){
        var order_sn = $("#order_sn").val();
        var order_status = $("#order_status").val();
        var shipping_status = $("#shipping_status").val();
        $.ajax({
          url:'index.php?r=order/info',
          data:{order_sn:order_sn,order_status:order_status,shipping_status:shipping_status},
          dataType:'json',
          success:function(msg){
            str = '';
            $.each(msg,function(k,v){
              str += ' <tr><td style="width: 10px;">'+v.id+'</td><td style="width: 140px;">'+v.order_sn+'</td><td style="width: 10px;">'+v.user_id+'</td><td style="width: 140px;">'+v.goods_name+'</td><td style="width: 40px;">'+v.buy_number+'</td><td style="width: 200px;">'+v.goods_attr+'</td><td style="width: 80px;">'+v.goods_price+'</td><td style="width: 120px;">'+v.order_status+'</td><td style="width: 120px;">'+v.shipping_status+'</td><td align="center" style="width: 120px;background-color: rgb(255, 255, 255);"><a href="?r=order/info"><img src="images/info.png" style="width: 30px;height: 30px;"></a></td></tr>';
            })
            $("#box").html(str);
          }
        })
    })
</script>