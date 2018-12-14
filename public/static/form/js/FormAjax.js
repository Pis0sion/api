$('.FormAjax').click(function(){
	var index = layer.load();
	var url = $(this).attr('url');
	var isUpdate = $(this).attr('isUpdate');
	var type = $(this).attr("types");
    $.ajax({
      type: type,
      url: url,
      data: $('form').serialize(),
      dataType: 'json',
      success: function(data){
          if(data.code == 0){
              layer.msg(data.msg, {icon:2,time:2000},function(){
                  layer.close(index);
              });
          }else{
              layer.msg(data.msg, {icon:1,time:2000},function(){
                  layer.close(index);
                  layer.load();
                  setTimeout(function(){
                      layer.closeAll('loading');
                      if(isUpdate == 1){
                          location.reload();
                      }else{
                          window.location = data.point_url;
                      }
                  }, 1000);
              });
          }
      },
      error: function(data){
        layer.msg('网络异常，请稍后重试', {icon: 2});
        layer.close(index);
      },
    });
})

