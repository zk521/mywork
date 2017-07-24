<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>SHOP 管理中心 - 商品分类 </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="styles/general.css" rel="stylesheet" type="text/css" />
    <link href="styles/main.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<body>

<h1>
    <span class="action-span"><a href="index.php?r=cat/cat_add">添加分类</a></span>
    <span class="action-span1"><a href="index.php?r=cat/cat">商品管理中心</a> </span><span id="search_id" class="action-span1"> - 商品分类 </span>
    <div style="clear:both"></div>
</h1>

<form method="post" action="" name="listForm">
    <!-- start ad position list -->
    <div class="list-div" id="listDiv">
        <table width="100%" cellspacing="1" cellpadding="2" id="list-table">
            <tbody>
            <tr>
                <th>分类名称</th>
                <th>导航栏</th>
                <th>是否显示</th>
                <th>分类简介</th>
                <th>排序</th>
                <th>操作</th>
            </tr>
            <?php foreach($arr as $k=>$v){?>
            <tr align="center" class="0 trr" title="<?php echo $v['parent_id']?>" c_id="<?php echo $v['id']?>" id="0_1">
                <td align="left" class="first-cell">
                    <?php echo $v['kong']?>
                    <img src="good_img/menu_plus.gif" id="icon_0_1" width="9" height="9" border="0" style="margin-left:0em">
                    <span><a href="goods.php?act=list&amp;cat_id=1"><?php echo $v['cat_name']?></a></span>
                </td>
                <?php if($v['is_nav']==0){?>
                <td width="10%"><img src="good_img/no.gif" onclick="listTable.toggle(this, 'toggle_show_in_nav', 1)"></td>
                <?}else{?>
                <td width="10%"><img src="good_img/yes.gif" onclick="listTable.toggle(this, 'toggle_is_show', 1)"></td>
                <?php }?>
                <?php if($v['is_show']==0){?>
                    <td width="10%"><img src="good_img/no.gif" onclick="listTable.toggle(this, 'toggle_show_in_nav', 1)"></td>
                <?}else{?>
                    <td width="10%"><img src="good_img/yes.gif" onclick="listTable.toggle(this, 'toggle_is_show', 1)"></td>
                <?php }?>
                <td width="30%"><span onclick="listTable.edit(this, 'edit_grade', 1)" title="点击修改内容" style=""><?php echo $v['cat_desc']?></span></td>
                <td width="10%" align="right"><span onclick="listTable.edit(this, 'edit_sort_order', 1)" title="点击修改内容" style=""><?php echo $v['sort']?></span></td>
                <td width="20%" align="center">
                    <a href="category.php?act=edit&amp;cat_id=1">编辑</a> |
                    <a href="javascript:;" class="del" title="移除">移除</a>
                </td>
            </tr>
            <?php }?>
            </tbody>
        </table>
    </div>
</form>



<div id="footer">
    版权所有 &copy; 2006-2013 软工教育 - 高级PHP -
</div>

</body>
<script type="text/javascript">
    $(function(){
        $(document).ready(function(){
            var obj = $(".trr");
            for(var i=0;i<obj.length;i++){
                if(obj.eq(i).attr('title')!=0){
                    obj.eq(i).hide();
                }else{
                    obj.eq(i).find('img').attr('class','show');
                }
            }
        })

        $(document).on("click",".show",function(){
            var obj = $(".trr");
            var cat_id = $(this).parent().parent().attr('c_id');
            for(var i=0;i<obj.length;i++){
                if(obj.eq(i).attr('title')==cat_id){
                    obj.eq(i).show();
                    $(this).attr('class','hide');
                    $(this).attr('src','good_img/menu_minus.gif');
                }
            }
        })

        $(document).on("click",".hide",function(){
            var obj = $(".trr");
            var cat_id = $(this).parent().parent().attr('c_id');
            for(var i=0;i<obj.length;i++){
                if(obj.eq(i).attr('title')==cat_id){
                    obj.eq(i).hide();
                    $(this).attr('class','show');
                    $(this).attr('src','good_img/menu_plus.gif');
                }
            }
        })

        $('.del').click(function(){
            var obj = $(this)
            var id = $(this).parents('tr').attr('c_id');
            $.ajax({
                url:'index.php?r=cat/del_cat',
                type:'post',
                data:{
                    id:id
                },
                success:function(data){
                    if(data){
                        obj.parents('tr').remove();
                    }
                }
            })
        })
    })
</script>
</html>