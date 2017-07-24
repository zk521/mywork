<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<style type="text/css">
body {
  color: white;
}
</style>

</head>
<body style="background: #278296">
<form method="post" action="" name='theForm'>
  <table cellspacing="0" cellpadding="0" style="margin-top: 100px" align="center">
  <tr>
    <td><img src="images/login.png" width="178" height="256" border="0" alt="ECSHOP" /></td>
    <td style="padding-left: 50px">
      <table>
      <tr>
        <td>管理员姓名：</td>
        <td><input type="text" name="bussiness_name"  class="bussiness_name" /></td>
      </tr>
      <tr>
        <td>管理员密码：</td>
        <td><input type="password" name="bussiness_pwd" class="bussiness_pwd" id="enter2" /></td>
      </tr>
      <!-- <tr>
        <td>验证码：</td>
        <td><input type="text" name="captcha" class="capital" /></td>
      </tr>
      <tr>
      <td colspan="2" align="right"><img src="" />
      </td> 
      </tr>-->
      <tr><td colspan="2"><input type="checkbox" value="1" name="remember" id="remember" /><label for="remember">请保存我这次的登录信息</label></td></tr>
      <tr><td>&nbsp;</td><td><input type="button" value="进入商家平台" class="button" /></td></tr>
      <tr>
        <td colspan="2" align="right">&raquo; <a href="../" style="color:white">返回首页</a> &raquo; <a href="get_password.php?act=forget_pwd" style="color:white">你忘记了密码吗？</a></td>
      </tr>
      </table>
    </td>
  </tr>
  </table>
</form>

</body>
<script src="js/jquery-1.7.2.min.js"></script>
<script>
  $('.button').on('click',function(){

    var bussiness_name=$('.bussiness_name').val();

    var bussiness_pwd=$('.bussiness_pwd').val();
    var index='bussiness_name';
    $.ajax({
      'data':{bussiness_name:bussiness_name,bussiness_pwd:bussiness_pwd,index:index},
      'url':'?r=login/check_login',
      'type':'post',
                success:function(msg){
                if(msg == 2)
                {
                    $('#enter2').parent().html('<input type="text" name="bussiness_pwd" value="密码不正确" style="color:red;" required="required" class="enter2">');
                    
                     $('.enter2').click(function()
                    {
                        
                       $(this).parent().html('<input type="password" class="bussiness_pwd" name="bussiness_pwd" placeholder="输入用户密码" /id="enter2">');
                      
                    })
                }
                else if(msg ==1)
                {
                    window.location.href='?r=index/index';
                }
             }    
    })
    
  })
</script>