$(document).ready(function(){

    $('#elegir_chat').click(function(){
        var $datos = '&dato_null='+1;
        $.ajax({ 
            url:"cargar-post",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: "POST",
            datatype: "json",
            data: $datos, 
            statusCode: {
                404: function(){
                    swal({type: "error", title: "Página no encontrada"}); 
                }
            },
            beforeSend: function() {
                swal({
                    title: 'Cargando Post...',
                    allowOutsideClick: false,
                    closeOnCancel: false,
                    onOpen: () => {
                        swal.showLoading()
                    }
                });
            },
            error: function(jqXHR,estado,error){
                swal.close();
                swal({type: "error", title: error, allowOutsideClick: false, closeOnCancel: false}); 
            },
            success: function(data){
                $("#contenido").html(data);
                swal.close();
            }
        });
    
    });

    $('#crear_post').click(function(){
        var $datos = '&_token='+$('meta[name="csrf-token"]').attr('content');
        $.ajax({ 
            url:"crear-post-vista",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type: "POST",
            datatype: "json",
            data: $datos, 
            statusCode: {
                404: function(){
                    swal({type: "error", title: "Página no encontrada"}); 
                }
            },
            beforeSend: function() {
                swal({
                    title: 'Cargando Post...',
                    allowOutsideClick: false,
                    closeOnCancel: false,
                    onOpen: () => {
                        swal.showLoading()
                    }
                });
            },
            error: function(jqXHR,estado,error){
                swal.close();
                swal({type: "error", title: error, allowOutsideClick: false, closeOnCancel: false}); 
            },
            success: function(data){
                $("#contenido").html(data);
                swal.close();
            }
        });
    });
});