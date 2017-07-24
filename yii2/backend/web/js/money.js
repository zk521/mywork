$(document).on('click', 'span', function(){
	var _this = $(this);
	var val = _this.html();
	var account_status = _this.attr('status');
	var money = _this.parent().prev('td').html();
	var id = _this.parents('tr').find('td').eq(0).html();
	var str = '';
	$.ajax({
		url:'?r=money/status',
		type:'post',
		data:{id:id, money:money, account_status:account_status},
		success:function(msg){
			if(msg == 1){
				if(account_status == 1){
					str = '已打卡';
				}else{
					str = '未打卡';
				}
				_this.html(str);
				_this.attr('status',2);
			}else{
				alert('修改失败');
			}
		}
	})
});

//多条件搜索
$(document).on('click', '.button', function(){
	var start_time = $("input[name='act_start_time']").val();
	var stop_time = $("input[name='act_stop_time']").val();
	var bussiness_id = $('#shangjia').val();
	var str = '';
	$.ajax({
		url:'?r=money/search',
		type:'post',
		data:{'start_time':start_time,'stop_time':stop_time, 'bussiness_id':bussiness_id},
		dataType:'json',
		success:function(obj) {
			if(obj.status == 0) {
				alert(obj.msg);
			}else{
				$.each(obj.money,function(k,v){
					if(v.account_status == 1){
						var account_status = '未打款';
					}else{
						var account_status = '已打款';
					}
					str +='<tr><td>'+v.m_id+'</td><td>'+v.b_name+'</td><td>'+v.type+'</td><td>'+v.m_money+'</td><td><span status="'+v.account_status+'">'+account_status+'</span></td><td>'+v.m_time+'</td><td>'+v.where+'</td></tr>';
				});
				$('.search').html(str);
			}
		}
	})
})