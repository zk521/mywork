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
            <span class="tab-front" id="general-tab">生成SKU</span>
        </p>
    </div>

    <!-- tab body -->
    <div id="tabbody-div">

            <table width="90%" id="general-table" align="center" style="display: table;">
                <tbody>
                <tr>
                    <input type="hidden" name="goods_id" id="goods_id" value="<?php echo $goods_id?>"/>
                    <td class="label">商品规格：</td>
                    <td>
                        <div>
                        <a class="attr_add_list">[+]</a>
                        <select name="cat_id" class="attr_type">
                            <option value="0">请选择...</option>
                            <?php foreach($data as $k=>$v){?>
                                <option value="<?php echo $v['id']?>"><?php echo $v['attr_values']?></option>
                            <?php }?>
                        </select>&nbsp&nbsp&nbsp&nbsp
                        <span></span><br>
                        </div>
                    </td>
                </tr>
                <tr> <td align="center" colspan="2"><input type="button" id="attr_button" value=" 生成SKU " class="button" ></td></tr>
                </tbody></table>
        <form enctype="multipart/form-data" action="index.php?r=goods/sku_add" method="post">
                <table width="80%"  id="attrtype-table" style="display: none;" align="center">
                    <tbody id="attr_type_show">

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
    $(document).on('click','.attr_add_list',function(){
        var str =$(this).parent().clone();
        $(this).parent().parent().append(str);
        $(this).parent().parent().find('div a:gt(0)').attr({class:'attr_del_list'}).html('[-]');
        $(this).parent().parent().find('span:last').html('');
    });
    $(document).on('click','.attr_del_list',function(){
        $(this).parent().remove();
    });

    $(document).on('change','.attr_type',function() {
        var attr_id = $(this).val();
        var goods_id = $('#goods_id').val();
        var obj = $(this);
        $.ajax({
            type: 'post',
            url: 'index.php?r=goods/attrshow',
            data: {
                attr_id: attr_id,
                goods_id: goods_id
            },
            dataType: 'json',
            success: function (data) {
                var attr = data['attr_values'];
                var str = '';
                for (var i = 0; i < attr.length; i++) {
                    str += '<input type="checkbox" name="attr_id[' + data.attr_id + ']" value="' + attr[i] + '" title="'+data.attr_id+'"/>' + attr[i];
                }
                obj.next().html(str);
            }
        })
    });

        $(document).on('click','#attr_button',function(){
            var obj = $('input[type="checkbox"]');
            var goods_id = $('#goods_id').val();

            var str ='';
            var info = '';

            for(var i=0;i<obj.length;i++){
                if(obj.eq(i).prop('checked')==true){
                    str += '|'+obj.eq(i).prop('title')+'-'+obj.eq(i).val();
                }
            }

            $.ajax({
                type:'post',
                url: 'index.php?r=goods/add_sku',
                data:{
                    info:str
                },
                dataType:'json',
                success:function(data){
                    info +='<tr><th>SUK货号</th><th>规格属性</th><th>商品价格</th><th>商品库存</th></tr>';

                    $.each(data,function(k,v) {
                        info += '<tr><input type="hidden" name="goods_id[]" value="'+goods_id+'"/><td align="center"><input type="text" name="product_sn[]"/></td><td align="center"><input type="hidden" name="attr_list_value[]" value="'+v+'"/>'+v+'</td><td align="center"><input type="text" name="store_num[]"/></td><td align="center"><input type="text" name="goods_price[]"/></td></tr>';
                    })
                    $('#attrtype-table').css('display','');
                    $('#attr_type_show').html(info);
                }
            })
        });
</script>
</body>
</html>