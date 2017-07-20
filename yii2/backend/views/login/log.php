<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>登录-有点</title>
<link rel="stylesheet" type="text/css" href="css/public.css" />
<link rel="stylesheet" type="text/css" href="css/page.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/public.js"></script>
</head>
<body>

	<!-- 登录页面头部 -->
	<div class="logHead">
		<img src="img/logLOGO.png" />
	</div>
	<!-- 登录页面头部结束 -->

	<!-- 登录body -->
	<div class="logDiv">
		<img class="logBanner" src="img/logBanner.png" />
		<div class="logGet">
			<!-- 头部提示信息 -->
			<div class="logD logDtip">
				<p class="p1">登录</p>
				<p class="p2">运营平台</p>
			</div>
			<!-- 输入框 -->
			<div class="lgD">
				<img class="img1" src="img/logName.png" />
				<input type="text" class="username" name="username" placeholder="输入用户名" />
			</div>
			<div class="lgD">
				<img class="img1" src="img/logPwd.png" />
				<input type="password" class="pwd" name="pwd" placeholder="输入用户密码" id="enter2">
			</div>
			<!-- <div class="lgD logD2">
				<input class="getYZM" type="text" />
				<div class="logYZM">
					<img class="yzm" src="img/logYZM.png" />
				</div>
			</div> -->
			<div class="logC">
				<button>登 录</button>
			</div>
		</div>
	</div>
	<!-- 登录body  end -->

	<!-- 登录页面底部 -->
	<div class="logFoot">
		<p class="p1">版权所有：南京设易网络科技有限公司</p>
		<p class="p2">南京设易网络科技有限公司 登记序号：苏ICP备11003578号-2</p>
	</div>
	<!-- 登录页面底部end -->
</body>
</html>
<script src="js/jquery-1.7.2.min.js"></script>
<script>
	$('.logC').on('click',function(){
		var username=$('.username').val();
		var pwd=$('.pwd').val();
		var index='username';
		$.ajax({
			'data':{username:username,pwd:pwd,index:index},
			'url':'?r=login/check_login',
			'type':'post',
              	success:function(msg){
                if(msg == 2)
                {
                    $('#enter2').parent().html('<input type="text" name="pwd" value="密码不正确" style="color:red;" required="required" class="enter2">');
                    
                     $('.enter2').click(function()
                    {
                        
                       $(this).parent().html('<img class="img1" src="img/logPwd.png" /><input type="password" class="pwd" name="pwd" placeholder="输入用户密码" /id="enter2">');
                      
                    })
                }
                else
                {
                    window.location.href='?r=index/index';
                }
             } 		
		})
		
	})
</script>
