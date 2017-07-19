<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>约见管理-有点</title>
<link rel="stylesheet" type="text/css" href="css/css.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/page.js" ></script>
<!-- 插件start -->

<link type="text/css" rel="stylesheet" href="css/admin.css" />
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />
<script type="text/javascript" src="js/jquery-ui-1.10.4.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.datepicker-zh-CN.js"></script>
<script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="js/jquery-ui-timepicker-zh-CN.js"></script>
<style type="text/css">
.ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
.ui-timepicker-div dl { text-align: left; }
.ui-timepicker-div dl dt { float: left; clear:left; padding: 0 0 0 5px; }
.ui-timepicker-div dl dd { margin: 0 10px 10px 45%; }
.ui-timepicker-div td { font-size: 90%; }
.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }

.ui-timepicker-rtl{ direction: rtl; }
.ui-timepicker-rtl dl { text-align: right; padding: 0 5px 0 0; }
.ui-timepicker-rtl dl dt{ float: right; clear: right; }
.ui-timepicker-rtl dl dd { margin: 0 45% 10px 10px; }
</style>
<!-- 插件end -->
<style>
	.cfD .order {
	width: 220px;
	height: 30px;
	border: 1px solid #ccc;
	text-indent: 15px;
}
</style>
</head>

<body>
	<div id="pageAll">
		<div class="pageTop">
			<div class="page">
				<img src="img/coin02.png" /><span><a href="#">首页</a>&nbsp;-&nbsp;<a
					href="#">公共管理</a>&nbsp;-</span>&nbsp;订单管理
			</div>
		</div>

		<div class="page">
			<div class="connoisseur">
				<div class="conform">
<!-- 					<form> -->
						<div class="cfD">
							时间段： <input name="act_start_time" type="text" value="" placeholder="开始时间≥当前时间" title="开始时间≥当前时间" readonly="readonly" style="cursor:pointer;" class="vinput" />&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;
							 <input name="act_stop_time" type="text" value="" placeholder="结束时间>开始时间" title="结束时间>开始时间" readonly="readonly" style="cursor:pointer;" class="vinput vpr"/>
						</div>
						<div class="cfD">
							订单状态：<label><input
								type="radio" checked="checked" name="styleshoice1" value="0" />&nbsp;未确认</label> <label><input
								type="radio" name="styleshoice1" value="1"/>&nbsp;确认</label> <label><input
								type="radio" name="styleshoice1" value="2"/>&nbsp;已取消</label> <label><input
								type="radio" name="styleshoice1" value="3"/>&nbsp;无效</label> <label class="lar"><input
								type="radio" name="styleshoice1" value="4"/>&nbsp;退货</label>
						</div>
						<div class="cfD">
							配送情况：<label><input
								type="radio" checked="checked" name="styleshoice2" value="0" />&nbsp;未发货</label> <label><input
								type="radio" name="styleshoice2" value="1" />&nbsp;已发货</label><label><input
								type="radio" name="styleshoice2" value="2" />&nbsp;配货中</label><label><input
								type="radio" name="styleshoice2" value="3" />&nbsp;已签收</label><label><input
								type="radio" name="styleshoice2"  value="4"/>&nbsp;退货</label>
						</div>
						<div class="cfD">		
							支付状态：<label><input
								type="radio" checked="checked" name="styleshoice3" value="0" />&nbsp;未付款</label> <label><input
								type="radio" name="styleshoice3" value="1" />&nbsp;已付款</label>	
						</div>
						<div class="cfD">
							商家：<select name="bussiness_id" id="shangjia">
								<option value="0">选择商家</option>
								<?php foreach ($buss as $key => $value): ?>
								<option value="<?=$value['id']?>" style="text-align: center"><?=$value['b_name']?></option>
								<?php endforeach ?>
								</select>
						</div>
						<div class="cfD">
							<input class="order" type="text" placeholder="输入订单号" name='order_sn' />
							<input class="addUser" type="text" placeholder="输入收件人名字" name="username " />
							<button class="button">搜索</button>
						</div>
					<!-- </form> -->
				</div>
				<div class="conShow">
					<table border="1" cellspacing="0" cellpadding="0">
						<tr>
							<td width="66px" class="tdColor tdC">选择</td>
							<td width="200px" class="tdColor">订单号</td>
							<td width="200px" class="tdColor">下单时间</td>
							<td width="200px" class="tdColor">订单状态</td>
							<td width="200px" class="tdColor">支付状态</td>
							<td width="200px" class="tdColor">支付时间</td>
							<td width="200px" class="tdColor">配送情况</td>
							<td width="200px" class="tdColor">订单留言</td>
							<td width="200px" class="tdColor">收货人</td>
							<td width="200px" class="tdColor">收件人电话</td>
							<td width="200px" class="tdColor">收件人地址</td>
							<td width="130px" class="tdColor">操作</td>
						</tr>
						<tbody class="search">
					<?php foreach ($orderInfo as $key => $value): ?>
						<tr order-info-id="<?=$value['id']?>">
							<td><input name="id[]" type="checkbox" value="<?=$value['id']?>" /></td>
							<td><span class='details' id="<?=$value['id']?>"><?=$value['order_sn']?></span></td>
							<td><?=$value['add_time']?></td>
							<?php if ($value['order_status'] ==0): ?>
								<td>未确认</td>
							<?php elseif($value['order_status'] ==1):?>	
								<td>确认</td>
							<?php elseif($value['order_status'] ==2):?>	
								<td>已取消</td>
							<?php elseif($value['order_status'] ==3):?>	
								<td>无效</td>
							<?php elseif($value['order_status'] ==4):?>	
								<td>退货</td>
							<?php endif ?>
							<?php if ($value['pay_status'] == 0): ?>
								<td><span class="pay_status" pay-status="<?=$value['pay_status']?>">未付款</span></td>
							<?php elseif($value['pay_status'] == 1):?>	
								<td><span class="pay_status" pay-status="<?=$value['pay_status']?>">已付款</span></td>
							<?php endif ?>
							<td><?=$value['pay_time']?></td>
							<?php if ($value['shipping_status'] == 0): ?>
								<td>未发货</td>
							<?php elseif($value['order_status'] ==1):?>	
								<td>已发货</td>
							<?php elseif($value['order_status'] ==2):?>	
								<td>配货中</td>
							<?php elseif($value['order_status'] ==3):?>	
								<td>已签收</td>
							<?php elseif($value['order_status'] ==4):?>	
								<td>退货</td>
							<?php endif ?>
							<td><?=$value['message']?></td>
							<td><?=$value['username ']?></td>
							<td><?=$value['tel']?></td>
							<td><?=$value['path']?></td>
							<td><a href="connoisseuradd.html"><img class="operation"
									src="img/update.png"></a> <img class="operation delban"
								src="img/delete.png"></td>
						</tr>
					<?php endforeach ?>
						</tbody>
					</table>
					<div class="paging">此处是分页</div>
				</div>
			</div>
		</div>

	</div>

	<div class="banDel">
		<div class="delete">
			<div class="close">
				<a><img src="img/shanchu.png" /></a>
			</div>
			<p class="delP1">你确定要删除此条记录吗？</p>
			<p class="delP2">
				<a class="ok yes">确定</a><a class="ok no">取消</a>
			</p>
		</div>
	</div>
</body>
<script type="text/javascript">
	$( "input[name='act_start_time'],input[name='act_stop_time']" ).datetimepicker();
</script>
<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
	$(document).on('click', '.button', function(){
		var start_time = $("input[name='act_start_time']").val();
		var stop_time = $("input[name='act_stop_time']").val();
		var order_status = $('input[name="styleshoice1"]:checked ').val();
		var shipping_status = $('input[name="styleshoice2"]:checked ').val();
		var pay_status = $('input[name="styleshoice3"]:checked ').val();
		var bussiness_id = $('#shangjia').val();
		var order = $('.order').val();
		var addUser = $('.addUser').val();
		var str = '';
		$.ajax({
			url:'?r=order/search',
			type:'post',
			data:{'start_time':start_time,'stop_time':stop_time,'order_status':order_status,'shipping_status':shipping_status,'pay_status':pay_status,'bussiness_id':bussiness_id,'order_sn':order,'username':addUser},
			dataType:'json',
			success:function(obj) {
				if(obj.status == 0) {
					alert(obj.msg);
				}else{
					// alert(obj.msg);
					$.each(obj.orderInfo,function(k,v){
						var order_status= '';
						var pay_status= '';
						var shipping_status= '';

						if(v.order_status == 0){
						 order_status ='未确认';
						}else if(v.order_status == 1){
							order_status ='确认';
						}else if(v.order_status == 2){
							order_status ='已取消';
						}else if(v.order_status == 3 ){
							order_status ='无效';
						}else if(v.order_status ==4){
							order_status ='退货';
						}

						if(v.pay_status ==0){
					 		pay_status ='未付款';
						}else if(v.pay_status ==1){
							pay_status ='已付款';
						}

						if(v.shipping_status ==0){
							shipping_status ='未发货';
						}else if(v.shipping_status ==1){
							shipping_status ='已发货';
						}else if(v.shipping_status ==2){
							shipping_status ='配货中';
						}else if(v.shipping_status ==3){
							shipping_status ='已签收';
						}else if(v.shipping_status ==4){
							shipping_status ='退货';
						}
						str +='<tr order-info-id="'+v.id+'"><td><input name="id[]" type="checkbox" value="'+v.id+'" /></td><td><span class="details" id="'+v.id+'">'+v.order_sn+'</span></td><td>'+v.add_time+'</td><td>'+order_status+'</td><td><span class="pay_status" pay-status="'+v.pay_status+'">'+pay_status+'</span></td><td>'+v.pay_time+'</td><td>'+shipping_status+'</td><td>'+v.message+'</td><td>'+v.username+'</td><td>'+v.tel+'</td><td>'+v.path+'</td><td><a href="connoisseuradd.html"><img class="operation"src="img/update.png"></a> <img class="operation delban"src="img/delete.png"></td></tr>';
					});
					$('.search').html(str);
				}
			}
		})
	})

	$(document).on('click','.details',function(){
		var _this = $(this);
		var order_info_id = _this.attr('id');
			$.ajax({
			url:'?r=order/details',
			type:'post',
			data:{order_info_id:order_info_id}
		})
	})

	$(document).on('click', '.pay_status', function(){
		var _this = $(this);
		var old_val = _this.html();
		var old_pay_status=_this.attr('pay-status');
		var order_info_id = _this.parents('tr').attr('order-info-id');
		var status_val = '';

		_this.parent().html('<select name="pay_status" id="pay_status"><option value="">-------</option><option value="0">未付款</option><option value="1">已付款</option></select>');   
		
		$('#pay_status').change(function(){   
			
			var obj=$(this);      
			var pay_status=obj.val(); //获取要修改内容的id
			if(pay_status == 0){
				 status_val = '未付款';
			}else if(pay_status == 1){
				 status_val = '已付款';
			}
			if(pay_status == old_pay_status){
				obj.parent().html('<td><span class="pay_status" pay-status="'+old_pay_status+'">'+old_val+'</span></td>');
			}else{
				$.ajax({      
				    type:'post',      
				    url:'?r=order/update',      
				    data:{      
				        id:order_info_id,      
				        pay_status:pay_status    
				    },      
				    success:function(msg){
				        if(msg == 1){
				            obj.parent().html('<td><span class="pay_status" pay-status="'+pay_status+'">'+status_val+'</span></td>');  
				        }else{      
				            obj.parent().html('<td><span class="pay_status" pay-status="'+old_pay_status+'">'+old_val+'</span></td>');   
				        }      
				    }      
				}) 
			}
		  	     
	    })    
	});

</script>
<script type="text/javascript">
// 广告弹出框
$(".delban").click(function(){
	var _this = $(this);
	var id = _this.parents('tr').attr('order-info-id');
	alert(id);
  	$(".banDel").show();
  	$(".yes").click(function(){
	  $(".banDel").hide();
	  	$.ajax({      
		    type:'get',      
		    url:'?r=order/delete',      
		    data:{id:id},     
		    success:function(msg){
		    	if(msg == 1){
	  				alert('删除成功');
	  				_this.parents('tr').remove();
		  		}else{
		  			alert('删除失败');
		  		}
		    }
		})
	});
	$(".close").click(function(){
	  $(".banDel").hide();
	});
	$(".no").click(function(){
	  $(".banDel").hide();
	});
});
// 广告弹出框 end
</script>

</html>