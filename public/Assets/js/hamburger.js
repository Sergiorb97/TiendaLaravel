$('#hamburguer').click(function(){
    if($("[name='inicio']").attr("id") == "oculto"){
        // $("[name='datos']").attr('class','col-9 py-3 ml-auto mt-5 pt-4');
        $("[name='inicio']").attr("id","visible");
        $("[name='datos']").attr('id','der');
        $("[name='datos']").addClass('ml-auto');
    }else{
        // $("[name='datos']").attr('class','col-9 py-3 mt-5 pt-4');
        $("[name='inicio']").attr("id","oculto");
        $("[name='datos']").attr('id','izq');
        $("[name='datos']").removeClass('ml-auto');

    }
});