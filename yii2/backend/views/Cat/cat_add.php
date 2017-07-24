<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>SHOP 管理中心 - 添加分类 </title>
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="styles/general.css" rel="stylesheet" type="text/css" />
    <link href="styles/main.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<body>

<h1>
    <span class="action-span"><a href="index.php?r=cat/cat_add">添加分类</a></span>
    <span class="action-span1"><a href="index.php?r=cat/cat">商品管理中心</a> </span><span id="search_id" class="action-span1"> - 添加分类 </span>
    <div style="clear:both"></div>
</h1>
<!-- start add new category form -->
<div class="main-div">
    <form action="index.php?r=cat/add_cat" method="post" name="theForm" enctype="multipart/form-data" onsubmit="return validate()">
        <table width="100%" id="general-table">
            <tbody>
            <tr>
                <td class="label">分类名称:</td>
                <td><input type="text" name="cat_name" maxlength="20" value="" size="27"> <font color="red">*</font></td>
            </tr>
            <tr>
                <td class="label">上级分类:</td>
                <td>
                    <select name="parent_id" id="parent">
                        <option class="parent"  selected="selected">顶级分类</option>
                        <?php foreach($arr as $k=>$v){?>
                            <option class="parent" value="<?php echo $v['id']?>" title="<?php echo $v['parent_id']?>"><?php echo $v['kong'].$v['cat_name']?></option>
                        <? }?>
                    </select>
                </td>
            </tr>
            <tr id="tr" style="display:">
                <td class="label"><a href="javascript:showNotice('noticeAttrGroups');" title="点击此处查看提示信息"><img src="good_img/notice.gif" width="16" height="16" border="0" alt="点击此处查看提示信息"></a> 属性分组:</td>
                <td>
                    <textarea name="attr_group" rows="5" cols="40"></textarea><br>
                    <span class="notice-span" style="display:block" id="noticeAttrGroups">每行一个商品属性组。排序也将按照自然顺序排序。</span>
                </td>
            </tr>
            <tr>
                <td class="label">排序:</td>
                <td><input type="text" name="sort" value="50" size="15"></td>
            </tr>

            <tr>
                <td class="label">是否显示:</td>
                <td><input type="radio" name="is_show" value="1" checked="true"> 是<input type="radio" name="is_show" value="0"> 否  </td>
            </tr>
            <tr>
                <td class="label">是否显示在导航栏:</td>
                <td><input type="radio" name="is_nav" value="1"> 是  <input type="radio" name="is_nav" value="0" checked="true"> 否    </td>
            </tr>
            <tr>
                <td class="label">分类描述:</td>
                <td>
                    <textarea name="cat_desc" rows="6" cols="48"></textarea>
                </td>
            </tr>
            </tbody></table>
        <div class="button-div">
            <input type="submit" value=" 确定 ">
            <input type="reset" value=" 重置 ">
        </div>
    </form>
</div>


</div>

</body>


<script type="text/javascript">
    $(function() {
        $('#parent').change(function () {
            var id = $(this).val();
            var obj = $('.parent');
            for(var i = 0;i<obj.length;i++){
                if(obj.eq(i).prop('selected') && obj.eq(i).attr('title')>=0){
                    $('#tr').css("display","none");
                    break;
                }else{
                    $('#tr').css("display","");
                }
            }
        })
    })
</script>

</html>