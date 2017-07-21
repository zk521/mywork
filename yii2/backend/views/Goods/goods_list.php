<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title></title>
    <link href="styles/general.css" rel="stylesheet" type="text/css" />
    <link href="styles/main.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
</head>
<body>
<h1>
    <span class="action-span"><a href="index.php?r=goods/goods_add">添加新商品</a></span>
    <span class="action-span1"><a href="index.php?r=goods/goods">商品管理中心</a> </span><span id="search_id" class="action-span1"> - 商品列表 </span>
    <div style="clear:both"></div>
</h1>

<div class="form-div">
    <img src="good_img/icon_search.gif" width="26" height="22" border="0" alt="SEARCH">
    <!-- 分类 -->
    <select name="cat_id" id="cat_id">
        <option value="0">所有分类</option>
        <?php foreach($cat as $k=>$v){?>
            <option value="<?php echo $v['id']?>"><?php echo $v['kong']?><?php echo $v['cat_name']?></option>
        <? }?>
    </select>
    <!-- 品牌 -->
    <select name="brand_id" id="brand_id">
        <option value="0">所有品牌</option>
        <?php foreach($brand as $k=>$v){?>
        <option value="<?php echo $v['id']?>"><?php echo $v['brand_name']?></option>
        <? }?>
    </select>
    <!-- 关键字 -->
    关键字 <input type="text" id="keyword" name="keyword" size="15">
    <input type="button" value=" 搜索 " id="sou" class="button">
</div>

<form method="post" action="" name="listForm" onsubmit="return confirmSubmit(this)">
    <!-- start goods list -->
    <div class="list-div" id="listDiv">
        <table cellpadding="3" cellspacing="1">
            <tbody>
            <tr>
                <th><input type="checkbox">编号</th>
                <th>商品名称</th>
                <th>货号</th>
                <th>库存</th>
                <th>审核状态</th>
                <th>操作</th>
            </tr>
            <tr></tr>
            <tbody id="goods_info_tbody">
            <?php foreach($goods as $k=>$v){?>
            <tr>
                <td align="center"><input type="checkbox" name="checkboxes[]" value=""></td>
                <td class="first-cell" align="center"><span><?php echo $v['goods_name']?></span></td>
                <td align="center"><span><?php echo $v['goods_sn']?></span></td>
                <td align="center"><span onclick=""><?php echo $v['goods_number']?></span></td>
                <td align="center"><span onclick="">
                        <?php if($v['is_reviewed']==0){
                            echo '未审核';
                        }else{
                            echo '已审核';
                        }?>
                    </span></td>
                <td align="center">
                    <input type="hidden" name="goods_id" value="<?php echo $v['id']?>"/>
                    <a href="../goods.php?id=32" target="_blank" title="查看"><img src="good_img/icon_view.gif" width="16" height="16" border="0"></a>
                    <a href="goods.php?act=edit&amp;goods_id=32" title="编辑"><img src="good_img/icon_edit.gif" width="16" height="16" border="0"></a>
                    <a href="index.php?r=goods/goods_sku&&id=<?php echo $v['id']?>" title="生成sku"><img src="good_img/icon_copy.gif" width="16" height="16" border="0"></a>
                    <a href="javascript:;" onclick="listTable.remove(32, '您确实要把该商品放入回收站吗？')" class="del_goods" title="回收站"><img src="good_img/icon_trash.gif" width="16" height="16" border="0"></a>
                    <a href="goods.php?act=product_list&amp;goods_id=32" title="货品列表"><img src="good_img/icon_docs.gif" width="16" height="16" border="0"></a>
                </td>
            </tr>
            <? }?>
            </tbody>
            </tbody>
        </table>
        <!-- end goods list -->

        <!-- 分页 -->
        <table id="page-table" cellspacing="0">
            <tbody>
            <tr>
                <td align="right" nowrap="true" style="background-color: rgb(255, 255, 255);">
                    <!-- $Id: page.htm 14216 2008-03-10 02:27:21Z testyang $ -->
                    <div id="turn-page">
                        总计  <span id="totalRecords"><?php echo $num['num']?></span>个记录,当前第 <span id="pageCurrent">1</span>
                        页，每页 <input type="text" size="3" id="pageSize" value="15" onkeypress="return listTable.changePageSize(event)">
						<span id="page-link">
							<a href="javascript:listTable.gotoPageFirst()">第一页</a>
							<a href="javascript:listTable.gotoPagePrev()">上一页</a>
							<a href="javascript:listTable.gotoPageNext()">下一页</a>
							<a href="javascript:listTable.gotoPageLast()">最末页</a>
							<select id="gotoPage" onchange="listTable.gotoPage(this.value)">
                                <option value="1">1</option><option value="2">2</option>          </select>
						</span>
                    </div>
                </td>
            </tr>
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
        $('.del_goods').click(function(){
            var obj = $(this);
            var goods_id = obj.parent().find('input[name="goods_id"]').val();
            $.ajax({
                type:'post',
                url:'index.php?r=goods/del_goods',
                data:{
                    goods_id:goods_id
                },
                success:function(data){
                    if(data = 1){
                        obj.parent().parent().remove();
                    }
                }
            })
        })

 $('#sou').click(function(){
            var brand_id = $('#brand_id').val();
            var cat_id = $('#cat_id').val();
            var keyword = $('#keyword').val();
            var str = '';
            $.ajax({
                type:'post',
                url :'index.php?r=goods/sou',
                data:{
                    brand_id:brand_id,
                    cat_id:cat_id,
                    keyword:keyword
                },
                dataType:'json',
                success:function(data){
                    if(data==1){
                        str +='暂无数据';
                    }else{
                        $.each(data,function(k,v){
                            str += '<tr><td align="center"><input type="checkbox" name="checkboxes[]" value=""></td><td class="first-cell" align="center"><span>'+v['goods_name']+'</span></td><td align="center"><span>'+v['goods_sn']+'</span></td><td align="center"><span onclick="">'+v['goods_number']+'</span></td><td align="center"><span onclick="">';
                            if(v['is_reviewed']==0){
                                str += "未审核";
                            }else{
                                str += "已审核";
                            }
                            str +='</span></td><td align="center"><input type="hidden" name="goods_id" value="'+v['id']+'"/><a href="../goods.php?id=32" target="_blank" title="查看"><img src="good_img/icon_view.gif" width="16" height="16" border="0"></a><a href="goods.php?act=edit&amp;goods_id=32" title="编辑"><img src="good_img/icon_edit.gif" width="16" height="16" border="0"></a><a href="index.php?r=goods/goods_sku&&id='+v['id']+'" title="生成sku"><img src="good_img/icon_copy.gif" width="16" height="16" border="0"></a><a href="javascript:;" onclick="listTable.remove(32, '+'您确实要把该商品放入回收站吗？'+')" class="del_goods" title="回收站"><img src="good_img/icon_trash.gif" width="16" height="16" border="0"></a><a href="goods.php?act=product_list&amp;goods_id=32" title="货品列表"><img src="good_img/icon_docs.gif" width="16" height="16" border="0"></a></td></tr>';
                        })
                       
                    }
                    
                    $('#goods_info_tbody').html(str);
        
                }
            })
        })
       
    })
</script>
</html>