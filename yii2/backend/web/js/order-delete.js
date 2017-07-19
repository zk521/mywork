$(".delban").click(function(){
	var _this = $(this);
	var id = _this.parents('tr').attr('order-info-id');
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