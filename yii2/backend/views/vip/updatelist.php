<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员编辑-有点</title>
<link rel="stylesheet" type="text/css" href="css/css.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">会员管理</a>&nbsp;-</span>&nbsp;会员信息修改
			</div>
		</div>
		<div class="page ">
			<!-- 上传广告页面样式 -->
			<div class="banneradd bor">
				<div class="baTopNo">
					<span>会员信息修改</span>
				</div>
				<div class="baBody">
					<div class="bbD">
						会员邮箱：<input type="text" class="input3" id="email" value="<?=$update[0]['email']?>" />
					</div>
					<div class="bbD">
						会员昵称：<input type="text" class="input3" id="alias" value="<?=$update[0]['name']?>"/>
					</div>
					<div class="bbD">
						移动电话：<input type="text"  class="input3" id="mobile_phone" value="<?=$update[0]['tel']?>"/>
					</div>
					<div class="bbD">
						推荐人id：<input type="text" class="input3" id="parent_id" value="<?=$update[0]['parent_id']?>"/>
					</div>
					<div class="bbD">
						会员等级：	<select class="input3" id="lever">
								<?php foreach ($leverdata as $key => $val): ?>
										<option value="<?=$val['rank_id']?>"><?=$val['rank_name']?></option>
								<?php endforeach;?>
									</select>
					</div>
					<div class="bbD">
						是否生效：<input type="radio" name="is_validated" id="is_validated" value="是">是
								  <input type="radio" name="is_validated" id="is_validated" value="否">否
					</div>
					<div class="bbD">
						<p class="bbDP">
							<button class="btn_ok btn_yes" href="#" id="btn">确认修改</button>
							<a class="btn_ok btn_no" href="#">取消</a>
						</p>
					</div>
					<span id="vipadd"></span>
				</div>
			</div>

			<!-- 上传广告页面样式end -->
		</div>
	</div>
</body>
</html>
<script>
	$("#btn").click(function(){
		var email = $("#email").val();
		var alias = $("#alias").val();
		var mobile_phone = $("#mobile_phone").val();
		var parent_id = $("#parent_id").val();
		var lever = $("#lever").val();
		var is_validated = $("#is_validated").val();
		alert(is_validated);
		$.ajax({
			url:"?r=vip/updateadd",
			data:{email:email,alias:alias,mobile_phone:mobile_phone,parent_id:parent_id,lever:lever,is_validated:is_validated},
			success:function(msg){
				alert(msg);
				// if (msg==1) {
				// 	$("#vipadd").html("添加成功");
				// }else{
				// 	$("#vipadd").html("添加失败");
				// }
			}
		})
	})
</script>