<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员管理-有点</title>
<link rel="stylesheet" type="text/css" href="css/css.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- <script type="text/javascript" src="js/page.js" ></script> -->
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;-</span>&nbsp;管理员管理----------
			
			</div>
		</div>

		<div class="page">
			<!-- user页面样式 -->
			<div class="connoisseur">
				<div class="conform">
					   
						<div class="cfD">
						    <input class="node_name" type="text"  placeholder="输入权限名" />&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;
							<input class="controller" type="text" placeholder="输入控制器" />&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;
							<input class="action"  type="text"     placeholder="输入方法" />
							<input type="text" class="admin_id" value="<?=$admin_id?>" />
s							<button class="userbtn">添加</button>
						</div>
					
				</div>
				<!-- user 表格 显示 -->
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0" class="tab">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
							<td width="435px" class="tdColor">权限名称</td>
						    <td width="435px" class="tdColor">控制器</td>
						    <td width="435px" class="tdColor">方法</td>
							<td width="130px" class="tdColor">操作</td>
      						
						</tr>
						<?php foreach ($node as $k => $v) {  ?>
							
						
						<tr height="40px">
							<td><?=$v['id']?></td>
						    <td><?=$v['node_name']?></td>
						    <td><?=$v['controller']?></td>
						    <td><?=$v['action']?></td>
							<td><a href="connoisseuradd.html"><img class="operation"
									src="img/update.png"></a> <img class="operation delban"
								src="img/delete.png"></td>
            
							
						</tr>

						<?php  } ?>
                            
					</table>
					<div class="paging">此处是分页</div>
				</div>
				<!-- user 表格 显示 end-->
			</div>
			<!-- user页面样式end -->
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
				<a href="?r=admin/delete" class="ok yes">确定</a><a class="ok no">取消</a>
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
<script src="js/jquery-1.7.2.min.js"></script>
<script>
	$('.userbtn').click(function(){
		var node_name=$('.node_name').val();
		var controller=$('.controller').val();
		var action=$('.action').val();
		var admin_id=$('.admin_id').val();
		$.ajax({
			'url':'index.php?r=admin/node_add',
			'data':{node_name:node_name,controller:controller,action:action,admin_id:admin_id},
			'type':'post',
			'dataType':'json',
			success:function(obj){
              if (obj.msg==1) {
					var str='';
					str+='<tr height="40px"><td>'+obj.last_id+'</td><td>'+node_name+'</td><td>'+controller+'</td><td>'+action+'</td><td><a href="connoisseuradd.html"><img class="operation" src="img/update.png"></a> <img class="operation delban"src="img/delete.png"></td></tr>';

					$('.tab').append(str);

				 };
			}
		})

	

	})
	
</script>
</html>