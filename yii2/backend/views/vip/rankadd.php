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
				<img src="img/coin02.png" /><span>
				<a href="#">首页</a>&nbsp;-&nbsp;<a href="#">会员管理</a>&nbsp;-</span>&nbsp;级别添加
			</div>
		</div>
		<div class="page ">
			<!-- 上传广告页面样式 -->
			<div class="banneradd bor">
				<div class="baTopNo">
					<span>级别编辑</span>
				</div>
				<div class="baBody">
					<div class="bbD">
						会员名称：<input type="text" class="input3" id="rand_name" />
					</div>
					<span id="result"></span>
					<div class="bbD">
						<p class="bbDP">
							<button class="btn_ok btn_yes" href="#" id="submit">提交</button>
							<a class="btn_ok btn_no" href="#" id="off">取消</a>
						</p>
					</div>
				</div>
			</div>

			<!-- 上传广告页面样式end -->
		</div>
	</div>
</body>
</html>
<script>
	$('#submit').click(function(){
		var lever = $("#rand_name").val();
		$.ajax({
			url:"?r=vip/ranklever",
			data:{lever:lever},
			success:function(msg){
				if (msg == 1) {
					$("#result").html("添加成功");
				}else{
					$("#result").html("添加失败");
				}
			}
		})
	})
</script>