
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>DouPHP 管理中心 - 系统设置 </title>
<meta name="Copyright" content="Douco Design." />

<link href="goods/css/public.css" type="text/css">
<!--<script type="text/javascript" src="js/jquery.min.js"></script>-->
<!--<script type="text/javascript" src="js/global.js"></script>-->
<!--<script type="text/javascript" src="js/jquery.tab.js"></script>-->
<!--百度编辑器-->
<!--<script type="text/javascript" charset="utf-8" src="ue/ueditor.config.js"></script>-->
<!--<script type="text/javascript" charset="utf-8" src="ue/ueditor.all.min.js"> </script>-->
<!--<script type="text/javascript" charset="utf-8" src="ue/lang/zh-cn/zh-cn.js"></script>-->
<!--时间插件-->
<!--<script type="text/javascript" src="date/js/WdatePicker.js"></script>-->
</head>
<body>
   <!-- 当前位置 -->
<div id="urHere">
        <img src="images/coin02.png" />&nbsp;&nbsp;&nbsp;&nbsp;<span><a style="color:#4a9cce;" href="">首页</a></span>&nbsp;-<span><a style="color:#4a9cce;" href="">商品列表</a></span>-&nbsp;商品添加
</div>   
  <div class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
    <h3>商品添加</h3>
    <script type="text/javascript">
     
     $(function(){ $(".idTabs").idTabs(); });
     
    </script>
    <div class="idTabs">
      <ul class="tab">
        <li><a href="#main">通用信息</a></li>
        <li><a href="#display">详细描述</a></li>
        <li><a href="#defined">其他信息</a></li>
        <li><a href="#attr">商品类型</a></li>
        <li><a href="#sku">货品</a></li>
        <li><a href="#mail">商品相册</a></li>
      </ul>
      <div class="items">
       <form action="" method="post" enctype="multipart/form-data">
        <div id="main">
        <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
          
          <tr>
            <th width="131">名称</th>
            <th>内容</th>
          </tr>

          <tr>
            <td align="right">商品名称</td>
            <td>
              <input type="text" name="goods_name" size="80" class="inpMain" />
            </td>
          </tr>

          <tr>
            <td align="right">商品货号</td>
            <td>
              <input type="text" name="goods_sn" size="80" class="inpMain" />
            </td>
          </tr>

          <tr>
            <td align="right">商品分类</td>
            <td>
              <select name="cat_id">

                <option value=""></option>

              </select>
            </td>
          </tr>

          <tr>
            <td align="right">商品品牌</td>
            <td>
              <select name="brand_id">
              <option value="0">--请选择--</option>

                <option value=""></option>

              </select>
            </td>
          </tr>
               
          <tr>
            <td align="right">本店售价</td>
            <td>
              <input type="text" name="shop_price" size="80" class="inpMain" />
            </td>
          </tr>

          <tr>
            <td align="right">市场售价</td>
            <td>
              <input type="text" name="market_price" size="80" class="inpMain" />
            </td>
          </tr>

          <tr>
            <td align="right">促销价</td>
            <td>
              <input type="text" name="promote_price" size="80" class="inpMain" />&nbsp;&nbsp;
              <input type="checkbox" name="is_promote" value="1">&nbsp;&nbsp;打勾表示应用促销价，否则不用
            </td>
          </tr>

          <tr>
            <td align="right">促销日期</td>
            <td>
                <input name="promote_start_date" class="Wdate" type="text" onClick="WdatePicker()">  -
                <input name="promote_end_date" class="Wdate" type="text" onClick="WdatePicker()"> 
            </td>
          </tr>

          <tr>
            <td align="right">上传商品图片</td>
            <td>
              <input type="file" name="goods_img" size="18" />
            </td>
          </tr>
        </table>
        </div>

        <!--详细描述-->
        <div id="display">
            <textarea name="goods_desc" id="editor" cols="30" rows="500"></textarea>
            <script>
               var ue = UE.getEditor('editor');
            </script>
        </div>

        <!--其他信息-->
        <div id="defined">
          <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
            
            <tr>
              <th width="131">名称</th>
              <th>内容</th>
            </tr>

            <tr>
              <td align="right">商品重量</td>
              <td>
                <input type="text" name="goods_weight" value="" size="80" class="inpMain" />
              </td>
            </tr>

            <tr>
              <td align="right">商品库存数量</td>
              <td>
                <input type="text" name="goods_number" value="" size="80" class="inpMain" />
              </td>
            </tr>

            <tr>
              <td align="right">库存警告数量</td>
              <td>
                <input type="text" name="warn_number" value="20" size="80" class="inpMain" />
              </td>
            </tr>
            
            <tr>
              <td align="right">加入推荐</td>
              <td>
                <input type="checkbox" name="is_best" value="1" size="80" class="inpMain" />&nbsp;精品&nbsp;&nbsp;
                <input type="checkbox" name="is_new" value="1" size="80" class="inpMain" />&nbsp;新品&nbsp;&nbsp;
                <input type="checkbox" name="is_hot" value="1" size="80" class="inpMain" />&nbsp;热销&nbsp;&nbsp;
              </td>
            </tr>

            <tr>
              <td align="right">商品库存数<td>
                <input type="checkbox" name="is_on_sale" checked value="1" size="80" class="inpMain" />&nbsp;打勾表示允许销售，否则不允许销售。
              </td>
            </tr>

            <tr>
              <td align="right">是否包邮<td>
                <input type="checkbox" name="is_shiping" checked value="1" size="80" class="inpMain" />&nbsp;打勾表示包邮，否则不包邮。
              </td>
            </tr>
            
            <tr>
              <td align="right">商品简单描述</td>
              <td>
                <textarea name="goods_brief" id="" cols="50" rows="5"></textarea>
              </td>
            </tr>
          </table>
        </div>

        <!--商品类型-->
        <div id="attr">
          <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
            <tr>
              <th width="131">名称</th>
              <th>内容</th>
            </tr>
            <tr>
              <td align="right">商品类型</td>
              <td>
                <select class="search" name="type_id">
                  <option style="width:100px;" value="0">--请选择--</option>

                    <option value="">----</option>

                </select>
              </td>
            </tr>
          </table>
        </div>

        <!--货品-->
        <div id="sku">
          <table id="tbox" width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
            <tbody>
              
            </tbody>
          </table>
<script>
  $(function()
  {
    //下拉菜单搜索参与价格运算的字段名
    $('.search').change(function()
    {
      var type_id = $('.search').val();
      var tbody = $('#tbox').find('tbody');
      //发送数据
      $.ajax({
        url:"Goods/search_attribute",
        type:'post',
        data:{'type_id':type_id},
        dataType:'json',
        success:function(obj)
        {
          var tr = $("<tr></tr>");
          $.each(obj,function(k,v)
          {
            tr.append("<th>"+v.attr_name+"</th>");
          })
          tr.append("<th>价格</th>");
          tr.append("<th>货号</th>");
          tr.append("<th>库存</th>");
          tr.append("<th>操作</th>");
          tbody.html('');
          tbody.append(tr);

          //制作表中数据
          var row = $("<tr class='row'></tr>");
          $.each(obj,function(k,v)
          {
            td = $('<td style="text-align:center;"><select attrid="'+v.attr_id+'" name="spec_list[0][spec_id]['+v.attr_id+']"><option style="width:100px;">--请选择--</option></select></td>');
            select = td.find('select');
            //将字符串转换为数组
            var attr_value = v.attr_values.split('/');
            //循环属性值
            $.each(attr_value,function(key,val)
            {
              select.append("<option value='"+val+"'>"+val+"</option>")
            })
            row.append(td);
          })
          row.append("<td style='text-align:center;'><input attrname='goods_price' name='spec_list[0][goods_price]' class='inpMain' type='text'></td>");
          row.append("<td style='text-align:center;'><input attrname='goods_sn' name='spec_list[0][goods_sn]' class='inpMain' type='text'></td>");
          row.append("<td style='text-align:center;'><input attrname='SKU' name='spec_list[0][SKU]' class='inpMain' type='text'></td>");
          row.append("<td style='text-align:center;'><input class='btnGray' type='button' value='—'>&nbsp;&nbsp;&nbsp;<input class='btn' type='button' value='+'></td>");
          //追加到$('#tbox')中
          tbody.append(row);

          //给+号一个点击事件
          $(document).off().on('click','.btn',function()
          {
            //找到需要克隆的对象
            var tr_clone = $(this).parent().parent();
            //克隆tr
            var tr_new = tr_clone.clone();
            //追加到后面
            tr_clone.after(tr_new);

            //修改name --- select
            tbody.find('.row').each(function(i)
            {
              $(this).find('select[attrid]').each(function()
              {
                //console.log(i);
                var attr = $(this).attr('attrid');
                console.log(attr);
                $(this).attr('name',"spec_list["+i+"][spec_id]["+attr+"]");
              })
            })

            //修改name --- input
            tbody.find('.row').each(function(i)
            {
              $(this).find('input[attrname]').each(function()
              {
                var attr = $(this).attr('attrname');
                $(this).attr('name',"spec_list["+i+"]["+attr+"]");
              })
            })

          })

          //给-号一个点击事件
          $(document).on('click','.btnGray',function()
          {
            //移除克隆对象
            $(this).parent().parent().remove();

            //修改name --- select
            tbody.find('.row').each(function(i)
            {
              $(this).find('select[attrid]').each(function()
              {
                //console.log(i);
                var attr = $(this).attr('attrid');
                console.log(attr);
                $(this).attr('name',"spec_list["+i+"][spec_id]["+attr+"]");
              })
            })

            //修改name --- input
            tbody.find('.row').each(function(i)
            {
              $(this).find('input[attrname]').each(function()
              {
                var attr = $(this).attr('attrname');
                $(this).attr('name',"spec_list["+i+"]["+attr+"]");
              })
            })

          })

        }
      })
    })

  })
</script>
        </div>

        <!--商品参数-->
        <!-- <div id="mail"> -->
        <!-- <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic"> -->
         <!-- <tr>
           <th width="131">名称</th>
           <th>内容</th>
         </tr>
                  <tr>
          <td align="right">邮件服务</td>
          <td>
                      <label for="mail_service_0">
            <input type="radio" name="mail_service" id="mail_service_0" value="0" checked="true">
            系统内置Mail服务</label>
           <label for="mail_service_1">
            <input type="radio" name="mail_service" id="mail_service_1" value="1">
            SMTP服务</label>
                                              <span class="cue ml">如果选择系统内置Mail服务则以下SMTP有关信息无需填写</span>
                                 </td>
         </tr>
                  <tr>
          <td align="right">SMTP服务器</td>
          <td>
                      <input type="text" name="mail_host" value="smtp.domain.com" size="80" class="inpMain" />
                                              <p class="cue">一般邮件服务器地址为：smtp.domain.com，如果是本机则对应localhost即可</p>
                                 </td>
         </tr>
                  <tr>
          <td align="right">服务器端口</td>
          <td>
                      <input type="text" name="mail_port" value="25" size="80" class="inpMain" />
                                </td>
         </tr>
                  <tr>
          <td align="right">是否使用SSL安全协议</td>
          <td>
                      <label for="mail_ssl_0">
            <input type="radio" name="mail_ssl" id="mail_ssl_0" value="0" checked="true">
            否</label>
           <label for="mail_ssl_1">
            <input type="radio" name="mail_ssl" id="mail_ssl_1" value="1">
            是</label>
                                </td>
         </tr>
                  <tr>
          <td align="right">发件邮箱</td>
          <td>
                      <input type="text" name="mail_username" value="" size="80" class="inpMain" />
                                </td>
         </tr>
                  <tr>
          <td align="right">发件邮箱密码</td>
          <td>
                      <input type="text" name="mail_password" value="" size="80" class="inpMain" />
                                </td>
         </tr>
                 </table> -->
      <!-- </div> -->
        <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
          <tr>
            <td width="131"></td>
            <td>
              <input class="btn" type="submit" value="提交" />
            </td>
          </tr>
        </table>
      </form>
      </div>
    </div>
   </div>
 </div>
 <div class="clear"></div>
<div id="dcFooter">
 <div id="footer">

</div><!-- dcFooter 结束 -->
<div class="clear"></div> </div>
</body>
</html>