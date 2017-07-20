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
                <img src="img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;-</span>&nbsp;角色管理
            </div>
        </div>

        <div class="page">
            <!-- user页面样式 -->
            <div class="connoisseur">
             
                <!-- user 表格 显示 -->
                <div class="conShow">
                <form action="?r=admin/premission_add" method="post">
                    <table border="1" cellspacing="0" cellpadding="0" class="tab">
                   
                       
                      
                  <tr>
                           <select name="id">
                             <option value="0">请选择----</option>
                             <?php  foreach ($role as $k => $v) { ?>
                               <option  value="<?=$v['id']?>"><?=$v['role_name']?></option>
                             <?php  } ?>    
                           </select>
                  </tr>
                  
                  
                    <tr>
                        <td>
                            <input type="text" name="admin_id" value="<?php echo $admin_id ;?>"/>
                        </td>

                       
                        <td><input type="submit" value="提交"></td>
                    </tr>

                    </table>
                    </form>
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

</html>                    