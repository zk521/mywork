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
					href="#">会员管理</a>&nbsp;-</span>&nbsp;会员管理
			</div>
		</div>

		<div class="page">
			<!-- vip页面样式 -->
			<div class="vip">
				<div class="conform">
					<form>
						<div class="cfD">
							时间段：<input class="vinput mh_date" type="text" readonly="true" />&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;
							<input class="vinput mh_date" type="text" readonly="true" />
						</div>
						<div class="cfD">
							<input class="addUser" type="text" placeholder="输入用户名/ID/手机号/城市" />
							<button class="button">搜索</button>
							<a class="addA addA1" href="?r=vip/add">新增会员+</a> 
						</div>
					</form>
				</div>
				<!-- vip 表格 显示 -->
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
							<td width="188px" class="tdColor">姓名</td>
							<td width="250px" class="tdColor">email</td>
							<td width="235px" class="tdColor">会员等级</td>
							<td width="220px" class="tdColor">消费积分</td>
							<td width="282px" class="tdColor">注册时间</td>
							<td width="290px" class="tdColor">最后一次登录时间</td>
							<td width="282px" class="tdColor">审核状态</td>
							<td width="130px" class="tdColor">操作</td>
						</tr>
					<?php foreach ($data as $key => $val): ?>
						<tr>
							<td><?=$val['vip_id']?></td>
							<td><?=$val['name']?></td>
							<td><?=$val['email']?></td>
							<td><?=$val['vip_level']?></td>
							<td><?=$val['pay_points']?></td>
							<td><?=$val['reg_time']?></td>
						<?php if($val['is_audit'] == 1) {?>
							<td>
								<img class="audit" style="height: 50px;width: 50px;" src="img/pass.png" value="<?=$val['vip_id']?>">
							</td>
						<?php }else{?>
							<td>
								<img class="audit" style="height: 50px;width: 50px;" src="img/shenhe.png" value="<?=$val['vip_id']?>">
							</td>
						<?php }?>
							<td><?=$val['last_time']?></td>
							<td>
								<a href="?r=vip/update&id=<?=$val['vip_id']?>">
									<img class="operation" src="img/update.png">
								</a> 
								<a href="?r=vip/vipdel&id=<?=$val['vip_id']?>">
									<img class="operation delban" src="img/delete.png">
								</a> 
							</td>
						</tr>
					<?php endforeach;?>	
					</table>
					<div class="paging">此处是分页</div>
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
				<a href="#" class="ok yes">确定</a><a class="ok no">取消</a>
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

// 审核start
$(".audit").click(function(){
	id = $(this).attr('value');
	_this = $(this);
	$.ajax({
		url:"?r=vip/audit",
		data:{id:id},
		success:function(msg){
			if (msg == 1) {
				_this.attr('src','img/pass.png');
			}
		}
	})
})
// 审核end
</script>
</html>