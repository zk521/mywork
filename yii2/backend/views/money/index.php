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
<script type="text/javascript" src="js/money.js"></script>
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
						商家：<select name="bussiness_id" id="shangjia">
							<option value="">选择商家</option>
							<?php foreach ($buss as $key => $value): ?>
							<option value="<?=$value['id']?>" style="text-align: center"><?=$value['b_name']?></option>
							<?php endforeach ?>
							</select>
						<button class="button">搜索</button>
					</div>

				</div>
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="200px" class="tdColor">编号</td>
							<td width="200px" class="tdColor">提现人</td>
							<td width="200px" class="tdColor">提现方式</td>
							<td width="200px" class="tdColor">提现金额</td>
							<td width="200px" class="tdColor">打款状态</td>
							<td width="200px" class="tdColor">提钱时间</td>
							<td width="200px" class="tdColor">where</td>
						</tr>
						<tbody class="search">
					<?php foreach ($money as $key => $value): ?>
						<tr>
							<td><?=$value['m_id']?></td>
							<td><?=$value['b_name']?></td>
							<td><?=$value['type']?></td>
							<td><?=$value['m_money']?></td>
							<?php if ($value['account_status'] == 1): ?>
							<td><span status="1">未打款</span></td>
							<?php else:?>
							<td><span status="2">打款</span></td>
							<?php endif ?>
							<td><?=date('Y-m-d H:i',$value['m_time'])?></td>
							<td><?=$value['where']?></td>
						</tr>
					<?php endforeach ?>
						</tbody>
					</table>
					<div class="paging"> 
					<div class="page">
					<?= LinkPager::widget(['pagination' => $pagination]); ?>
					</div>
        			</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	$( "input[name='act_start_time'],input[name='act_stop_time']" ).datetimepicker();
</script>
</html>