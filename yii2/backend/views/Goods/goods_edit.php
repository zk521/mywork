<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <title></title>
    <link href="styles/general.css" rel="stylesheet" type="text/css" />
    <link href="styles/main.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="js/utils.js"></script>
    <script type="text/javascript" src="js/selectzone.js"></script>
    <script type="text/javascript" src="js/colorselector.js"></script>
    <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="ue/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="ue/ueditor.all.min.js"> </script>
</head>
<body>
<h1>
    <span class="action-span"><a href="goods.php?act=list">商品列表</a></span>
    <span class="action-span1"><a href="index.php?r">商品管理中心 </a> </span><span id="search_id" class="action-span1"> - 添加商品信息 </span>
    <div style="clear:both"></div>
</h1>

<div class="tab-div">
    <!-- tab bar -->
    <div id="tabbar-div">
        <p>
            <span class="tab-front" id="general-tab">通用信息</span>
            <span class="tab-back" id="detail-tab">详细描述</span>
            <span class="tab-back" id="properties-tab">商品属性</span>
            <span class="tab-back" id="gallery-tab">商品相册</span>
        </p>
    </div>

    <!-- tab body -->
    <div id="tabbody-div">
        <form enctype="multipart/form-data" action="index.php?r=goods/add_goods" method="post">

            <!-- 通用信息 -->
            <table width="90%" id="general-table" align="center" style="display: table;">
                <tbody>
                <tr>
                    <td class="label">商品名称：</td>
                    <td><input type="text" name="goods_name" value="诺基亚N85" size="30"><span class="require-field">*</span></td>
                </tr>
                <tr>
                    <td class="label">商品货号： </td>
                    <td><input type="text" name="goods_sn" value="ECS000032" size="20" onblur="checkGoodsSn(this.value,'32')"><span id="goods_sn_notice"></span><br>
                        <span class="notice-span" style="display:block" id="noticeGoodsSN">如果您不输入商品货号，系统将自动生成一个唯一的货号。</span></td>
                </tr>
                <tr>
                    <td class="label">商品分类：</td>
                    <td>
                        <select name="cat_id" onchange="hideCatDiv()">
                            <option value="0">请选择...</option>
                            <?php foreach($cat as $k=>$v){?>
                                    <option value="<?php echo $v['id']?>"><?php echo $v['kong']?><?php echo $v['cat_name']?></option>
                                <?php }?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">商品品牌：</td>
                    <td>
                        <select name="brand_id" onchange="hideBrandDiv()">
                            <option value="0">请选择...</option>
                            <?php foreach($brand as $k=>$v){?>
                                <option value="<?php echo $v['id']?>"><?php echo $v['brand_name']?></option>
                            <?php }?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="label">本店售价：</td>
                    <td><input type="text" name="shop_price" value="3010.00" size="20" onblur="priceSetted()">
                </tr>
                <tr>
                    <td class="label"><a href="javascript:showNotice('noticeStorage');" title="点击此处查看提示信息"><img src="good_img/notice.gif" width="16" height="16" border="0" alt="点击此处查看提示信息"></a> 商品库存数量：</td>
                    <td><input type="text" name="goods_number" value="4" size="20"></td>
                </tr>
                <tr id="alone_sale_1">
                    <td class="label" id="alone_sale_2">上架：</td>
                    <td id="alone_sale_3"><input type="checkbox" name="is_on_sale" value="1" checked="checked"> 打勾表示允许销售，否则不允许销售。</td>
                </tr>
                <tr>
                    <td class="label">上传商品图片：</td>
                    <td>
                        <input type="file" name="goods_img" size="35">
                        <a href="" target="_blank"><img src="good_img/yes.gif" border="0"></a>
                    </td>
                </tr>

                </tbody></table>

            <!-- 详细描述 -->
            <table width="90%" id="detail-table" style="display: none;">
                <tbody>
                <script id="editor" name="goods_desc" type="text/plain"  style="width:1024px;height:500px;"></script>
                <script type="text/javascript">
                    //实例化编辑器
                    //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
                    var ue = UE.getEditor('editor');
                </script>
                </tbody>
            </table>

            <!-- 商品属性 -->
            <table width="90%" id="properties-table" style="display: none;" align="center">
                <tbody>
                <tr>
                    <td class="label">商品类型：</td>
                    <td>
                        <select name="goods_type" id="lei" >
                            <option value="0">请选择商品类型</option>
                            <?php foreach($cat as $k=>$v){
                                if($v['parent_id']==0){
                                ?>
                            <option value="<?php echo $v['id']?>"><?php echo $v['kong']?><?php echo $v['cat_name']?></option>
                            <?php }
                                }?>
                        </select><br>
                        <span class="notice-span" style="display:block" id="noticeGoodsType">请选择商品的所属类型，进而完善此商品的属性</span>
                    </td>
                </tr>
                <tr>
                    <td id="tbody-goodsAttr" colspan="2" style="padding:0">
                        <table width="100%" id="attrTable">
                            <tbody id="tbody">

                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>

            <!-- 商品相册 -->
            <table width="90%" id="gallery-table" style="display: none;" align="center">
                <tbody ><tr>
                    <td class="div_add">
                        <div id="gallery_41" style="float:left; text-align:center; border: 1px solid #DADADA; margin: 4px; padding:2px;" >
                            <a href="javascript:;" onclick="if (confirm('您确实要删除该图片吗？')) dropImg('41')">[+]</a><br>
                            <a href="" target="_blank">
                                <img src="" id="img_url" width="100" height="100" border="0">
                            </a><br>
                        </div>
                    </td>
                </tr>
                <tr><td>&nbsp;</td></tr>
                <tr>
                    <td  style="float: left">
                        <a  class="addimg">[+]</a>
                        图片描述 <input type="text" name="img_desc[]" size="20">
                        上传文件 <input type="file" name="img_url[]" class="img_change">
                        </td>
                </tr>
                </tbody>
            </table>

            <div class="button-div">
                <input type="submit" value=" 确定 " class="button" >
                <input type="reset" value=" 重置 " class="button">
            </div>
        </form>
    </div>
</div>


<div id="footer">
    版权所有 &copy; 2006-2013
</div>
<script type="text/javascript" src="js/tab.js"></script>
<script type="text/javascript">
    function addImg(obj){
        var src  = obj.parentNode.parentNode;
        var idx  = rowindex(src);
        var tbl  = document.getElementById('gallery-table');
        var row  = tbl.insertRow(idx + 1);
        var cell = row.insertCell(-1);
        cell.innerHTML = src.cells[0].innerHTML.replace(/(.*)(addImg)(.*)(\[)(\+)/i, "$1removeImg$3$4-");
    }

    function removeImg(obj){
        var row = rowindex(obj.parentNode.parentNode);
        var tbl = document.getElementById('gallery-table');
        tbl.deleteRow(row);
    }

    function dropImg(imgId){
        Ajax.call('goods.php?is_ajax=1&act=drop_image', "img_id="+imgId, dropImgResponse, "GET", "JSON");
    }

    function dropImgResponse(result){
        if (result.error == 0){
            document.getElementById('gallery_' + result.content).style.display = 'none';
        }
    }

</script>
<script type="text/javascript">
    $(function(){
        $('#lei').change(function(){
            var id = $(this).val();
            $.ajax({
                url:'index.php?r=goods/attr_show',
                type:'post',
                data:{
                    id:id
                },
                dataType:'json',
                success:function(data){
                    var str = '';
                    $.each(data, function(i, item){
                        str +='<tr> <td class="label">'+item['attr_values']+'</td><td><input name="attr_value_id[]" type="hidden" value="'+item['id']+'" size="40"> <input name="attr_value_list[]" type="text" value="" size="40"></td></tr>';
                    });
                    $('#tbody').html(str);
                }
            })
        })
    })
</script>
<script type="text/javascript">
    $(function() {
        var i = 0;
        $(document).on('click', '.addimg', function () {
            i += 1;
            var obj =$(this);
            var obj2 = $('#gallery_41');
            var str = obj.parent().clone();
            var str2 = obj2.clone();
            $(this).parent().after(str);
            obj2.after(str2);
            $(this).parent().next().find('a').attr({class:'delimg',uid:i}).html('[-]');
            obj2.next().attr({class:'div_delimg',uid:i});
            obj2.next().find('img').attr('src','');
        });

        $(document).on('click', '.delimg', function () {
            var obj = $(this);
            var div = $('.div_delimg');
            var uid = $(this).attr('uid');

            for (var k = 0; k < div.length; k++) {
                if (div.eq(k).attr('uid') == uid) {
                    obj.parent().remove();
                    div.eq(k).remove();
                }
            }

        })

        $(document).on('change', '.img_change', function () {
            var img = window.URL.createObjectURL(this.files[0]);
            var obj = $(this);
            var div = $('div');
            var uid_a = obj.parent().find('a').attr('uid');

            for (var k = 0; k < div.length; k++) {
                if (div.eq(k).attr('uid') == uid_a) {
                    div.eq(k).find('#img_url').attr('src', img);
                }
            }
        })
    })
</script>
</body>
</html>