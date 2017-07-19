//多条件搜索
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
				var page = "<?= LinkPager::widget(['pagination' => "+obj.pagination+"]); ?>";
				$.each(obj.orderInfo,function(k,v){
					var order_status= '';
					var pay_status= '';
					var shipping_status= '';

					if(v.order_status == 1){
					 order_status ='未确认';
					}else if(v.order_status == 2){
						order_status ='确认';
					}else if(v.order_status == 3){
						order_status ='已取消';
					}else if(v.order_status == 4 ){
						order_status ='无效';
					}else if(v.order_status ==5){
						order_status ='退货';
					}

					if(v.pay_status ==1){
				 		pay_status ='未付款';
					}else if(v.pay_status ==2){
						pay_status ='已付款';
					}

					if(v.shipping_status ==1){
						shipping_status ='未发货';
					}else if(v.shipping_status ==2){
						shipping_status ='已发货';
					}else if(v.shipping_status ==3){
						shipping_status ='配货中';
					}else if(v.shipping_status ==4){
						shipping_status ='已签收';
					}else if(v.shipping_status ==5){
						shipping_status ='退货';
					}
					str +='<tr order-info-id="'+v.id+'"><td><input name="order_id" type="checkbox" value="'+v.id+'" /></td><td><span class="details" id="'+v.id+'">'+v.order_sn+'</span></td><td>'+v.add_time+'</td><td><span class="status" stype="order_status" status="'+v.order_status+'">'+order_status+'</span></td><td><span class="status" stype="pay_status" status="'+v.pay_status+'">'+pay_status+'</span></td><td>'+v.pay_time+'</td><td><span class="status" stype="shipping_status" status="'+v.shipping_status+'">'+shipping_status+'</span></td><td>'+v.message+'</td><td>'+v.username+'</td><td>'+v.tel+'</td><td>'+v.path+'</td><td><a href="connoisseuradd.html"><img class="operation"src="img/update.png"></a> <img class="operation delban"src="img/delete.png"></td></tr>';
				});
				$('.search').html(str);
				$('.paging').html(page);
			}
		}
	})
});
//订单详情
$(document).on('click','.details',function(){
	var _this = $(this);
	var order_info_id = _this.attr('id');
		$.ajax({
		url:'?r=order/details',
		type:'post',
		data:{order_info_id:order_info_id},
		dataType:"json",
		success:function(obj){
			if(obj.status == 1){
				$('.order_goods_show').show();
				var str = '<tr><td>'+obj.arr.order_goods_id+'</td><td>'+obj.arr.goods_name+'</td><td>'+obj.arr.goods_sn+'</td><td>'+obj.arr.buy_number+'</td><td>'+obj.arr.goods_price+'</td><td>'+obj.arr.goods_attr+'</td><td><a href="#">导出</a></td></tr>';
				alert(str);
				$('.order_goods').html(str);
			}else{
				alert(obj.msg);
			}
		}		
	})
});
//修改状态
$(document).on('click', '.status', function(){
	var _this = $(this);
	var order_info_id = _this.parents('tr').attr('order-info-id');
	var old_val = _this.html();
	var old_status=_this.attr('status');
	var stype = _this.attr('stype');
	var status_val = '';
	if(stype == 'order_status'){
		_this.parent().html('<select name="status" id="status"><option value="">-------</option><option value="1">未确认</option><option value="2">确认</option><option value="3">已取消</option><option value="4">无效</option><option value="5">退货</option></select>');   
	}else if( stype == 'pay_status'){
		_this.parent().html('<select name="status" id="status"><option value="">-------</option><option value="1">未付款</option><option value="2">已付款</option></select>');  
	}else if(stype == 'shipping_status'){
		_this.parent().html('<select name="status" id="status"><option value="">-------</option><option value="1">未发货</option><option value="2">已发货</option><option value="3">配货中</option><option value="4">已签收</option><option value="5">退货</option></select>'); 
	}
	$('#status').change(function(){   
		var obj=$(this);      
		var new_status=obj.val(); //获取要修改内容的id
		if(stype == 'order_status'){
			if(new_status == 1){
			 	status_val ='未确认';
			}else if(new_status == 2){
				status_val ='确认';
			}else if(new_status == 3){
				status_val ='已取消';
			}else if(new_status == 4 ){
				status_val ='无效';
			}else if(new_status ==5){
				status_val ='退货';
			}
		}else if(  stype == 'pay_status' ){
			if(new_status == 1){
				 status_val = '未付款';
			}else if(new_status == 2){
				 status_val = '已付款';
			}
		}else if(stype == 'shipping_status'){
			if(new_status == 1){
			 	status_val ='未确认';
			}else if(new_status == 2){
				status_val ='确认';
			}else if(new_status == 3){
				status_val ='已取消';
			}else if(new_status == 4 ){
				status_val ='无效';
			}else if(new_status ==5){
				status_val ='退货';
			}
		}
		if(new_status == old_status){
			obj.parent().html('<td><span class="status" stype="'+stype+'" status="'+old_status+'">'+old_val+'</span></td>');
		}else{
			$.ajax({      
			    type:'post',      
			    url:'?r=order/update',      
			    data:{      
			        id:order_info_id,
			        index:stype,      
			        new_status:new_status    
			    },      
			    success:function(msg){
			        if(msg == 1){
			            obj.parent().html('<td><span class="status" stype="'+stype+'" status="'+new_status+'">'+status_val+'</span></td>');  
			        }else{      
			            obj.parent().html('<td><span class="status" stype="'+stype+'" status="'+old_status+'">'+old_val+'</span></td>');   
			        }      
			    }      
			}) 
		}
	})  
});
//批量删除
$(document).on('click', '.del', function(){
		var ids = '';
		 $("input:checkbox[name='order_id']:checked").each(function() {
            ids += $(this).val() + ",";
        });
		if(ids == ''){
			alert('没有数据');
		}else{
		 	$.ajax({      
			    type:'post',      
			    url:'?r=order/del',      
			    data:{ids:ids},
			    success:function(msg){      
			        if(msg == 1){      
			            alert('删除成功');
			            $("input:checkbox[name='order_id']:checked").each(function() {
				  			n = $("input:checkbox[name='order_id']:checked").parents('tr').index();
                            $('.search').find('tr:eq('+n+')').remove();
			        	});
			        }else{      
			            alert('删除失败'); 
			        }      

			    }      
			}) 
		}
	});