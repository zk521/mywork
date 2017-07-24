<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>行家添加-有点</title>
<link rel="stylesheet" type="text/css" href="css/css.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">公共管理</a>&nbsp;-</span>&nbsp;行家添加
			</div>
		</div>
		<div class="page ">
			<!-- 上传广告页面样式 -->
			<div class="banneradd bor">
				<div class="baTopNo">
					<span>行家添加</span>
				</div>
				<div class="baBody">
					<form action="?r=bussiness/add_pro" method="post">
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;商家名称：<input type="text"
							class="input3" / name="b_name">
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;商家类型：<input type="text"
							class="input3" / name="type">
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;手机号码：<input type="text"
							class="input3" name="tel">
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;邮箱：<input type="text"
							class="input3" name="email" />
					</div>
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;所在城市：<select class="city" name="b_address">
						<option  value="0">请选择--</option>
						<option value="1">中国</option>
						</select>
					</div>
					 
					
					<div class="bbD">
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;审核状态：<label><input
							type="radio" checked="checked" name="status" />&nbsp;未审核</label> <label><input
							type="radio" name="status" />&nbsp;已通过</label> <label class="lar"><input
							type="radio" name="status" />&nbsp;不通过</label>
					</div>
					
					
					
					
					<div class="bbD">
						<p class="bbDP">
							<input type="submit" value="提交"/class="btn_ok btn_no">
							<a class="btn_ok btn_no" href="#">取消</a>
						</p>
					</div>
				</div>
				</form>
			</div>

			<!-- 上传广告页面样式end -->
		</div>
	</div>
</body>
</html>
<script src="js/jquery-1.7.2.min.js"></script>
<script>
    $(document).delegate('.city','change',function(){
        var _this = $(this);
        var region_id = $(this).val();
        // alert(region_id);
     $.ajax({
       type: "GET",
       url: "?r=bussiness/get_region",
       data: {region_id:region_id},
       dataType: 'json',
       success: function(data){
          
        if (data.length>0) {
          var html = '<select name="region[]" id="" class="city"><option value="0">--请选择--</option>';
          $.each(data,function(k,v){
            html += '<option value="'+v.region_id+'">'+v.region_name+'</option>';
          });
            _this.nextAll().remove();
            _this.after(html);
          
          }
  
        

       }
     });
    })
</script>