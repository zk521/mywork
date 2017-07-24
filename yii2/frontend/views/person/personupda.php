<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>修改信息</title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/general.css" rel="stylesheet" type="text/css" />
<link href="css/main.css" rel="stylesheet" type="text/css" />
</head>
<body>

<h1>
<span class="action-span1"><a href="?r=index/index">SHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 修改信息 </span>
<div style="clear:both"></div>
</h1>
<!-- start add new category form -->
<div class="main-div">
  <form action="category.php" method="post" name="theForm" enctype="multipart/form-data" onsubmit="return validate()">
	 <table width="100%" id="general-table">
		<tbody>
			<tr>
				<td class="label">真实姓名：（不可修改）</td>
				<td><?=$info['b_name']?></td>
			</tr>
			<tr>
				<td class="label">居住地：(点击修改)</td>
				<td>
					<b class="up_add" style="cursor:pointer;"><?=$info['b_address']?></b>
					<span class="reg" style="display:none;">
						<select name="" class="region">
							<option value="0">--请选择--</option>
							<?php foreach($add as $k=>$v ) {?>
								<option class="cc" title="<?=$v['region_name']?>" value="<?=$v['id']?>"><?=$v['region_name']?></option>
							<?php }?>
						</select>
					</span>
				</td>
			</tr>

			<tr id="measure_unit">
				<td class="label">联系方式：</td>
				<td><input type="text" class="tel" value="<?=$info['tel']?>" size="12"></td>
			</tr>
			<tr>
				<td class="label">证件号：（不可修改）</td>
				<td><?=$info['id_number']?></td>
			</tr>
			<tr>
				<td class="label">店铺名称：</td>
				<td><input type="text" class="shopname" value="<?=$info['shopname']?>" size="15"></td>
			</tr>
			<tr>
				<td class="label">店铺主卖：</td>
				<td><input type="text" class="sort_order" value="<?=$info['type']?>" size="15"></td>
			</tr>
			<input type="hidden" class="bid" value="<?=$info['id']?>" />
      </tbody></table>
      <div class="button-div">
        <input type="button" class="btn" value=" 确定 ">
        <input type="reset" value=" 重置 ">
      </div>
  </form>
</div>


</div>

</body>
</html>
<script src="jquery.min.js"></script>
<script>
$(function() {
	$('.up_add').toggle(
		function() {
			$('.reg').show();
		},
		function() {
			$('.reg').hide();
		}
	)

	//四级联动
	$(document).on('change', '.region', function() {
		_this = $(this);
		var p_id = _this.val();
		$.ajax({
        	type: "post",
        	url: "?r=person/region",
        	data: {'region_id':p_id},
        	dataType: 'json',
        	success: function(data) {
        		if (data.length>0) {
        			var html = '<select name="region[]" class="region"><option value="0">--请选择--</option>';
	        		$.each(data,function(k,v){
	            		html += '<option title="'+v.region_name+'" value="'+v.id+'">'+v.region_name+'</option>';
	            	});
        		}
	            _this.nextAll().remove();
	            _this.after(html); 
    		}
    	});
	})

	//修改
	$(document).on('click', '.btn', function()
	{
		//获取信息
		var tel = $('.tel').val();
		var shopname = $('.shopname').val();
		var sort_order = $('.sort_order').val();
		var id = $('.bid').val();
		//循环获取地区
		var region = '';

		$("select option:checked").each(function(i) {
			region += $("select option:checked").eq(i).attr('title');
		})

		if(region == 'undefined') {
			var region = $('.up_add').html();
		}

		$.ajax({
			url:'?r=person/updasql',
			type:'post',
			data:{'id':id, 'tel':tel, 'shopname':shopname, 'sort_order':sort_order, 'b_address':region},
			success:function(obj) {
				// alert(obj)
				if(obj == 1) {
					window.location.href="?r=person/info";
				}
			}
		})
	})
})
</script>