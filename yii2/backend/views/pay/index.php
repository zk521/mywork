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
					href="#">支付接口</a>&nbsp;-</span>&nbsp;接口信息
			</div>
		</div>
				<a class="addA addA1" href="?r=pay/paylist">账户列表</a> 
				<a class="addA addA1" href="?r=pay/">支付宝</a> 
				<a class="addA addA1" href="?r=pay/">微信</a> 
		<div class="page ">
			<!-- 上传广告页面样式 -->
			<div class="banneradd bor">
				<div class="baTopNo">
					<span>支付宝</span>
				</div>
				<div class="baBody">
					<div class="bbD">
						支付方式名称：<input type="text" class="input3" id="p_name" value="支付宝" />
					</div>
					<div class="bbD">
						支付方式描述：<input type="text" class="input3" id="p_desc" value="描述" />
					</div>
					<div class="bbD">
						支付宝账户邮箱(微信appid)：<input type="text"  class="input3" id="account_numb" />
					</div>
					<div class="bbD">
						安全校验码(微信key)：<input type="text" class="input3" id="keys" />
					</div>
					<div class="bbD">
						合作者身份(微信appsecret)：<input type="text" class="input3" id="partner_id" />
					</div>
					<div class="bbD">
						微信支付手段(mchid)：<input type="text" class="input3" id="mch_id" value="微信支付手段" />
					</div>
					<div class="bbD">
						支付宝是否开启：<input type="radio" name="is_on" id="is_on" value="1">是
								  <input type="radio" name="is_on" id="is_on" value="0">否
					</div>
					<div class="bbD">
						<p class="bbDP">
							<button class="btn_ok btn_yes" href="#" id="btn">确认</button>
							<a class="btn_ok btn_no" href="#">取消</a>
							<span id="pay"></span>
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
// 支付宝start
	$("#btn").click(function(){
		var p_name = $("#p_name").val();
		var p_desc = $("#p_desc").val();
		var account_numb = $("#account_numb").val();
		var partner_id = $("#partner_id").val();
		var keys = $("#keys").val();
		var is_on = $("#is_on").val();
		var mch_id = $("#mch_id").val();
		$.ajax({
			url:"?r=pay/paydata",
			data:{p_name:p_name,p_desc:p_desc,account_numb:account_numb,partner_id:partner_id,keys:keys,is_on:is_on,mch_id:mch_id},
			success:function(msg){
				if (msg==1) {
					$("#pay").html("添加成功");
				}else{
					$("#pay").html("添加失败");
				}
			}
		})
	})
// 支付宝end
</script>