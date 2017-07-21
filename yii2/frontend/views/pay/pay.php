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
    <span class="action-span1"><a href="index.php?r">商品管理中心 </a> </span><span id="search_id" class="action-span1"> - 录入支付 </span>
    <div style="clear:both"></div>
</h1>

<div class="tab-div">
    <!-- tab bar -->
    <div id="tabbar-div">
        <p>
            <span class="tab-front" id="general-tab">支付</span>
        </p>
    </div>

    <!-- tab body -->
    <div id="tabbody-div">
     <form enctype="multipart/form-data" action="index.php?r=pay/pay_add" method="post">

            <table width="90%" id="general-table" align="center" style="display: table;">
                <tbody>
                <tr>
                    <td class="label">支付方式：</td>
                    <td>
                        <div>
                           <?php foreach ($pays as $key => $value) {?>
                           <input type="radio" name="pay_id" value="<?php echo $value['pay_id']?>"  checked/>
                               <?php echo $value['pay_name']?>
                           <?php }?>
                        <br>

                        </div>
                    </td>
                </tr>
<tr>
                    <td class="label">支付金额：</td>
                    <td>
                        <div>
                          <input type="text" name="pay_price" />
                        <br>
                    
                        </div>
                    </td>
                </tr>
                </tbody></table>
       
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
</body>
</html>