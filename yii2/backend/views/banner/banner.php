<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>广告-有点</title>
<link rel="stylesheet" type="text/css" href="css/css.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<!-- <script type="text/javascript" src="js/page.js" ></script> -->
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">公共管理</a>&nbsp;-</span>&nbsp;广告管理
			</div>
		</div>
		<div class="page">
			<!-- banner页面样式 -->
			<div class="banner">
				<div class="add">
					<a class="addA" href="?r=banner/add">上传广告&nbsp;&nbsp;+</a>
				</div>
				<!-- banner 表格 显示 -->
				<div class="banShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="66px" class="tdColor tdC">序号</td>
							<td width="315px" class="tdColor">图片</td>
							<td width="120px" class="tdColor">广告主题</td>
							<td width="200px" class="tdColor">广告描述</td>
							<td width="150px" class="tdColor">添加时间</td>
							<td width="150px" class="tdColor">广告投放地址</td>
							<td width="150px" class="tdColor">地区ID（定点投放预留）</td>
							<td width="125px" class="tdColor">操作</td>
						</tr>
						<?php foreach($img as $k=>$v ) {?>
						<tr>
							<td><?=$v['id']?></td>
							<td>
								<a target="_blank" href="<?=$v['m_path']?>">
									<div align="center" class="bsImg">
										<img title="点击查看原图" src="<?=$v['m_path']?>">
									</div>
								</a>
							</td>
							<td><?=$v['ad_name']?></td>
							<td><?=$v['desc']?></td>
							<td><?=$v['addtime']?></td>
							<td><a class="bsA" href="<?=$v['ad_path']?>"><?=$v['ad_path']?></a></td>
							<td><?=$v['region_id']?></td>
							<td>
								<a href="?r=banner/updaview&id=<?=$v['id']?>"><img class="operation" src="img/update.png"></a>
								<img class="operation delban" id="<?=$v['id']?>" src="img/delete.png">
							</td>
						</tr>
						<?php }?>
					</table>
				</div>
				<!-- banner 表格 显示 end-->
			</div>
			<!-- banner页面样式end -->
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
				<a href="#" class="ok yes" onclick="del()">确定</a><a class="ok no">取消</a>
			</p>
		</div>
	</div>
	<!-- 删除弹出框  end-->
</body>

<script type="text/javascript">
// 广告弹出框
$(".delban").click(function(){
	$(".banDel").show();
	_this = $(this);
	//确定删除此条广告
	var id = $(this).attr('id');
	$('.yes').click(function() {
  		$.ajax({
  			url:'?r=banner/del',
  			type:'post',
  			data:{'id':id},
  			success:function(obj) {
  				// alert(obj)
  				if(obj == 1) {
  					$(".banDel").hide();
  					_this.parent().parent().remove();
  				}
  			}
  		})
	})
});
$(".close").click(function(){
  $(".banDel").hide();
});
$(".no").click(function(){
  $(".banDel").hide();
});
// 广告弹出框 end

function del(){
    var input=document.getElementsByName("check[]");
    for(var i=input.length-1; i>=0;i--){
       if(input[i].checked==true){
           //获取td节点
           var td=input[i].parentNode;
          //获取tr节点
          var tr=td.parentNode;
          //获取table
          var table=tr.parentNode;
          //移除子节点
          table.removeChild(tr);
        }
    }     
}
</script>
</html>