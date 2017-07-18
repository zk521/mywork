<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>利率添加-有点</title>
<link rel="stylesheet" type="text/css" href="css/css.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">公共管理</a>&nbsp;-</span>&nbsp;利率添加
			</div>
		</div>
		<div class="page ">
			<!-- 利率添加页面样式 -->
			<div class="banneradd bor">
				<div class="baTopNo">
					<span>利率添加</span>
				</div>
				<div class="baBody">
					<div class="bbD">
						返利级别：<input type="text" class="input3" />&nbsp;&nbsp;&nbsp;
						<input type="button" style="display: inline-block; width: 80px; height: 40px; line-height: 40px; background-color: #666; color: #fff; font-size: 16px; cursor: pointer; text-align: center; border: none;" class="produce" value="生成" />
						<p class="box"></p>
					</div>
					<div class="bbD">
						<p class="bbDP">
							<a class="btn_ok btn_yes" href="javascript:;">提交</a> <a
								class="btn_ok btn_no" href="javascript:;">取消</a>
						</p>
					</div>
				</div>
			</div>

			<!-- 利率添加页面样式end -->
		</div>
	</div>
</body>
</html>
<script src="jquery.min.js"></script>
<script>
$(function()
{
	//添加级别
	$('.produce').click(function()
	{
		var num = $('.input3').val();
		var str = '';
		for(var i=1; i<=num; i++) {
			str += '</br>第'+i+'级：&nbsp;&nbsp;&nbsp;<input type="text" class="input2"/></br>'
		}
		$('.box').html(str);

	})

	//提交
	$('.btn_yes').click(function() {
		//获取利率
		var str = '';
		for(var i=0; i<$('.input2').length; i++) {
			str += ','+$('.input2').eq(i).val();
		}
		var rate = str.substr(1);
		$.ajax({
			url:'?r=rate/israte',
			success:function(obj) {
				if(obj == 1) {
					if(confirm("原利率有内容，是否替换？") == true) {
							$.ajax({
							url:'?r=rate/addsql',
							type:'post',
							data:{'rate':rate},
							success:function(msg) {
								if(msg == 1) {
									alert('替换成功');
									window.location.href='?r=rate/set';
								}
							}
						})
					}
				} else {
					$.ajax({
						url:'?r=rate/addsql',
						type:'post',
						data:{'rate':rate},
						success:function(msg) {
							if(msg == 1) {
								alert('添加成功');
								window.location.href='?r=rate/set';
							}
						}
					})
				}
			}
		})
	})

})
</script>