<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员管理-有点</title>
<link rel="stylesheet" type="text/css" href="css/css.css" />
<link rel="stylesheet" type="text/css" href="css/manhuaDate.1.0.css">
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/manhuaDate.1.0.js"></script>
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<!-- <script type="text/javascript" src="js/page.js" ></script> -->
	<script type="text/javascript">
$(function (){
  $("input.mh_date").manhuaDate({
    Event : "click",//可选               
    Left : 0,//弹出时间停靠的左边位置
    Top : -16,//弹出时间停靠的顶部边位置
    fuhao : "-",//日期连接符默认为-
    isTime : false,//是否开启时间值默认为false
    beginY : 1949,//年份的开始默认为1949
    endY :2100//年份的结束默认为2049
  });
});
</script>
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">会员管理</a>&nbsp;-</span>&nbsp;级别管理
			</div>
		</div>
			<a class="addA addA1" href="?r=pay/index">账户添加页面+</a> 
		<div class="page">
			<!-- vip页面样式 -->
			<div class="vip">
				<!-- vip 表格 显示 -->
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0">

						<tr>
							<td width="250px" class="tdColor">ID</td>
							<td width="66px" class="tdColor tdC">合作者id</td>
							<td width="250px" class="tdColor">安全校验码</td>
							<td width="282px" class="tdColor">账户</td>
							<td width="282px" class="tdColor">账户内容</td>
							<td width="130px" class="tdColor">操作</td>
						</tr>
			<?php foreach ($paydata as $key => $val): ?>
						<tr>
							<td><?=$val['p_id']?></td>
							<td><?=$val['partner_id']?></td>
							<td><?=$val['keys']?></td>
							<td><?=$val['account_numb']?></td>
							<td id="content">详情</a></td>
							<td>
								<a href="index.php?r=/">
									<img class="operation" src="img/update.png">
								</a> 
								<a href="index.php?r=/">
									<img class="operation delban" src="img/delete.png">
								</a>
							</td>
						</tr>
			<?php endforeach;?>
					</table>
					<div class="paging">jibie</div>
				</div>
				<!-- vip 表格 显示 end-->
			</div>
			<!-- vip页面样式end -->
		</div>

	</div>


	<!-- 删除弹出框 -->
	<div class="banDel">
		<div class="delete">
			<div class="close">
				<a><img src="img/shanchu.png" /></a>
			</div>
			<p class="delP1">你确定要删除此条记录吗？</p>
			<p class="delP2">
				<a href="index.php?r=/" class="ok yes">确定</a><a class="ok no">取消</a>
			</p>
		</div>
	</div>
	<!-- 删除弹出框  end-->
</body>

<script type="text/javascript">
// 广告弹出框
$(".delban").click(function(){
  $(".banDel").show();
});
$(".close").click(function(){
  $(".banDel").hide();
});
$(".no").click(function(){
  $(".banDel").hide();
});
// 广告弹出框 end


</script>
</html>