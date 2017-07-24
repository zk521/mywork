<?php
use yii\widgets\LinkPager;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>约见管理-有点</title>
<link rel="stylesheet" type="text/css" href="css/css.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/page.js" ></script>
<!-- 插件start -->
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker-zh-CN.js"></script>
<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="js/jquery-ui-timepicker-zh-CN.js"></script>
<script type="text/javascript" src="js/order.js"></script>
<link type="text/css" rel="stylesheet" href="css/order.css" />
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">公共管理</a>&nbsp;-</span>&nbsp;订单管理
			</div>
		</div>
		<div class="page">
			<div class="connoisseur">
				<div class="conform">
					<div class="cfD">
						时间段： <input name="act_start_time" type="text" value="" placeholder="开始时间≥当前时间" title="开始时间≥当前时间" readonly="readonly" style="cursor:pointer;" class="vinput" />&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;
						 <input name="act_stop_time" type="text" value="" placeholder="结束时间>开始时间" title="结束时间>开始时间" readonly="readonly" style="cursor:pointer;" class="vinput vpr"/>
					</div>
					<div class="cfD">
						订单状态：<label><input
							type="radio" checked="checked" name="styleshoice1" value="1" />&nbsp;未确认</label> <label><input
							type="radio" name="styleshoice1" value="2"/>&nbsp;确认</label> <label><input
							type="radio" name="styleshoice1" value="3"/>&nbsp;已取消</label> <label><input
							type="radio" name="styleshoice1" value="4"/>&nbsp;无效</label> <label class="lar"><input
							type="radio" name="styleshoice1" value="5"/>&nbsp;退货</label>
					</div>
					<div class="cfD">
						配送情况：<label><input
							type="radio" checked="checked" name="styleshoice2" value="1" />&nbsp;未发货</label> <label><input
							type="radio" name="styleshoice2" value="2" />&nbsp;已发货</label><label><input
							type="radio" name="styleshoice2" value="3" />&nbsp;配货中</label><label><input
							type="radio" name="styleshoice2" value="4" />&nbsp;已签收</label><label><input
							type="radio" name="styleshoice2"  value="5"/>&nbsp;退货</label>
					</div>
					<div class="cfD">		
						支付状态：<label><input
							type="radio" checked="checked" name="styleshoice3" value="1" />&nbsp;未付款</label> <label><input
							type="radio" name="styleshoice3" value="2" />&nbsp;已付款</label>	
					</div>
					<div class="cfD">
						商家：<select name="bussiness_id" id="shangjia">
							<option value="0">选择商家</option>
							<?php foreach ($buss as $key => $value): ?>
							<option value="<?=$value['id']?>" style="text-align: center"><?=$value['b_name']?></option>
							<?php endforeach ?>
							</select>
					</div>
					<div class="cfD">
						<input class="order" type="text" placeholder="输入订单号" name='order_sn' />
						<input class="addUser" type="text" placeholder="输入收件人名字" name="username " />
						<button class="button">搜索</button>
					</div>
				</div>
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="66px" class="tdColor tdC">选择</td>
							<td width="200px" class="tdColor">订单号</td>
							<td width="200px" class="tdColor">下单时间</td>
							<td width="200px" class="tdColor">订单状态</td>
							<td width="200px" class="tdColor">支付状态</td>
							<td width="200px" class="tdColor">支付时间</td>
							<td width="200px" class="tdColor">配送情况</td>
							<td width="200px" class="tdColor">订单留言</td>
							<td width="200px" class="tdColor">收货人</td>
							<td width="200px" class="tdColor">收件人电话</td>
							<td width="200px" class="tdColor">收件人地址</td>
							<td width="130px" class="tdColor">操作</td>
						</tr>
						<tbody class="search">
					<?php foreach ($orderInfo as $key => $value): ?>
						<tr order-info-id="<?=$value['id']?>">
							<td><input name="order_id" type="checkbox" value="<?=$value['id']?>" /></td>
							<td><span class='details' id="<?=$value['id']?>"><?=$value['order_sn']?></span></td>
							<td><?=$value['add_time']?></td>
							<?php if ($value['order_status'] ==1): ?>
								<td><span class="status" stype="order_status" status="<?=$value['order_status']?>">未确认</span></td>
							<?php elseif($value['order_status'] ==2):?>
								<td><span class="status" stype="order_status" status="<?=$value['order_status']?>">确认</span></td>
							<?php elseif($value['order_status'] ==3):?>
								<td><span class="status" stype="order_status" status="<?=$value['order_status']?>">已取消</span></td>
							<?php elseif($value['order_status'] ==4):?>
								<td><span class="status" stype="order_status" status="<?=$value['order_status']?>">无效</span></td>
							<?php elseif($value['order_status'] ==5):?>
								<td><span class="status" stype="order_status" status="<?=$value['order_status']?>">退货</span></td>
							<?php endif ?>
							<?php if ($value['pay_status'] == 1): ?>
								<td><span class="status" stype="pay_status" status="<?=$value['pay_status']?>">未付款</span></td>
							<?php elseif($value['pay_status'] == 2):?>
								<td><span class="status" stype="pay_status" status="<?=$value['pay_status']?>">已付款</span></td>
							<?php endif ?>
							<td><?=$value['pay_time']?></td>
							<?php if ($value['shipping_status'] == 1): ?>
								<td><span class="status" stype="shipping_status" status="<?=$value['shipping_status']?>">未发货</span></td>
							<?php elseif($value['shipping_status'] ==2):?>
								<td><span class="status" stype="shipping_status" status="<?=$value['shipping_status']?>">已发货</span></td>
							<?php elseif($value['shipping_status'] ==3):?>
								<td><span class="status" stype="shipping_status" status="<?=$value['shipping_status']?>">配货中</span></td>
							<?php elseif($value['shipping_status'] ==4):?>
								<td><span class="status" stype="shipping_status" status="<?=$value['shipping_status']?>">已签收</span></td>
							<?php elseif($value['shipping_status'] ==5):?>
								<td><span class="status" stype="shipping_status" status="<?=$value['shipping_status']?>">退货</span></td>
							<?php endif ?>
							<td><?=$value['message']?></td>
							<td><?=$value['username']?></td>
							<td><?=$value['tel']?></td>
							<td><?=$value['path']?></td>
							<td><a href="connoisseuradd.html"><img class="operation"
									src="img/update.png"></a> <img class="operation delban"
								src="img/delete.png"></td>
						</tr>
					<?php endforeach ?>
						</tbody>
					</table>
					<div class="paging"> 
					<div class="page">
					<?= LinkPager::widget(['pagination' => $pagination]); ?>
					</div>
					<input type="checkbox" id="all">  <span>全选/全不选</span>
					<button class="del">批量删除</button>
        			</div>
				</div>
				<div class="conshow order_goods_show" style="display:none">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="200px" class="tdColor">订单商品id</td>
							<td width="200px" class="tdColor">商品名称</td>
							<td width="200px" class="tdColor">商品货号</td>
							<td width="200px" class="tdColor">商品数量</td>
							<td width="200px" class="tdColor">商品价格</td>
							<td width="200px" class="tdColor">商品属性</td>
							<td width="130px" class="tdColor">操作</td>
						</tr>
						<tbody class="order_goods">
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="banDel">
		<div class="delete">
			<div class="close">
				<a><img src="img/shanchu.png" /></a>
			</div>
			<p class="delP1">你确定要删除选中的记录吗？</p>
			<p class="delP2">
				<a class="ok yes">确定</a><a class="ok no">取消</a>
			</p>
		</div>
	</div>
</body>
<script type="text/javascript">
	$( "input[name='act_start_time'],input[name='act_stop_time']" ).datetimepicker();
</script>
</html>