$('.ConfirmAjax').click(function(){
  var confirm = $(this).attr("confirm");
  var url = $(this).attr("url");
  var type = $(this).attr("types");
  var isUpdate = $(this).attr("isUpdate");
  ConfirmAjaxthis = $(this);
  layer.confirm(confirm, {
    btn: ['确定','取消'] //按钮
  }, function(){
    var isdata = ConfirmAjaxthis.attr("isdata");
    if(isdata == 1){
      $.ajax({
        type: type,
        url: url,
        data: $('form').serialize(),
        dataType: 'json',
        success: function(data){
          sure(data,isUpdate);
        },
        error: function(data){
          layer.msg('网络异常，请稍后重试', {icon: 2});
          layer.close(index);
        },
      });
    }else{
      $.ajax({
        type: type,
        url: url,
        dataType: 'json',
        success: function(data){
          sure(data,isUpdate);
        },
        error: function(data){
          layer.msg('网络异常，请稍后重试', {icon: 2});
          layer.close(index);
        },
      });
    }
  });
})

function sure(data,isUpdate){
  if(data.code != 1){
    layer.msg(data.msg, {icon: 2},function(){});
  }else{
    layer.msg(data.msg, {icon: 1},function(){
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

}
