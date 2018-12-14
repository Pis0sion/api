function ConfirmAjax(id,confirm,url,type,isUpdate,datas){
    ConfirmAjaxFunctionThis = $(this);
    layer.confirm(confirm, {
        btn: ['确定','取消'] //按钮
    }, function(){
        $.ajax({
            type: type,
            url: url,
            data: {id:id,datas:datas},
            dataType: 'json',
            success: function(data){
                sure(data,isUpdate);
            },
            error: function(data){
                var res = JSON.parse(data.responseText);
                layer.msg(res.message, {icon: 2});
                layer.close(index);
            },
        });
    });
}